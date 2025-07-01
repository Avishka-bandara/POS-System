import $ from 'jquery';
import toastr from 'toastr';



$(document).ready(function(){

     
    $(document).on('submit', '#addCategoryForm', function(e){
        e.preventDefault();
         $('#loader').show();
        const formData = $(this).serialize();
        const url = $(this).attr('action');
        // console.log(formData);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response){
                console.log(response);
                // toastr.success(response.success);
                // toastr.error(response.error);

                if(response.success){
                    toastr.success(response.success);
                    $('#addCategoryForm')[0].reset();
                    loadCategories();
                }
                else if(response.error){
                    toastr.error(response.error);
                }
    

            },
            error: function(xhr){
               if(xhr.status === 422){
                toastr.error(xhr.responseJSON.error); // "Category already exists."
                } else {
                toastr.error('An unexpected error occurred.');
            }
            },
                complete: function () {
                $('#loader').hide();
            }
        });
    });



    function loadCategories() {
        $.ajax({
            url: '/api/fetch-categories',
            type: 'GET',
            success: function(response){
                let rows ='';
                if(response.data && response.data.length > 0){
                    response.data.forEach((category,index)=>{
                        rows +=`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${category.name}</td>
                            <td>
                                 <div class="dropdown">
                                    <i class="fa-solid fa-ellipsis-vertical" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer;"></i>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-primary edit-category" data-bs-toggle="offcanvas" href="#editDrawer" data-id="${category.id}" data-name="${category.name}">Edit</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a class="dropdown-item text-danger delete-category" data-id="${category.id}">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        `;
                    });
                }else{
                    rows = `<tr><td colspan="3" class="text-center">No categories found</td></tr>`;
                }
                $('#categoryTableBody').html(rows);
            },
            error:function(xhr){
                toastr.error(xhr.responseJSON.message);
                console.log(xhr.responseJSON);
            }
        });
    }

    loadCategories();



    $(document).on('click', '.edit-category', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        
        
        $('#CategoryId').val(id);
        $('#CategoryName').val(name);
    });


    $('#editCategoryForm').on('submit', function(e){
        e.preventDefault();
        const formData = $(this).serialize();
        const url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response){
                if(response.success){
                    toastr.success(response.success);
                    loadCategories();
                }
                if(response.error){
                    toastr.error(response.error);
                }
            },
            error: function(xhr){
                toastr.error(xhr.responseJSON.error);
                console.log(xhr.responseJSON);
            },
        })
    });

    $(document).on('click', '.delete-category', function (){
        
        const id = $(this).data('id');
        const url = '/api/delete-category/' + id;
        console.log(id);

        $.ajax({
            type: 'POST',
            url: url,
            success: function(response){
                toastr.warning(response.success);
                loadCategories();
            },
            error: function(xhr){
                toastr.error(xhr.responseJSON.message || 'An error occurred');
                console.log(xhr.responseJSON);
            }
        });

    });

 








})



