import $ from 'jquery';
import toastr from 'toastr';



$(document).ready(function (){
    $('#deleteUserBtn').on ('click', function(){
        const userId = $('#user_id').val();
        const url = `/api/delete-users/${userId}`;
        // console.log(userId);
        
        $.ajax({
            method: 'POST',
            url: url,
            data:{
                userId: userId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){

                console.log(response.authUserId);
                console.log(response.deletedUserId);
                
                // if(response.error){
                //     toastr.error(response.error);
                // }
                // if(response.success){
                //     toastr.success(response.success);
                // }

                // window.location.reload();
                                
            },
            error: function(xhr){
                console.error(xhr.responseText);
                
            }
        })
    });
});