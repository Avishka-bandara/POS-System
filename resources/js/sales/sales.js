import $ from 'jquery';
import toastr from 'toastr';



// $(document).ready(function () {
//     $('#productForm').on('submit', function (e) {
//         e.preventDefault();

//         const formData = $(this);
//         console.log(formData.serialize());

//         const url = formData.attr('action');

//         $.ajax({
//             type: 'POST',
//             url: url,
//             data: formData.serialize(),
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function (response) {
//                 if (response.success) {
//                     // console.log(response.success);
//                     toastr.success(response.success || 'Product added successfully');

//                 }
//                 else {
//                     toastr.warning(response.error);
//                 }
//             },
//             error: function (xhr) {
//                 toastr.error(xhr.responseText);
//             }

//         })
//     });
// });


let billItems = [];
let counter = 1;

document.getElementById('productForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const productSelect = document.getElementById('productItem');
    const quantityInput = document.getElementById('quantity');

    const productId = productSelect.value;
    const productText = productSelect.options[productSelect.selectedIndex].text;
    const quantity = parseInt(quantityInput.value);

    if (!productId || quantity <= 0) return;

    // Extract price from product text (assumes ' - LKR(price)' format)
    const priceMatch = productText.match(/LKR\((\d+(\.\d+)?)\)/);
    const price = priceMatch ? parseFloat(priceMatch[1]) : 0;
    const total = (price * quantity).toFixed(2);

    billItems.push({ id: productId, name: productText, quantity, price, total });
    renderBill();

    // Reset inputs
    quantityInput.value = '';
    productSelect.selectedIndex = 0;
});

function renderBill() {
    const tbody = document.getElementById('billBody');
    const grandTotalField = document.getElementById('grandTotal');
    tbody.innerHTML = '';
    let grandTotal = 0;

    billItems.forEach((item, index) => {
        grandTotal += parseFloat(item.total);
        tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>LKR ${item.price.toFixed(2)}</td>
                    <td>LKR ${item.total}</td>
                    <td><button class="btn btn-sm btn-danger remove-item-btn" data-index="${index}">X</button></td>
                </tr>
            `;
    });

    grandTotalField.textContent = 'LKR ' + grandTotal.toFixed(2);
}
document.getElementById('finalizeSale').addEventListener('click', function () {
    if (billItems.length === 0) {
        toastr.error('No items in the bill.');
        return;
    }

    // Optional confirmation
    if (!confirm("Do you want to finalize this sale and print the bill?")) return;

    fetch('/sales/submit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            items: billItems
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success('Sale saved successfully!');
                window.location.href = data.redirect; // Redirect to invoice page
            } else {
                toastr.error('Failed to save sale.');
            }
        })

        .catch(error => {
            console.error(error);
            toastr.error('Something went wrong.');
        });
});

// document.getElementById('removeItem').addEventListener('click', function () {
//     if (billItems.length === 0) {
//         toastr.warning('No items in the bill to remove.');
//         return;
//     }
//     removeItem();
// });
document.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('remove-item-btn')) {
        const index = parseInt(e.target.getAttribute('data-index'));
        if (!isNaN(index)) {
            billItems.splice(index, 1);
            renderBill();
        }
    }
});


function printBill() {
    let printWindow = window.open('', '', 'width=800,height=600');
    let style = `
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #000; padding: 8px; text-align: center; }
                h2 { text-align: center; }
            </style>
        `;

    let content = `
            <html>
                <head><title>Print Bill</title>${style}</head>
                <body>
                    <h2>Customer Bill</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${billItems.map((item, i) => `
                                <tr>
                                    <td>${i + 1}</td>
                                    <td>${item.name}</td>
                                    <td>${item.quantity}</td>
                                    <td>LKR ${item.price.toFixed(2)}</td>
                                    <td>LKR ${item.total}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"><strong>Grand Total</strong></td>
                                <td><strong>LKR ${billItems.reduce((sum, item) => sum + parseFloat(item.total), 0).toFixed(2)}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </body>
            </html>
        `;

    printWindow.document.write(content);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
}

const productSelect = document.getElementById('productItem');
const quantityInput = document.getElementById('quantity');

productSelect.addEventListener('change', function () {
    console.log('Product selected:', this.value);
    const selectedOption = this.options[this.selectedIndex];
    const maxStock = selectedOption.getAttribute('data-stock');

    if (maxStock) {
        console.log('Max stock:', maxStock);
        quantityInput.setAttribute('max', maxStock);
    }
});

quantityInput.addEventListener('input', function () {
    const max = parseInt(this.getAttribute('max'));
    const val = parseInt(this.value);

    if (!isNaN(max) && !isNaN(val) && val > max || val == max) {
        console.log(`Quantity exceeds max stock: ${max}`);
        this.value = max;
        toastr.info(`You have reached the maximum quantity of ${max}.`);
    }
});
