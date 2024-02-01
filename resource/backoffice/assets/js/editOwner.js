/**
 * File : editOwner.js
 * 
 * This file contain the validation of add owner form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Juman
 */

$(document).ready(function(){
	
	var editOwnerForm = $("#editOwner");
	
	var validator = editOwnerForm.validate({
		
		rules:{
			owner_name :{ required : true },
			owner_email : { required : true, email : true, remote : { url : baseURL + "checkOwnerEmailExists", type :"post", data : { owner_id : function(){ return $("#owner_id").val(); } }} },
			cpassword : {equalTo: "#owner_password"},
			owner_mobile : { required : true, digits : true },
		},
		messages:{
			owner_name :{ required : "This field is required" },
			owner_email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
            cpassword : {equalTo: "Please enter same password" },
			owner_mobile : { required : "This field is required", digits : "Please enter numbers only" },			
		}
	});
});