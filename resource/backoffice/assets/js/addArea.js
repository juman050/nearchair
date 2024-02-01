/**
 * File : addArea.js
 * 
 * This file contain the validation of add City form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Emon
 */

$(document).ready(function(){
	
	var addAreaForm = $("#addArea");
	
	var validator = addAreaForm.validate({
		
		rules:{
			area_name :{ required : true },
			city_id :{ required : true }
		},
		messages:{
			area_name :{ required : "This field is required" },
			city_id :{ required : "This field is required" }
		}
	});
});