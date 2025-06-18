import $ from 'jquery';

$(document).ready(function() {
    $(document).on('submit', '#editProductForm', (e)=>{
    e.preventDefault(); 

    const formData = $(this);
    const url = formData.attr('action');  
    
    $.ajax({
        method:'POST',
        url: url,
        data: formData.serialize(),
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function (response) {
                console.log('Success:', response);
                // You can now display a success message or update the DOM
        },
        error: function (xhr, status, error) {
                console.error('Error:', error);
                
        }
    })
    });
});