/**
 * File : editBusiness.js
 * 
 * This file contain the validation of add business form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Juman
 */

$(document).ready(function(){
	
	var editBusinessForm = $("#editBusiness");
	
	var validator = editBusinessForm.validate({
		
		rules:{
			business_name :{ required : true },
			business_description :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkBusinessEmailExists", type :"post", data : { business_id : function(){ return $("#business_id").val(); } } } },
			mobile : { required : true, digits : true },
			city_id : { required : true, selected : true},
			area_id : { required : true, selected : true},
			address :{ required : true },
			postal_code :{ required : true },
			total_chairs :{ required : true },
		},
		messages:{
			business_name :{ required : "This field is required" },
			business_description :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			city_id : { required : "This field is required", selected : "Please select atleast one option" },
			area_id : { required : "This field is required", selected : "Please select atleast one option" },
			address :{ required : "This field is required" },
			postal_code :{ required : "This field is required" },
			total_chairs :{ required : "This field is required" },
		}
	});
});