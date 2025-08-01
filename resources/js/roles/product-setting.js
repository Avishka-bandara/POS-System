import $ from 'jquery';
import toastr from 'toastr';


$(document).ready(function() {

    $('#activate').on('click',function(){
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
            success: function(response) {
                setTimeout(() => {
                    location.reload();

                }, 3000);
                toastr.success(response.success);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                toastr.error('Failed to activate product.');
            }
        
            
            
        })
    })
});