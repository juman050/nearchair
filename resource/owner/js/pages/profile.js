jQuery(function($){

    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);


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


    if ($("#ownerChangeProfilePic").length > 0) {
        $("#ownerChangeProfilePic").validate({
          
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
            var formData = new FormData($('#ownerChangeProfilePic')[0]);
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: baseURL+'app/ownerChangeProfilePic',
              data: formData,
                contentType: false,
                processData: false,
                // beforeSend: function() { $.LoadingOverlay("show"); },
                // complete: function() { $.LoadingOverlay("hide"); },
                success: function(response){
                  $('#success_tic').modal('show');
                  $('#success_tic').find('.head-text').html(response.msg);
                  $('#ownerChangeProfilePic')[0].reset();
                  $('.change_btn').css('display', 'none');
              }
            });
        }
      })
    }

    });
