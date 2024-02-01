/**
 * File : addHomeService.js
 * 
 * This file contain the validation of add business form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Emon
 */

$(document).ready(function(){
	
	var addService = $("#storeBusinessService");
	
	var validator = addService.validate({
        rules: {
            service_name: 'required',
            cat_id: {
                 required: true,  
                 number: true,          
                },
            service_price: {
                 required: true,
                 number: true,
                },
            service_time_hr: {
                 required: true,
                },
           
        },
        messages: {
            service_name: "Name must be fillup!", 
            cat_id: {
                required:"Category must be fillup!",
                number: 'Must enter Number',
            },    
            service_price: {
                required:"Price required",
                number: 'Must enter Number',
            },
            service_time_hr: {
                required: "Time is required!",
            }
          
        },
	});
    
    
    
    
    
});

