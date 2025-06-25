import $ from 'jquery';

$(document).ready(function() {
    $('#editProductForm').on('submit', function(e) {
    e.preventDefault(); 

    const formData = $(this);
    const url = formData.attr('action');  
    // console.log(formData.serialize());
    
    
    $.ajax({
        type:'GET',
        url: url,
        data: formData.serialize(),
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function (response) {
                console.log('Success:', response);
                fetchDetails(response.data);
                // You can now display a success message or update the DOM
                // console.log('Product updated successfully:', response);
                
        },
        error: function (xhr, status, error) {
                console.error('Error:', error);
                
        }
    })
    });
});

function fetchDetails(products){
    const tableBody = $('#dataTable tbody');
    tableBody.empty(); 

    if(products.length === 0) {
        tableBody.append('<tr><td colspan="7" class="text-center">No products found</td></tr>');
        return;
    }

    products.forEach((product, index) => {
        const row =`
            <tr>
                <td>${index + 1}</td>
                <td>${product.name}</td>
                <td>${product.brand}</td>
                <td>${product.quantity}</td>
                <td>${product.exp_date}</td>
                <td>${product.price}</td>
                <td>${product.category.name}</td>
                <td>
                    <button class="btn btn-primary " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <a class="dropdown-item text-white edit-category " data-bs-toggle="offcanvas" href="#editDrawer" data-id="${product.id}" data-name="${product.name}" >Edit
                        </a>                     
                    </button>
                </td>

                
            </tr>
        
        `;
        tableBody.append(row);
    });

};



