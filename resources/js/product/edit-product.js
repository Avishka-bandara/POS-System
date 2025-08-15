import $ from "jquery";
import toastr from "toastr";


$(document).ready(function () {
    function autoSubmitIfFilled() {
        console.log("Name: " + document.getElementById('productName').value.trim());
        console.log("Brand: " + document.getElementById('brandName').value.trim());
        if (document.getElementById('productName').value.trim() !== '' && document.getElementById('brandName').value.trim() !== '') {
            $("#editProductForm").trigger("submit");
        }

    }

    $("#editProductForm").on("submit", function (e) {
        e.preventDefault();

        const formData = $(this);
        const url = formData.attr("action");
        // console.log(formData.serialize());

        $.ajax({
            type: "GET",
            url: url,
            data: formData.serialize(),
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log("Success:", response);
                fetchDetails(response.data);
                // You can now display a success message or update the DOM
                // console.log('Product updated successfully:', response);
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            },
        });
    });


    autoSubmitIfFilled();


    $("#disableProductBtn").on('click', function (){
        
        const ProductID = $('#CategoryId').val();
        console.log(ProductID);

        const url = '/api/product/disable-product/' + ProductID;


        $.ajax({
            type: "POST",
            url: url,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success:function(response){
                toastr.success(response.success);
                setTimeout(() => {
                    location.reload();
                }, 3000);
            },
            error:function(xhr, status, error){
                toastr.error(xhr.responseJSON.error);
            }

        })
    })

});

function fetchDetails(products) {
    const tableBody = $("#dataTable tbody");
    tableBody.empty();

    if (products.length === 0) {
        tableBody.append(
            '<tr><td colspan="9" class="text-center">No products found</td></tr>'
        );
        return;
    }

    products.forEach((product, index) => {
        const row = `
            <tr>
                <td>${index + 1}</td>
                <td>${product.name}</td>
                <td>${product.brand}</td>
                <td>${product.quantity}</td>
                <td>${product.size} g</td>
                <td>${product.exp_date}</td>
                <td>${Number(product.price).toLocaleString("en-LK", { style: "currency", currency: "LKR" })}</td>
                <td>${product.category.name}</td>
                <td>
                    <a class="btn btn-primary text-white edit-category" 
                        data-bs-toggle="offcanvas" 
                        href="#editDrawer"  
                        data-id="${product.id}" 
                        data-name="${product.name}" 
                        data-brand="${product.brand}" 
                        data-category="${product.category.name}"
                        data-category="${product.category.name}"
                        data-quantity="${product.quantity}"
                        data-exp_date="${product.exp_date}"
                        data-price="${product.price}">
                        Edit
                    </a>
                </td>
            </tr>
        `;
        tableBody.append(row);
    });
}

// Bind edit button click once
$(document).on("click", ".edit-category", function () {
    console.log("Edit button clicked for data", $(this).data());
    const productId = $(this).data("id");
    $("#CategoryId").val(productId);
    $("#CategoryName").val($(this).data("name"));
    $("#BrandName").val($(this).data("brand"));
    $("#Category").val($(this).data("category"));
    $("#Quantity").val($(this).data("quantity"));
    $("#ExpireDate").val($(this).data("exp_date"));
    $("#Price").val($(this).data("price"));
});

