/**
 * File : addCity.js
 * 
 * This file contain the validation of add City form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Juman
 */

$(document).ready(function(){
	
	var addCityForm = $("#addCity");
	
	var validator = addCityForm.validate({
		
		rules:{
			city_name :{ required : true }
		},
		messages:{
			city_name :{ required : "This field is required" }
		}
	});
});