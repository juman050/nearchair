/**
 * File : addoffer.js
 * 
 * This file contain the validation of add offer form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Juman
 */

$(document).ready(function(){
	
	var addOfferorm = $("#addOffer");
	
	var validator = addOfferorm.validate({
		
		rules:{
			offer_title :{ required : true },
			service_ids : { required : true },
			discount : { required : true },
			offer_status : { required : true },
			start_time : { required : true },
			end_time : { required : true },
		},
		messages:{
			offer_title :{ required : "This field is required" },
			service_ids : { required : "This field is required" },		
			discount : { required : "This field is required" },		
			offer_status : { required : "This field is required" },		
			start_time : { required : "This field is required" },		
			end_time : { required : "This field is required" },		
		}
	});
});
