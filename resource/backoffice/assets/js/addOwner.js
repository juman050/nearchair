/**
 * File : addOwner.js
 * 
 * This file contain the validation of add owner form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Juman
 */

$(document).ready(function(){
	
	var addOwnerForm = $("#addOwner");
	
	var validator = addOwnerForm.validate({
		
		rules:{
			owner_name :{ required : true },
			owner_email : { required : true, email : true, remote : { url : baseURL + "checkOwnerEmailExists", type :"post"} },
			owner_password : { required : true },
			cpassword : {required : true, equalTo: "#owner_password"},
			owner_mobile : { required : true, digits : true },
		},
		messages:{
			owner_name :{ required : "This field is required" },
			owner_email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			owner_mobile : { required : "This field is required", digits : "Please enter numbers only" },			
		}
	});
});