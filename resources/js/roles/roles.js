import $ from 'jquery';
import toastr from 'toastr';



$(document).ready(function(){
    fetchRoles();
    $('#createRoleForm').on('submit', function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        let url = $(this).attr('action');
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response){
                if(response.success){
                    toastr.success(response.success);
                    $('#createRoleForm')[0].reset(); 
                    fetchRoles();
                }
                if(response.error){
                    toastr.error(response.error);
                }
                    
            },
            error: function(xhr){
                toastr.error(xhr.responseJSON.error);
               
                
                
            }
        })
        
    });

    $('#role_id').on('change', function(){
        let roleId = $(this).val();
        // console.log(roleId);
        
        $.ajax({
            type: 'GET',
            url: `/api/fetch-permissions/${roleId}`,
            success: function(response){
                // console.log(response.role);
                // console.log(response.role_permissions);

                 $('.permission-checkbox').prop('checked', false);

                response.role_permissions.forEach(permissionName => {
                    $(`input[name="permissions[${permissionName}]"]`).prop('checked', true);
                });
            },
            error: function(xhr){
                console.log(xhr.responseJSON);
                
            }
        });
    });

    $('#deleteRole').on('click',function (){
        const roleID = $('#role_id').val();
        console.log(roleID);
        const url = `/api/roles/delete-roles/${roleID}`;

        $.ajax({
            method: 'POST',
            url: url,
            data: {
                roleID: roleID,
            },
            success:function(response){
                if(response.success){
                    toastr.success(response.success);
                    fetchRoles();
                    
                }
                if(response.error){
                    toastr.error(response.error);
                    console.log(response.role );
                }

            },
            error: function(xhr){
                // toastr.info(xhr.responseJSON.error);
                if(xhr.status === 422){
                    toastr.error(xhr.responseJSON.error); 
                } else {
                    toastr.error('An unexpected error occurred.');
                }
            }

        });
    });

});


function fetchRoles(){
    const url = `/api/fetch-roles`;
    $.ajax({
        method: 'GET',
        url : url,
        success: function(response){
            
            $('#role_id').empty();
            $('#role_id').append('<option disabled selected>Choose a role</option>');
            response.roles.forEach(role => {
                $('#role_id').append(`<option value="${role.id}">${role.name}</option>`);
            });
        }
    })
}


