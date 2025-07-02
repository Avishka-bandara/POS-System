import $ from 'jquery';
import toastr from 'toastr';


$(document).ready(function () {

    const url = '/api/fetch-users';

    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            let users = response.data; 
            let tableBody = $('#usertable tbody');
            
            tableBody.empty(); // Clear existing rows

            $.each(users, function (index, user) {
                let row = `<tr>
                        <td>${index + 1}</td>
                        <td>${user.first_name} ${user.last_name}</td>
                        <td>${user.email}</td>
                        <td>${user.phone}</td>
                       
                        <td>
                            <a class="btn btn-primary editUserBtn" 
                            data-bs-toggle="offcanvas" 
                            href="#editEmplyee"
                            data-id="${user.id}"
                            role="button" aria-controls="editDrawer">
                            Edit
                            </a>
                        </td>
                    </tr>`;
                tableBody.append(row);
            });

        },
        error: function(xhr){
            toastr.error(xhr.responseJSON.message || 'An error occurred while fetching users.');
        }

    });


    $(document).on('click', '.editUserBtn', function(){
         const userId = $(this).data('id');
        //  console.log(userId);
         
        const url = `/api/get-users/${userId}`;


        $.ajax({
            url: url,
            method: 'GET',
            success: function(response){
                // console.log(response.user.id);
                
                $('#first_Name').val(response.user.first_name);
                $('#last_Name').val(response.user.last_name);
                $('#user_email').val(response.user.email);
                $('#user_password').val(''); 
                $('#user_id').val(response.user.id);

                $('#user_role').empty();
                $('#user_role').append('<option disabled selected>Choose a role</option>');
                
                response.roles.forEach(role => {
                    const isSelected = response.assigned_roles.includes(role.id) ? 'selected' : '';
                    $('#user_role').append(`<option value="${role.id}" ${isSelected}> ${role.name}</option>`);
                });                    
            },
            error: function(xhr){
                console.log(xhr.responseJSON);
                
            }
        });
    });
});