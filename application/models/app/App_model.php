<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : App_model
 * App model for App
 * @author : Juman
 * @version : 1.0
 * @since : 04 Sept 2019
 */
class App_model extends CI_Model
{

    /**
     * This common function is for getting categories data.
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     */ 
    function get_categories()
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where(array('isDeleted'=>0,'status'=>1));
        $this->db->order_by('category_id','ASC');
        return $this->db->get()->result();
    }
    
    function get_categories1($con)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where($con);
        $this->db->order_by('category_id','ASC');
        return $this->db->get()->result();
    }
    function get_categories2($con)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where($con);
        $this->db->order_by('category_id','ASC');
        return $this->db->get()->result();
    }
    function get_categories3($con)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where($con);
        $this->db->order_by('category_id','ASC');
        return $this->db->get()->result();
    }
    
    /**
     * This function used to get service under ctageory
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     * @param {int} $category_id : This is the category id
     * @param {int} $business_id : This is the business id
    */
    function getBusinessServiceUnderCategory($category_id,$business_id){
        $this->db->select('*');
        $this->db->from('business_services');
        $this->db->where(array('cat_id'=>$category_id,'business_id'=>$business_id,'isDeleted'=>0));
        $this->db->order_by('service_id','ASC');
        return $this->db->get()->result();
    }
     /**
     * This function used to get service under ctageory
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     * @param {int} $category_id : This is the category id
    */
    function getHomeServiceUnderCategory($category_id){
        $this->db->select('*');
        $this->db->from('services');
        $this->db->where(array('catId'=>$category_id,'isDeleted'=>0));
        $this->db->order_by('serviceId','ASC');
        return $this->db->get()->result();
    }
    
   
    
    /**
     * This function used to get total services under a ctageory
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     * @param {int} $category_id : This is the category id
     * @param {int} $business_id : This is the business id
    */
    function getTotalService($category_id,$business_id){
        $this->db->select('*');
        $this->db->from('business_services');
        $this->db->where(array('cat_id'=>$category_id,'business_id'=>$business_id,'isDeleted'=>0));
        $this->db->order_by('service_id','ASC');
        return $this->db->get()->num_rows();
    }
    /**
     * This function used to get total services under a ctageory
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     * @param {int} $category_id : This is the category id
    */
    function getTotalHomeService($category_id){
        $this->db->select('*');
        $this->db->from('services');
        $this->db->where(array('catId'=>$category_id,'isDeleted'=>0));
        $this->db->order_by('serviceId','ASC');
        return $this->db->get()->num_rows();
    }

    /**
     * This common function is for getting sliders data.
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     */ 

    function get_sliders()
    {
        $this->db->select('*');
        $this->db->from('sliders');
        $this->db->where('sliders.isDeleted','0');
        $this->db->order_by('slider_order','ASC');
        return $this->db->get()->result();
    }
    
    /**
     * This function is used to get single category
     * @param number $category_id : This is category id 
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     */ 
    function get_single_category($category_id){
        $this->db->select('categories.*');
        $this->db->from('categories');
        $this->db->where('categories.category_id', $category_id);
        $this->db->where('categories.status', 1);
        $this->db->where('categories.isDeleted', 0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }
    
    function get_serviceInfo($service_id){
        $this->db->select('business_services.*');
        $this->db->from('business_services');
        $this->db->where('business_services.service_id', $service_id);
        //$this->db->where('business_services.status', 1);
        $this->db->where('business_services.isDeleted', 0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }
    
    /**
     * This function is used to get single category information with services
     * @param number $category_id : This is category_id 
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     */ 
    function get_category_services($category_id){
        
        $this->db->select('BaseTbl.category_id,BaseTbl.category_name,BaseTbl.category_img,Service.service_id,Service.service_name,Service.service_slug');
        $this->db->from('categories as BaseTbl');
        $this->db->join('business_services as Service', 'Service.cat_id = BaseTbl.category_id','left');
        $this->db->where('BaseTbl.category_id', $category_id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 1);
        $this->db->where('Service.isDeleted', 0);
        $this->db->group_by('Service.service_name');
        $this->db->order_by('Service.service_name', 'ASC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
        
        
    }
    
    /**
     * This function is used to get single category information with services
     * @param number $category_id : This is category_id 
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     */ 
    function get_category_home_services($category_id){
        
        $this->db->select('BaseTbl.category_id,BaseTbl.category_name,BaseTbl.category_img,Service.serviceId,Service.serviceName,Service.servicePrice,Service.serviceTime,Service.serviceSlug');
        $this->db->from('categories as BaseTbl');
        $this->db->join('services as Service', 'Service.catId = BaseTbl.category_id','left');
        $this->db->where('BaseTbl.category_id', $category_id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 1);
        $this->db->where('Service.isDeleted', 0);
        $this->db->group_by('Service.serviceName');
        $this->db->order_by('Service.serviceId', 'ASC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
        
        
    }
    
    
    /**
     * This function is used to get business list with services
     * @param string $name : This is service name 
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     */ 
    
    function get_businesses_by_service($service_name){
        $this->db->select('BaseTbl.service_id,BaseTbl.service_name,BaseTbl.service_slug,BaseTbl.cat_id,BaseTbl.business_id,BaseTbl.service_time,Business.business_id,
        Business.business_name,Business.business_slug,Business.business_img,Business.total_chairs,Business.address,Business.city_id,Business.area_id,Business.business_on_off,Business.business_type,Business.opening_time,Business.closing_time');
        $this->db->from('business_services as BaseTbl');
        $this->db->join('businesses as Business', 'Business.business_id = BaseTbl.business_id','left');
        $this->db->where('BaseTbl.service_name', $service_name);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('Business.business_status', 1);
        $this->db->where('Business.isDeleted', 0);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get nearest business list 
     * @param number $attr : This is an array
     * @author : Juman
     * @version : 1.0
     * @since : 24 Sept 2019
     */ 
    
    function get_nearest_businesses($attr){
        $this->db->select('*');
        $this->db->from('businesses');
        if(!empty($attr)){
            $this->db->where($attr);
        }
        $this->db->where('businesses.business_status', 1);
        $this->db->where('businesses.isDeleted', 0);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    
    /**
     * This function is used to get business id
     * @param number $slug : This is business slug 
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     */ 
    function get_business_id($slug){
        $this->db->select('businesses.business_id');
        $this->db->from('businesses');
        $this->db->where('businesses.business_slug', $slug);
        $this->db->where('businesses.business_status', 1);
        $this->db->where('businesses.isDeleted', 0);
        $query = $this->db->get();
        
        $result = $query->row();        
        return $result->business_id;
    }
    
    function getSingleOrder($order_id){
        $this->db->select('orders.business_id');
        $this->db->from('orders');
        $this->db->where('orders.order_id', $order_id);
        $query = $this->db->get();
        
        $result = $query->row();        
        return $result->business_id;
    }
    
    /**
     * This function is used to get business gallery images
     * @param number $business_id : This is business id 
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     */ 
    function get_business_gallery($business_id){
        $this->db->select('business_gallery.*');
        $this->db->from('business_gallery');
        $this->db->where('business_gallery.business_id', $business_id);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    /**
     * This function is used to get business details with services
     * @param number $slug : This is business slug 
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     */ 
    function get_business_by_slug($slug){
        $this->db->select('Business.*');
        $this->db->from('businesses as Business');
        $this->db->where('Business.business_slug', $slug);
        $this->db->where('Business.business_status', 1);
        $this->db->where('Business.isDeleted', 0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }
    
    /**
     * This function is used to check business is available for order
     * @param number $business_id : This is business id 
     * @author : Juman
     * @version : 1.0
     * @since : 09 Sept 2019
     */ 
    function checkBusinessAvailable($business_id){
        $this->db->select('businesses.business_id');
        $this->db->from('businesses');
        $this->db->where('businesses.business_id', $business_id);
        $this->db->where('businesses.business_status', 1);
        $this->db->where('businesses.business_on_off', 1);
        $this->db->where('businesses.isDeleted', 0);
        $query = $this->db->get();
        $result = $query->num_rows();        
        return $result;
    }
    
    /**
     * This function is used to book order now
     * @author : Juman
     * @version : 1.0
     * @since : 07 Sept 2019
     */ 
    function bookOrderNow($order_type,$order_total,$payment_method,$business_id,$user_id,$transaction_id){
        $this->db->trans_start();
        $order_data = array();
        
        $order_data['user_id']=$user_id;
        $order_data['business_id']=$business_id;
        $order_data['order_type']=$order_type;
        $order_data['payment_method']=$payment_method;
        $order_data['transaction_id']=$transaction_id;
        $order_data['order_subtotal']=str_replace(',', '', $this->cart->total());
        $order_data['order_total']=str_replace(',', '', $order_total);
        date_default_timezone_set("Asia/Dhaka");
	    $order_data['order_date'] = date('Y-m-d H:i:s');
	    $order_data['createdDtm'] = date('Y-m-d H:i:s');
        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();
        
        
        $cart_data = $this->cart->contents(); 
        foreach($cart_data as $cart) {
            $order_services= array();
            $order_services['order_id'] = $order_id;
            $order_services['service_id'] = $cart['id'];
            $order_services['service_price'] = str_replace(',', '', $cart['price']);
            $order_services['business_id'] = $business_id;
            $this->db->insert('order_services', $order_services);
        } 
        
        
        if($this->session->userdata('coupon_id')){
            $coupon_used_data = array(
                'coupon_id'=>$this->session->userdata('coupon_id'),
                'user_id'=>$user_id,
                'order_id'=>$order_id,
                'status'=>'0'
            );
            $this->db->insert('coupon_used', $coupon_used_data);
        }
        
        $this->db->trans_complete();
        return $order_id;
    }
    
    /**
     * This function is used to book homeservice order now
     * @author : Juman
     * @version : 1.0
     * @since : 06 oct 2019
     */ 
    function homeserviceOrder($order_data){
        $this->db->trans_start();
        $this->db->insert('order_homeservice', $order_data);
        $order_id = $this->db->insert_id();
        foreach($_SESSION["shopping_cart"] as $cart) {
            $order_services= array();
            $order_services['orderId'] = $order_id;
            $order_services['serviceId'] = $cart['serviceId'];
            $order_services['servicePrice'] = str_replace(',', '', $cart['servicePrice']);
            $this->db->insert('nearchair_order_homeservices', $order_services);
        } 
        $this->db->trans_complete();
        return $order_id;
    }
    
    
    /**
     * This function is used to book advance order
     * @author : Juman
     * @version : 1.0
     * @since : 07 Sept 2019
     */ 
    function advanceBookingOrder($order_type,$order_total,$payment_method,$business_id,$user_id,$datetime,$transaction_id){
        $this->db->trans_begin();
        $order_data = array();
        
        $order_data['user_id']=$user_id;
        $order_data['business_id']=$business_id;
        $order_data['order_type']=$order_type;
        $order_data['payment_method']=$payment_method;
        $order_data['transaction_id']=$transaction_id;
        $order_data['order_subtotal']=str_replace(',', '', $this->cart->total());
        $order_data['order_total']=str_replace(',', '', $order_total);
        date_default_timezone_set("Asia/Dhaka");
	    $order_data['advance_order_date'] = $datetime;
	    $order_data['order_date'] = date('Y-m-d H:i:s');
	    $order_data['createdDtm'] = date('Y-m-d H:i:s');
	    
	    
        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();
        
        
        $service_time= array();
        $new_time = "00:00";
        $cart_data = $this->cart->contents(); 
        foreach($cart_data as $cart) {
            $order_services= array();
            $order_services['order_id'] = $order_id;
            $order_services['service_id'] = $cart['id'];
            $order_services['service_price'] = str_replace(',', '', $cart['price']);
            $order_services['business_id'] = $business_id;
            $this->db->insert('order_services', $order_services);
            $hour_one = $new_time;
            $hour_two = $cart['service_time'];
            
            $h =  strtotime($hour_one);
            $h2 = strtotime($hour_two);
            
            $minute = date("i", $h2);
            $hour = date("H", $h2);
            
            $convert = strtotime("+$minute minutes", $h);
            $convert = strtotime("+$hour hours", $convert);
            
            $new_time = date('H:i', $convert);
        } 
        
        
        
        $appointment_data=array();
        $appointment_data['order_id'] = $order_id;
        $appointment_data['business_id'] = $business_id;
        $appointment_data['appointment_start'] = $datetime;
        $end = explode(" ",$datetime);
        $appointment_data['appointment_end'] = $end[0]." ".$new_time;
        
        $this->db->insert('order_appointments', $appointment_data);
        
        if($this->session->userdata('coupon_id')){
            $coupon_used_data = array(
                'coupon_id'=>$this->session->userdata('coupon_id'),
                'user_id'=>$user_id,
                'order_id'=>$order_id,
                'status'=>'0'
            );
            $this->db->insert('coupon_used', $coupon_used_data);
        }
        
        $this->db->trans_complete();
        return $order_id;
    }
    
    /**
     * This function is used to get business reviews
     * @param number $business_id : This is business_id
     * @param number $rowperpage : row per page
     * @param number $limit : limit
     * @author : Juman
     * @version : 1.0
     * @since : 11 Sept 2019
     */ 
    function get_business_reviews($business_id,$rowperpage,$limit){
        
        $this->db->select('BaseTbl.*,User.user_id,User.fullname,User.email,User.image');
        $this->db->from('business_reviews as BaseTbl');
        $this->db->join('users as User', 'User.user_id = BaseTbl.user_id','left');
        $this->db->where('BaseTbl.business_id', $business_id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by("BaseTbl.review_id", "asc");
        $this->db->limit($rowperpage, $limit);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    /**
     * This function is used toadd new business reviews
     * @author : Juman
     * @version : 1.0
     * @since : 11 Sept 2019
     */ 
    function addnew_business_reviews($data){
        $this->db->insert('business_reviews', $data);
        $review_id = $this->db->insert_id();
        return $review_id;
    }
    
    /**
     * This function used to check current user has review
     * @author : Juman
     * @version : 1.0
     * @since : 11 Sept 2019
     * @param {int} $business_id : This is the business id
     */
    
    function checkCurrentUserReview($business_id){
        $user_id = get_cookie('user_id');
        $this->db->select('business_reviews.user_id,business_reviews.business_id');
        $this->db->from('business_reviews');
        $this->db->where('business_reviews.user_id', $user_id);
        $this->db->where('business_reviews.business_id', $business_id);
        $query = $this->db->get();
        $result = $query->num_rows(); 
        return $result;
    }
    
    
    
    /**
     * This function is used to get single user
     * @param number $user_id : This is user id
     * @author : Juman
     * @version : 1.0
     * @since : 13 Sept 2019
     */ 
    function get_user($user_id){
        $this->db->select('users.user_id,users.fullname');
        $this->db->from('users');
        $this->db->where('users.user_id', $user_id);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }
    /**
     * This function is used to get review count of a business
     * @param number $business_id : This is business id
     * @author : Juman
     * @version : 1.0
     * @since : 13 Sept 2019
     */ 
    function get_business_reviews_count($business_id){
        $this->db->select('BaseTbl.*,User.user_id,User.fullname,User.email');
        $this->db->from('business_reviews as BaseTbl');
        $this->db->join('users as User', 'User.user_id = BaseTbl.user_id','left');
        $this->db->where('BaseTbl.business_id', $business_id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by("BaseTbl.review_id", "asc");
        $query = $this->db->get();
        
        $rows = $query->num_rows();        
        return $rows;
    }
    
    /**
     * This function is used to search business by keyword
     * @param {string} $keyword : This is search value
     * @author : Juman
     * @version : 1.0
     * @since : 14 Sept 2019
     */
    function searchBusiness($keyword){
        $this->db->select("businesses.business_id,businesses.business_name,businesses.business_slug,businesses.business_img,businesses.address,businesses.business_status");
        $this->db->where('businesses.business_status', "1");
        $this->db->where('businesses.isDeleted',0);
        $this->db->like('businesses.business_name',$keyword);
        $this->db->or_like('businesses.address',$keyword);
        $this->db->limit(5);
        $data = $this->db->get("businesses");
        return $data->result();
    }
    
    
    /**
     * This function used to get total services under a ctageory
     * @author : Juman
     * @version : 1.0
     * @since : 04 Sept 2019
     * @param {int} $category_id : This is the category id
    */
    function check_reviewed($order_id,$business_id,$user_id){
        $this->db->select('*');
        $this->db->from('business_reviews');
        $this->db->where(array('order_id'=>$order_id,'business_id'=>$business_id,'user_id'=>$user_id));
        return $this->db->get()->result();
    }
    
    
    
}