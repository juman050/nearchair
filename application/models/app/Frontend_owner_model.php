<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : frontend_owner_model (Owner Login Model)
 * @author : Emon
 * @version : 1.0
 * @since : 26 Augest 2019
 */
class frontend_owner_model extends CI_Model
{
    public function __construct() { 
        parent::__construct(); 
    }
    
    /**
     * This function is for adding multiple gallery image
     * @param string $business_id : Business Id
     * @param string $gallery_image : Gallery Images
     * @return boolean True/False
     */
    function add_gallery_image($business_id, $gallery_image)
    {
        if($gallery_image!='' )
        {
            $gallery_image1 = explode(',',$gallery_image);

            foreach($gallery_image1 as $file){

                $file_data = array(

                    'business_id' => $business_id,
                    'image' => $file,
                );

                $this->db->insert('business_gallery',$file_data);
            }

            return true;

        }else{
            return false;
        }

    }
    
    /**
     * This function is for getting business info for single owner
     * @return boolean True/False
     */
    function get_business_info($owner_id)
    {
        $this->db->select('business_id');
        $this->db->from('owner_businesses');
        $this->db->where('owner_id',$owner_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){

            $business_id = $query->row()->business_id;


            $this->db->select('businesses.*,city.city_name');
            $this->db->from('businesses as businesses');
            $this->db->join('cities as city','city.city_id = businesses.city_id');

            $this->db->where('businesses.business_id',$business_id);
            $this->db->where('businesses.isDeleted',0);
            $this->db->where('businesses.business_status',1);
            $this->db->where('city.isDeleted',0);
            $this->db->where('city.city_status',1);

            $query2 = $this->db->get();
            $business_details = $query2->result();
            $gallery_images = array();
            foreach ($business_details as $business) {

                $this->db->select('*');
                $this->db->from('business_gallery');
                $this->db->where('business_id',$business_id);
                $query3 = $this->db->get();
                $business->gallery_image = $query3->result();
            }
            return $business_details;

        }else{
            return false;
        }
    }


    
    /**
     * This function is for getting business category and services
     * @return boolean True/False
     */
    function get_seviceList($owner_id)
    {
        $this->db->select('business_id');
        $this->db->from('owner_businesses');
        $this->db->where('owner_id',$owner_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){

            $business_id = $query->row()->business_id;


            $this->db->select('business_services.*,categories.category_name');
            $this->db->from('business_services as business_services');
            $this->db->join('categories','categories.category_id = business_services.cat_id');

            $this->db->where('business_services.business_id',$business_id);
            $this->db->where('business_services.isDeleted',0);
            $this->db->where('categories.isDeleted',0);
            $this->db->where('categories.status',1);
            $this->db->order_by('business_services.cat_id','ASC');


            $query2 = $this->db->get();
            $service_details = $query2->result();
            return $service_details;

        }else{
            return false;
        }

    }
    
    /**
     * This function is for getting business category with count servicess
     * @return boolean True/False
     */
    function get_seviceCategory($owner_id)
    {
        $this->db->select('business_id');
        $this->db->from('owner_businesses');
        $this->db->where('owner_id',$owner_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){

            $business_id = $query->row()->business_id;


            $this->db->select('business_services.*,count(business_services.business_id) as totalNumber,categories.category_name');
            $this->db->from('business_services as business_services');
            $this->db->join('categories','categories.category_id = business_services.cat_id');

            $this->db->where('business_services.business_id',$business_id);
            $this->db->where('business_services.isDeleted',0);
            $this->db->where('categories.isDeleted',0);
            $this->db->where('categories.status',1);
            $this->db->group_by('business_services.cat_id');


            $query2 = $this->db->get();
            $service_details = $query2->result();
            return $service_details;

        }else{
            return false;
        }

    }


    function getBusinessOrders($businessId)
    {
        $this->db->select('orders.*,users.fullname as fullname,users.user_id as main_user_id');
        $this->db->where('orders.business_id', $businessId);
        $this->db->where("orders.isDeleted", 0);
        $this->db->where("orders.order_status !=", 0);
        $this->db->join('users','users.user_id = orders.user_id');
        $this->db->order_by('orders.order_id','DESC');
        $this->db->from('orders');
        $query = $this->db->get();
        return $query->result();
    }

    function getBusinessPendingOrders($businessId)
    {
        $this->db->select('orders.*,users.fullname as fullname,users.user_id as main_user_id');
        $this->db->where('orders.business_id', $businessId);
        $this->db->where("orders.isDeleted", 0);
        $this->db->where("orders.order_status", 0);
        $this->db->join('users','users.user_id = orders.user_id');
        $this->db->order_by('orders.order_id','DESC');
        $this->db->from('orders');
        $query = $this->db->get();
        return $query->result();
    }

    function getOrdersDetails($order_id)
    {
        
        $this->db->select('orders.*,users.fullname as fullname,users.image as user_image,users.gender as gender,users.email as user_email,users.mobile as user_mobile,users.address as user_address,users.city as user_city_id,users.area as user_area_id');
        $this->db->where('orders.order_id', $order_id);
        $this->db->where("orders.isDeleted", 0);
        $this->db->join('users','users.user_id = orders.user_id');
        $this->db->from('orders');
        $query = $this->db->get();
        return $query->result();

    }
    
    function getOrderServices($order_id)
    {
        $this->db->select('order_services.*,business_services.*');
        $this->db->where('order_services.order_id', $order_id);
        $this->db->join('business_services','business_services.service_id = order_services.service_id');
        $this->db->from('order_services');
        $query = $this->db->get();
        return $query->result();
    }
    
    function getOrderAdvanced($order_id)
    {
        $this->db->select('*');
        $this->db->where('order_id', $order_id);
        $this->db->from('order_appointments');
        $query = $this->db->get();
        return $query->result();
    }
    
    function isAnyOffer($bussiness_id)
    {
        $this->db->select('*');
        $this->db->where('business_id', $bussiness_id);
        $this->db->where('offer_status', 1);
        $this->db->from('business_offers');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_business_id($ownerId){
    	$this->db->select('business_id');
    	$this->db->from('owner_businesses');
    	$this->db->where('owner_id',$ownerId);
    	return $this->db->get()->row()->business_id;
    }
    
    function get_ratings($business_id){
        $this->db->select('*, SUM(rating) AS total_ratings, count(review_id) as total_review_ids', TRUE);
        $this->db->where('business_id',$business_id);
        $this->db->where('isDeleted',0);
        $query = $this->db->get('business_reviews');
        $result = $query->result();
        return $result;
    }
    
    function update_business_image($owner_id,$businessInfo){
        $this->db->where('owner_id',$owner_id);
        if($this->db->update('owners', $businessInfo))
        {
            return true;
        }else{
            return false;
        }
    }
    
}

?>