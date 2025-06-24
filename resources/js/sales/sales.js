import $ from 'jquery';
import toastr from 'toastr';    



$(document).ready(function() {
    $('#productForm').on('submit', function(e) {
        e.preventDefault(); 

        const formData = $(this);
        console.log(formData.serialize());
        
        const url = formData.attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: formData.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    // console.log(response.success);
                    toastr.success(response.success || 'Product added successfully');
                    
                }
                else{
                    toastr.warning(response.error);
                }
            },
            error: function(xhr) {
                toastr.error(xhr.responseText);
            }

        })
    });
});