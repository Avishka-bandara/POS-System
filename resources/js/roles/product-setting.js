import $ from 'jquery';
import toastr from 'toastr';


$(document).ready(function () {

    $('#activate').on('click', function () {
        const productId = $(this).data('id');

        console.log(productId);


        $.ajax({
            url: '/api/product/activate/' + productId,
            type: 'POST',
            data: {
                productId: productId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                setTimeout(() => {
                    location.reload();

                }, 3000);
                toastr.success(response.success);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                toastr.error('Failed to activate product.');
            }



        })
    })


    $('#updateSettingsBtn').on('click', function () {

        // Correct syntax for creating FormData
        var formData = new FormData(document.getElementById('editProductForm'));
        $.ajax({
            url: '/settings/update',
            type: 'POST',
            processData: false, // important for FormData
            contentType: false, // important for FormData
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                toastr.success(response.success);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            toastr.error(errors[key][0]);
                        }
                    }
                } else {
                    console.log(xhr.responseText);
                    toastr.error('Failed to update settings.');
                }
            }
        });
    });
});