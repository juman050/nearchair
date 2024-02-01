jQuery(function($){

    $(".logout_icon").on("click",function(){
        $('#modallogout').modal('show');
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('.change_btn').css('display', 'block');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imageUpload").change(function() {
        readURL(this);
    });


    if ($("#changeProfilePic").length > 0) {
        $("#changeProfilePic").validate({
          
        rules: {
            imageUpload: {
                 required: true,
            },
        },
        messages: {
            imageUpload: {
                required:"Choose a image",
            }, 
        },
        submitHandler: function(form) {
            var formData = new FormData($('#changeProfilePic')[0]);
            $.ajax({
               type: 'POST',
               dataType: 'json',
               url: baseURL+'app/changeProfilePic',
               data: formData,
                contentType: false,
                processData: false,
                // beforeSend: function() { $.LoadingOverlay("show"); },
                // complete: function() { $.LoadingOverlay("hide"); },
                success: function(response){
                   $('#success_tic').modal('show');
                   $('#success_tic').find('.head-text').html(response.msg);
                   $('#changeProfilePic')[0].reset();
                   $('.change_btn').css('display', 'none');
               }
            });
        }
      })
    }



    // Profile view Start



    $('.get-area').change(function(){
        var city_id = $(this).val();
        $.ajax({
          type: 'POST',
          dataType: 'html',
          url: baseURL+'app/get_area_by_city',
          data: {city_id:city_id},
            success: function(response){
              $('.append-option').html(response);
          }
        });
    })


    if ($("#changeProfile").length > 0) {
        $("#changeProfile").validate({
          
        rules: {
            fullname: {
                 required: true,
            },
            city: {
                 required: true,
                 number: true,
            },
            address: {
                 required: true,
            },
            gender: {
                 required: true,
                 number: true,
            },
           
        },
        messages: {   
            fullname: {
                required:"Full Name must be fillup!",
            },  
            city: {
                required:"City Must Be Select",
                 number: "Something is wrong",
            },  
            address: {
                required:"Please Enter Your Address",
            },  
            gender: {
                required:"Select Your Gender",
                 number: "Something is wrong",
            },
          
        },
        submitHandler: function(form) {
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: baseURL+'app/updateUserProfile',
              data: $('#changeProfile').serialize(),
                // beforeSend: function() { $.LoadingOverlay("show"); },
                // complete: function() { $.LoadingOverlay("hide"); },
                success: function(response){
                   $('.name').html($("input[name=fullname]").val());
                   $('#success_tic').find('.head-text').html(response.msg);
                   $('#success_tic').modal('show');
              }
            });
        }
      })
    }
    
    
    // Change Password
    
    if ($("#changePassword").length > 0) {
        $("#changePassword").validate({
          
        rules: {
            oldPassword: {
                 required: true,
                 remote : { url : baseURL + "app/checkOldpassword", type :"post"}
            },
            newPassword: {
                 required: true,       
            },
           
        },
        messages: {
            oldPassword: {
                required:"Old Password must be fillup!",
                remote : "Old Password doesn'\t match"
            },    
            newPassword: {
                required:"New Password must be fillup!",
            },
          
        },
        submitHandler: function(form) {
            $.ajax({
               type: 'POST',
               dataType: 'json',
               url: baseURL+'app/updateUserPassword',
               data: $('#changePassword').serialize(),
                // beforeSend: function() { $.LoadingOverlay("show"); },
                // complete: function() { $.LoadingOverlay("hide"); },
                success: function(response){
                   $('#success_tic').modal('show');
                   $('#success_tic').find('.head-text').html(response.msg);
                   $('#changePassword')[0].reset();
               }
            });
        }
      })
    }


    // Vew Order

    $(".view_order ").on("click",function(){
        var order_id = $(this).data('order_id');
        $.ajax({
           type: 'POST',
           dataType: 'html',
           url: baseURL+'app/singleOrderDetails',
           data: {order_id:order_id},
            // beforeSend: function() { $.LoadingOverlay("show"); },
            // complete: function() { $.LoadingOverlay("hide"); },
            success: function(response){
                $('#modalDetails').find('.modal_order_id').text(order_id);
                $('#singleOrderDetails').html(response);
                $('#modalDetails').modal('show');
           }
        });
    });

});
