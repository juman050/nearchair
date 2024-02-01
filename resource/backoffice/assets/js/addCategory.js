/**
 * File : addCategory.js
 * 
 * This file contain the validation of add Category form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Juman
 */

$(document).ready(function(){
	
	var addCategory = $("#addCategory");
	
	var validator = addCategory.validate({
		
		rules:{
			category_name :{ required : true },
			category_slug :{ required : true, remote : { url : baseURL + "checkCategorySlugExists", type :"post"} },
			category_description : { required : true },
		},
		messages:{
			category_name :{ required : "This field is required" },
			category_slug :{ required : "This field is required",remote : "Slug already taken" },
			category_description : { required : "This field is required" },		
		}
	});
});
