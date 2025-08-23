import $ from 'jquery';
import toastr from 'toastr';




$(document).ready(function(){
    $('#addProductForm').on('submit', function(e){
        e.preventDefault(); 

        const formData = $(this);
        const url = formData.attr('action');
        console.log(formData.serialize());
        
        $.ajax({
            type: 'POST',
            url: url,
            data: formData.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                if(response.success){
                   toastr.success(response.message || 'Product added successfully');
                    formData.trigger("reset");
                }
                else {
                    toastr.error(response.message || 'An error occurred');
                }
            },
            error: function(xhr){
                // console.error(xhr.responseText);
                toastr.error( 'An error occurred while processing your request.');
            }

        })
    })
});

toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "showMethod": "fadeIn",
        "positionClass": "toast-top-right", // top-right, top-left, bottom-right etc.
        "timeOut": "3000"
    };


   


