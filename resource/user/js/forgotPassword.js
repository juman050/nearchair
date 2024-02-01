jQuery(function($){

    
    if ($("#forgotPasswordForm").length > 0) {
        
    	$("#forgotPasswordForm").validate({
            rules: {
                mobile:  {
                    required: true,
                    remote: { url: baseURL + "app/checkForgotNumber", type:"post",async: false},
                    number: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
               
            },
            messages: {

                mobile: {
                    required: "Number must be fill up",
                    remote:"Number doesn't found",
                    number: "Number must be digits",
                    minlength: "Number must be at least 11 characters long",
                    maxlength: "Number must enter in 11 characters",
                    digits: "Number must be digits",
                },
            }
        })
      

    }
    
});
