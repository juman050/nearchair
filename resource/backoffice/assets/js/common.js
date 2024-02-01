/**
 * @author Juman
 */


jQuery(document).ready(function(){
	//This function is used to delete the user from the system
	jQuery(document).on("click", ".deleteUser", function(){
		var adminId = $(this).data("adminid"),
			hitURL = baseURL + "backoffice/deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { adminId : adminId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to delete the owner from the system
	jQuery(document).on("click", ".deleteOwner", function(){
		var owner_id = $(this).data("owner_id"),
			hitURL = baseURL + "backoffice/deleteOwner",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this owner ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { owner_id : owner_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Owner successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	

    //This function is used to delete the category from the system
	jQuery(document).on("click", ".deleteCategory", function(){
		var category_id = $(this).data("cat_id"),
			hitURL = baseURL + "backoffice/deleteCategory",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this category ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { category_id : category_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Category successfully deleted"); }
				else if(data.status = false) { alert("Category deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});



	//This function is used to delete the business from the system
	jQuery(document).on("click", ".deleteBusiness", function(){
		var business_id = $(this).data("business_id"),
			hitURL = baseURL + "backoffice/deleteBusiness",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this business ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { business_id : business_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Business successfully deleted"); }
				else if(data.status = false) { alert("Business deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to delete the city from the system
	jQuery(document).on("click", ".deleteCity", function(){
		var city_id = $(this).data("city_id"),
			hitURL = baseURL + "backoffice/deleteCity",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this city ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { city_id : city_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("City successfully deleted"); }
				else if(data.status = false) { alert("City deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	//This function is used to delete the city from the system
	jQuery(document).on("click", ".deleteSlider", function(){
		var slider_id = $(this).data("slider_id"),
			hitURL = baseURL + "backoffice/deleteSlider",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this image ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { slider_id : slider_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Data successfully deleted"); }
				else if(data.status = false) { alert("Data deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	//This function is used to delete the area from the system
	jQuery(document).on("click", ".deleteArea", function(){
		    var area_id = $(this).data("area_id"),
			hitURL = baseURL + "backoffice/deleteArea",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this area ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { area_id : area_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Area successfully deleted"); }
				else if(data.status = false) { alert("Area deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to delete the area from the system
	jQuery(document).on("click", ".deleteCoupon", function(){
	    var coupon_id = $(this).data("coupon_id"),
		hitURL = baseURL + "backoffice/deleteCoupon",
		currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this coupon ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { coupon_id : coupon_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Coupon successfully deleted"); }
				else if(data.status = false) { alert("Coupon deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to delete the order from the system
	jQuery(document).on("click", ".deleteOrder", function(){
		var order_id = $(this).data("order_id"),
			hitURL = baseURL + "backoffice/deleteOrder",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this order ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { order_id : order_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Order successfully deleted"); }
				else if(data.status = false) { alert("Order deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to delete the user from the system
	jQuery(document).on("click", ".deleteCurrentUser", function(){
		var user_id = $(this).data("user_id"),
			hitURL = baseURL + "backoffice/deleteCurrentUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this User ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { user_id : user_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to delete the homerservice order from the system
	jQuery(document).on("click", ".deleteHomeserviceOrder", function(){
		var order_id = $(this).data("order_id"),
			hitURL = baseURL + "backoffice/deleteHomerserviceOrder",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this order ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { order_id : order_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Order successfully deleted"); }
				else if(data.status = false) { alert("Order deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	

	//This function is used to move Business from the system according their business_status 
	jQuery(document).on("click", ".moveBusiness", function(){
		var business_id = $(this).data("business_id"),
		    business_status = $(this).data("business_status"),
			hitURL = baseURL + "backoffice/moveBusiness",
			currentRow = $(this);
		var str="";
		if(business_status=='0'){
			str="pending";
		}else if(business_status=='1'){
			str="accepted";
		}else{
			str="cancelled";
		}
		
		var confirmation = confirm("Are you sure to move this business to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { business_id : business_id,business_status:business_status } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Business successfully moved"); }
				else if(data.status = false) { alert("Business not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to move user from the system according their user_status 
	jQuery(document).on("click", ".moveUser", function(){
		var user_id = $(this).data("user_id"),
		    user_status = $(this).data("user_status"),
			hitURL = baseURL + "backoffice/moveUser",
			currentRow = $(this);
		var str="";
		if(user_status=='0'){
			str="pending";
		}else if(user_status=='1'){
			str="accepted";
		}else{
			str="cancelled";
		}
		
		var confirmation = confirm("Are you sure to move this user to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { user_id : user_id,user_status:user_status } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully moved"); }
				else if(data.status = false) { alert("User not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to move homeservice order from the system according their order_status 
	jQuery(document).on("click", ".moveHomeserviceOrder", function(){
		var order_id = $(this).data("order_id"),
		    order_status = $(this).data("order_status"),
			hitURL = baseURL + "backoffice/moveHomeserviceOrder",
			currentRow = $(this);
		var str="";
		if(order_status=='0'){
			str="pending";
		}else if(order_status=='1'){
			str="accepted";
		}else{
			str="cancelled";
		}
		
		var confirmation = confirm("Are you sure to move this order to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { order_id : order_id,order_status:order_status } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Order successfully moved"); }
				else if(data.status = false) { alert("Order not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to move order from the system according their order_status 
	jQuery(document).on("click", ".moveOrder", function(){
		var order_id = $(this).data("order_id"),
		    order_status = $(this).data("order_status"),
			hitURL = baseURL + "backoffice/moveOrder",
			currentRow = $(this);
		var str="";
		if(order_status=='0'){
			str="pending";
		}else if(order_status=='1'){
			str="accepted";
		}else{
			str="cancelled";
		}
		
		var confirmation = confirm("Are you sure to move this order to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { order_id : order_id,order_status:order_status } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Order successfully moved"); }
				else if(data.status = false) { alert("Order not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to move Admin from the system according their admin_status 
	jQuery(document).on("click", ".moveAdmin", function(){
		var adminId = $(this).data("adminid"),
		    admin_status = $(this).data("admin_status"),
			hitURL = baseURL + "backoffice/moveAdmin",
			currentRow = $(this);
		var str="";
		var btnstr="";
		var a_status="";
		var addClassName = "";
		var addBtnClassName = "";
		var removeClassName = "";
		var removeBtnClassName = "";
		if(admin_status=='0'){
			str="pending";
			btnstr="Accepted";
			a_status="1";
			addClassName="label-warning";
			addBtnClassName="btn-success";
			removeClassName="label-success";
			removeBtnClassName="btn-warning";
		}else{
			str="active";
			btnstr="Pending";
			a_status="0";
			addClassName="label-success";
			addBtnClassName="btn-warning";
			removeClassName="label-warning";
			removeBtnClassName="btn-success";
		}
		
		var confirmation = confirm("Are you sure to move this user to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { adminId : adminId,admin_status:admin_status } 
			}).done(function(data){
				console.log(data);
				currentRow.addClass(addBtnClassName);
				currentRow.data('admin_status',a_status);
				currentRow.attr("title","move to "+btnstr);
				currentRow.html('<i class="fa fa-reply"></i> '+btnstr);
				currentRow.removeClass(removeBtnClassName);
				
				currentRow.parents('tr').find('.modify_class').addClass(addClassName);
				currentRow.parents('tr').find('.modify_class').html(str);
				currentRow.parents('tr').find('.modify_class').removeClass(removeClassName);
				if(data.status = true) { alert("User successfully moved"); }
				else if(data.status = false) { alert("User not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	//This function is used to move owner from the system according their owner_status 
	jQuery(document).on("click", ".moveOwner", function(){
		var owner_id = $(this).data("owner_id"),
		    owner_status = $(this).data("owner_status"),
			hitURL = baseURL + "backoffice/moveOwner",
			currentRow = $(this);
		var str="";
		var btnstr="";
		var o_status="";
		var addClassName = "";
		var addBtnClassName = "";
		var removeClassName = "";
		var removeBtnClassName = "";
		if(owner_status=='0'){
			str="pending";
			btnstr="Accepted";
			o_status="1";
			addClassName="label-warning";
			addBtnClassName="btn-success";
			removeClassName="label-success";
			removeBtnClassName="btn-warning";
		}else{
			str="active";
			btnstr="Pending";
			o_status="0";
			addClassName="label-success";
			addBtnClassName="btn-warning";
			removeClassName="label-warning";
			removeBtnClassName="btn-success";
		}
		
		var confirmation = confirm("Are you sure to move this owner to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { owner_id : owner_id,owner_status:owner_status } 
			}).done(function(data){
				console.log(data);
				currentRow.addClass(addBtnClassName);
				currentRow.data('owner_status',o_status);
				currentRow.attr("title","move to "+btnstr);
				currentRow.html('<i class="fa fa-reply"></i> '+btnstr);
				currentRow.removeClass(removeBtnClassName);
				
				currentRow.parents('tr').find('.modify_class').addClass(addClassName);
				currentRow.parents('tr').find('.modify_class').html(str);
				currentRow.parents('tr').find('.modify_class').removeClass(removeClassName);
				if(data.status = true) { alert("Owner successfully moved"); }
				else if(data.status = false) { alert("Owner not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to move category from the system according their category_status 
	jQuery(document).on("click", ".moveCategory", function(e){
	    e.preventDefault(); 
		var category_id = $(this).data("category_id"),
		    category_status = $(this).data("category_status"),
			hitURL = baseURL + "backoffice/moveCategory",
			currentRow = $(this);
		var str="";
		var btnstr="";
		var cat_status="";
		var addClassName = "";
		var addBtnClassName = "";
		var removeClassName = "";
		var removeBtnClassName = "";
		if(category_status=='0'){
			str="pending";
			btnstr="Accepted";
			cat_status="1";
			addClassName="label-warning";
			addBtnClassName="btn-success";
			removeClassName="label-success";
			removeBtnClassName="btn-warning";
		}else{
			str="active";
			btnstr="Pending";
			cat_status="0";
			addClassName="label-success";
			addBtnClassName="btn-warning";
			removeClassName="label-warning";
			removeBtnClassName="btn-success";
		}
		
		var confirmation = confirm("Are you sure to move this user to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { category_id : category_id,category_status:category_status } 
			}).done(function(data){
				console.log(data);
				currentRow.addClass(addBtnClassName);
				currentRow.data('category_status',cat_status);
				currentRow.attr("title","move to "+btnstr);
				currentRow.html('<i class="fa fa-reply"></i> '+btnstr);
				currentRow.removeClass(removeBtnClassName);
				currentRow.parents('tr').find('.modify_class').addClass(addClassName);
				currentRow.parents('tr').find('.modify_class').html(str);
				currentRow.parents('tr').find('.modify_class').removeClass(removeClassName);
				if(data.status = true) { alert("Category successfully moved"); }
				else if(data.status = false) { alert("Category not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	//This function is used to move Coupon from the system according their Coupon_status 
	jQuery(document).on("click", ".moveCoupon", function(e){
	    e.preventDefault(); 
		var coupon_id = $(this).data("coupon_id"),
		    coupon_status = $(this).data("coupon_status"),
			hitURL = baseURL + "backoffice/moveCoupon",
			currentRow = $(this);
		var str="";
		var btnstr="";
		var co_status="";
		var addClassName = "";
		var addBtnClassName = "";
		var removeClassName = "";
		var removeBtnClassName = "";
		if(coupon_status=='0'){
			str="pending";
			btnstr="Active";
			co_status="1";
			addClassName="label-warning";
			addBtnClassName="btn-success";
			removeClassName="label-success";
			removeBtnClassName="btn-warning";
		}else{
			str="active";
			btnstr="Pending";
			co_status="0";
			addClassName="label-success";
			addBtnClassName="btn-warning";
			removeClassName="label-warning";
			removeBtnClassName="btn-success";
		}
		
		var confirmation = confirm("Are you sure to move this coupon to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { coupon_id : coupon_id,coupon_status:coupon_status } 
			}).done(function(data){
				console.log(data);
				currentRow.addClass(addBtnClassName);
				currentRow.data('coupon_status',co_status);
				currentRow.attr("title","move to "+btnstr);
				currentRow.html('<i class="fa fa-reply"></i> '+btnstr);
				currentRow.removeClass(removeBtnClassName);
				currentRow.parents('tr').find('.modify_class').addClass(addClassName);
				currentRow.parents('tr').find('.modify_class').html(str);
				currentRow.parents('tr').find('.modify_class').removeClass(removeClassName);
				if(data.status = true) { alert("Coupon successfully moved"); }
				else if(data.status = false) { alert("Coupon not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//This function is used to move city from the system according their city_status 
	jQuery(document).on("click", ".moveCity", function(){
	
		var city_id = $(this).data("city_id"),
		    city_status = $(this).data("city_status"),
			hitURL = baseURL + "backoffice/moveCity",
			currentRow = $(this);
		var str="";
		var btnstr="";
		var c_status="";
		var addClassName = "";
		var addBtnClassName = "";
		var removeClassName = "";
		var removeBtnClassName = "";
		if(city_status=='0'){
			str="pending";
			
			btnstr="Accepted";
			c_status="1";
			addBtnClassName="btn-success";
			addClassName="label-warning";
			
			removeClassName="label-success";
			removeBtnClassName="btn-warning";
		}else{
			str="active";
			btnstr="Pending";
			c_status="0";
			
			addClassName="label-success";
			addBtnClassName="btn-warning";
			
			removeClassName="label-warning";
			removeBtnClassName="btn-success";
		}
		
		var confirmation = confirm("Are you sure to move this city to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { city_id : city_id,city_status:city_status } 
			}).done(function(data){
				console.log(data);
				
				currentRow.addClass(addBtnClassName);
				currentRow.data('city_status',c_status);
				currentRow.attr("title","move to "+btnstr);
				currentRow.html('<i class="fa fa-reply"></i> '+btnstr);
				currentRow.removeClass(removeBtnClassName);
				
				currentRow.parents('tr').find('.modify_class').addClass(addClassName);
				currentRow.parents('tr').find('.modify_class').html(str);
				currentRow.parents('tr').find('.modify_class').removeClass(removeClassName);
				if(data.status = true) { alert("User successfully moved"); }
				else if(data.status = false) { alert("User not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	//This function is used to move Area from the system according their area_status 
	jQuery(document).on("click", ".moveArea", function(){
	
		var area_id = $(this).data("area_id"),
		    area_status = $(this).data("area_status"),
			hitURL = baseURL + "backoffice/moveArea",
			currentRow = $(this);
		var str="";
		var btnstr="";
		var c_status="";
		var addClassName = "";
		var addBtnClassName = "";
		var removeClassName = "";
		var removeBtnClassName = "";
		if(area_status=='0'){
			str="pending";
			
			btnstr="Accepted";
			c_status="1";
			addBtnClassName="btn-success";
			addClassName="label-warning";
			
			removeClassName="label-success";
			removeBtnClassName="btn-warning";
		}else{
			str="active";
			btnstr="Pending";
			c_status="0";
			
			addClassName="label-success";
			addBtnClassName="btn-warning";
			
			removeClassName="label-warning";
			removeBtnClassName="btn-success";
		}
		
		var confirmation = confirm("Are you sure to move this Area to "+str+" list?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { area_id : area_id,area_status:area_status } 
			}).done(function(data){
				console.log(data);
				
				currentRow.addClass(addBtnClassName);
				currentRow.data('area_status',c_status);
				currentRow.attr("title","move to "+btnstr);
				currentRow.html('<i class="fa fa-reply"></i> '+btnstr);
				currentRow.removeClass(removeBtnClassName);
				
				currentRow.parents('tr').find('.modify_class').addClass(addClassName);
				currentRow.parents('tr').find('.modify_class').html(str);
				currentRow.parents('tr').find('.modify_class').removeClass(removeClassName);
				if(data.status = true) { alert("Area successfully moved"); }
				else if(data.status = false) { alert("Area not successfully moved"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
