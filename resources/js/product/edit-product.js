import $ from 'jquery';

$(document).ready(function() {
    $('#editProductForm').on('submit', function(e) {
    e.preventDefault(); 

    const formData = $(this);
    const url = formData.attr('action');  
    console.log(formData.serialize());
    
    
    $.ajax({
        type:'GET',
        url: url,
        data: formData.serialize(),
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function (response) {
                console.log('Success:', response);
                // You can now display a success message or update the DOM
                console.log('Product updated successfully:', response);
                
        },
        error: function (xhr, status, error) {
                console.error('Error:', error);
                
        }
    })
    });
});