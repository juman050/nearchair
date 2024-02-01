jQuery(function($){

    if ($("#loginForm").length > 0) {
        $("#loginForm").validate({
        rules: {
            mobile:  {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11,
                digits: true,
            },
            password:  {
                required: true,
            },
           
        },
        messages: {
            mobile: {
                required:"Mobile Must Be Fill-Up.",
                number: "Mobile text must be number",
                minlength: "Mobile must be at least 10 characters long",
                maxlength: "Mobile must enter in 11 characters",
                digits: "Mobile must be digits",
            },
            password: {
                required: "Password Must Be Fill-Up",
            },
        },
        submitHandler: function(form) {
            var formData = new FormData($('#loginForm')[0]);
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: baseURL+'app/loginUser',
              data: formData,
                contentType: false,
                processData: false,
                // beforeSend: function() { $.LoadingOverlay("show"); },
                // complete: function() { $.LoadingOverlay("hide"); },
                success: function(response){
                    if(response.status === 'error'){
                        $('#errorModal').modal('show');
                        $('#errorModal').find('.md_error_text').html(response.msg);
                    }else if(response.status === 'success'){
                        window.location.href= baseURL+'app/userprofile';
                    }else{
                        $('#errorModal').modal('show');
                        $('#errorModal').find('.md_error_text').html(response.msg);
                    }
              }
            });
        }
      })
    }

    // $('.get-area').change(function(){
    //     var city_id = $(this).val();
    //     $.ajax({
    //       type: 'POST',
    //       dataType: 'html',
    //       url: baseURL+'app/get_area_by_city',
    //       data: {city_id:city_id},
    //         success: function(response){
    //           $('.append-option').html(response);
    //       }
    //     });
    // })
    
    if ($("#registerForm").length > 0) {
        
        $.validator.addMethod("nowhitespace", function(value, element) { 

            return value.indexOf(" ") < 0 && value != "";
            
        }, "Remove space Please and type again");
        
    	$("#registerForm").validate({
            rules: {
                mobile:  {
                    required: true,
                    remote: { url: baseURL + "app/checknumber", type:"post",async: false},
                    number: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
                fullname:  {
                    required: true,
                },
                password:  {
                    required: true,
                    nowhitespace: true,
                },
               
            },
            messages: {

                mobile: {
                    required: "Number must be fill up",
                    remote:"Number already exists",
                    number: "Number must be digits",
                    minlength: "Number must be at least 11 characters long",
                    maxlength: "Number must enter in 11 characters",
                    digits: "Number must be digits",
                },
                fullname: {
                    required: "Enter your first name",
                },
                password: {
                    required: "Password must be enter",
                },
            }
        })
      

    }
    
    

    if ($("#verifyForm").length > 0) {
        
        $.validator.addMethod("nowhitespace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != "";
        }, "Remove space Please and type again");
        

    	$("#verifyForm").validate({
            rules: {
                user_id:  {
                    required: true,
                    number: true,
                    digits: true,
                },
                mobile:  {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 11,
                    digits: true,
                },
                fullname:  {
                    required: true,
                },
                code:  {
                    required: true,
                    nowhitespace: true,
                    number: true,
                    minlength: 6,
                    maxlength: 6,
                    digits: true,
                },
               
            },
            messages: {
                
                user_id: {
                    required: "First Name must be enter",
                    number: "Mobile text must be number",
                    digits: "Mobile must be digits",
                },
                mobile: {
                    required: "Mobile number must be enter",
                    number: "Mobile text must be number",
                    minlength: "Mobile must be at least 10 characters long",
                    maxlength: "Mobile must enter in 11 characters",
                    digits: "Mobile must be digits",
                },
                fullname: {
                    required: "First Name must be enter",
                },
                code: {
                    required: "Code must be enter",
                    number: "Codet must be number",
                    minlength: "Code must be at least 6 characters long",
                    maxlength: "Code must enter in 6 characters",
                    digits: "Code must be digits",
                },
            },
            // submitHandler: function(form) {
            //     var formData = new FormData($('#verifyForm')[0]);
            //     $.ajax({
            //       type: 'POST',
            //       dataType: 'json',
            //       url: baseURL+'app/verifyCode',
            //       data: formData,
            //         contentType: false,
            //         processData: false,
            //         beforeSend: function() { $.LoadingOverlay("show"); },
            //         complete: function() { $.LoadingOverlay("hide"); },
            //         success: function(response){
            //             if(response.status === 'error'){
            //                 $('#errorModal').modal('show');
            //                 $('#errorModal').find('.md_error_text').html(response.msg);
            //             }else if(response.status === 'success'){
            //                 window.location.href= baseURL+'app/userprofile';
            //             }else{
            //                 $('#errorModal').modal('show');
            //                 $('#errorModal').find('.md_error_text').html(response.msg);
            //             }
                      
            //             $('#verifyForm')[0].reset();
                    
            //       }
            //     });
            // }
      })
    }
        
});

    
// $(document).ready(function(){
//     var registerForm = $("#registerForm");
//     var validator = registerForm.validate({
//         rules:{
//             username : { required : true, checkUserName : { url : baseURL + "app/checkUsername", type :"post"} },
//         },
//         messages:{
//             username : { required : "This field is required",checkUserName : "Username already taken" },
//         }
//     });
// });