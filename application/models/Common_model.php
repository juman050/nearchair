<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Common (Common Model)
 * Common model class to get to handle All common data 
 * @author : juman
 * @version : 1.0
 * @since : 21 Augest 2019
 */
class Common_model extends CI_Model
{
    
    /**
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     * This function is used to get the owners businesses listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function ownersBusinessCount($searchText = '')
    {
        $this->db->select('owner_businesses.*,owners.owner_id,owners.owner_name,owners.owner_email,owners.owner_mobile,businesses.business_id,businesses.business_name');
        $this->db->from('owner_businesses');
        $this->db->join('owners', 'owners.owner_id = owner_businesses.owner_id','left');
        $this->db->join('businesses', 'businesses.business_id = owner_businesses.business_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(owners.owner_email  LIKE '%".$searchText."%'
                            OR  owners.owner_name  LIKE '%".$searchText."%'
                            OR  businesses.business_name  LIKE '%".$searchText."%'
                            OR  owners.owner_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('businesses.isDeleted', 0);
        $this->db->where('owners.isDeleted', 0);
        
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the owners businesss listing count
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function ownersBusiness($searchText = '', $page, $segment)
    {
        $this->db->select('owner_businesses.*,owners.owner_id,owners.owner_name,owners.owner_email,owners.owner_mobile,businesses.business_id,businesses.business_name');
        $this->db->from('owner_businesses');
        $this->db->join('owners', 'owners.owner_id = owner_businesses.owner_id','left');
        $this->db->join('businesses', 'businesses.business_id = owner_businesses.business_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(owners.owner_email  LIKE '%".$searchText."%'
                            OR  owners.owner_name  LIKE '%".$searchText."%'
                            OR  businesses.business_name  LIKE '%".$searchText."%'
                            OR  owners.owner_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('businesses.isDeleted', 0);
        $this->db->where('owners.isDeleted', 0);
        $this->db->order_by('businesses.business_id', 'DESC');
        
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     * This function is used to add business connection to owner
     * @return number $insert_id : This is last inserted id
     */
    function addNewOwnerToBusiness($resnfo){
        $this->db->trans_start();
        $this->db->insert('owner_businesses', $resnfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
     /**
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     * This function is used to check owners businesss listing count
     * @param string $owner_id : This is owners id
     * @param string $business_id : This is business id
     * @return number $count : This is row count
     */
    function checkOwnersBusiness($owner_id, $business_id){
        $this->db->select('owner_businesses.*');
        $this->db->from('owner_businesses');
        $this->db->where('owner_businesses.owner_id', $owner_id);
        $this->db->where('owner_businesses.business_id', $business_id);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     * This function is used to delete owners businesss
     ** @param string $id : This is primary id for the table
     */
    function deleteOwnersBusiness($id){
        $this->db->where('id', $id);
        $this->db->delete('owner_businesses');
        return TRUE;
    }
    /**
     * This function is used to delete the slider information
     * @param number $area_id : This is slider_id 
     * @return boolean $result : TRUE / FALSE
     */
    function deleteSlider($slider_id, $sliderInfo){
        $this->db->where('slider_id', $slider_id);
        $this->db->update('sliders', $sliderInfo);
        
        return $this->db->affected_rows();
    }
    
    /**
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     * This function is used to get the business list
     */
    function getAllBusinesses()
    {
        $this->db->select('*');
        $this->db->from('businesses');
        $this->db->where('businesses.isDeleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * This function is used to get the owners list
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     */
    function getAllOwners()
    {
        $this->db->select('*');
        $this->db->from('owners');
        $this->db->where('owners.isDeleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    /**
     * This function is used to get the system information
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     */
    function get_system_info(){
        $this->db->select('*');
        $this->db->from('settings');
        $query = $this->db->get();
        return $query->row();
    }
    
    /**
     * This function is used to add system information
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     */
    function insertSystemData($data){
        $this->db->trans_start();
        $this->db->insert('settings', $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    /**
     * This function is used to update system data
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     */
    function updateSystemData($data){
        $this->db->where('id', 1);
        $this->db->update('settings', $data);
        return TRUE;
    }
     /**
     * This function is used to load slider Data
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     */
    function get_sliders(){
        $this->db->select('*');
        $this->db->from('sliders');
        $this->db->where('sliders.isDeleted','0');
        $this->db->order_by('sliders.slider_order', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    /**
     * This function is used to add slider information
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     */
    function addNewSlider($data){
        $this->db->trans_start();
        $this->db->insert('sliders', $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    /**
     * This function is used to sort slider Data
     * @author : juman
     * @version : 1.0
     * @since : 21 Augest 2019
     */
    function getSortedSliders($position){
        $i=1;
        foreach($position as $v){
        $data = array(
            'slider_order' => $i
        );
        $this->db->where("sliders.slider_id", $v);
        $this->db->update("sliders", $data);
        $i++;
        }
    }
    /**
     * This common function is for getting categories data by type.
     * @author : Juman
     * @version : 1.0
     * @since : 12 oct 2019
     */ 
    function getAllCategoryByType($con)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('category_type',$con);
        $this->db->order_by('category_id','ASC');
        return $this->db->get();
    }
    /**
     * This function used to get service name 
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
     * @param {int} $service_id : This is the service id
     * @param {int} $business_id : This is the business id
    */
    function getServiceName($service_id,$business_id){
        $query = $this->db->get_where('business_services', ['service_id' => $service_id,'business_id'=>$business_id]);
        $result = $query->row();
        return $result->service_name;
    }
     /**
     * This function used to get service name 
     * @author : juman
     * @version : 1.0
     * @since : 06 oct 2019
     * @param {int} $service_id : This is the service id
    */
    function getHomeServiceName($service_id){
        $query = $this->db->get_where('services', ['serviceId' => $service_id]);
        $result = $query->row();
        return $result->serviceName;
    }
    
    /**
     * This function used to get business name 
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
     * @param {int} $business_id : This is the business id
    */
    function getBusinessName($business_id){
        $this->db->select('business_name');
        $query = $this->db->get_where('businesses', ['business_id'=>$business_id]);
        $result = $query->row();
        return $result->business_name;
    }
    /**
     * This function used to get business data 
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
     * @param {int} $business_id : This is the business id
    */
    function getBusinessData($business_id){
        $this->db->select('*');
        $query = $this->db->get_where('businesses', ['business_id'=>$business_id]);
        $result = $query->row();
        return $result;
    }
    
    /**
     * This function used to get service from cart 
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
     * @param {int} $service_id : This is the service id
     * @param {int} $business_id : This is the business id
    */
    function checkServiceCart($service_id,$business_id){
        $bag = $this->cart->contents();
        $count=0;
        foreach ($bag as $item) {
            $item_id[0] = $item['id'];
            $business_id[0] = $item['business_id'];
            if ($item_id[0] == $service_id && $business_id[0]== $business_id) {
                $count++;
            }
        }
        return $count;
    }
    /**
     * This function used to get service from cart 
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
     * @param {int} $service_id : This is the service id
    */
    function checkHomeServiceCart($service_id){
        $count=0;
        if(!empty($_SESSION["shopping_cart"])) {
            $array_keys = array_keys($_SESSION["shopping_cart"]);
            foreach($_SESSION["shopping_cart"] as $value){
                if($service_id==$value['serviceId']) {
                	$count++;
                }
            }
            
        }
        return $count;
    }
    
    /**
     * This function used to check business in cart 
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
     * @param {int} $business_id : This is the business id
    */
    function checkBusinessInCart($business_id){
        $bag = $this->cart->contents();
        $bag = $this->cart->contents();
        $count=0;
        foreach ($bag as $item) {
            if($business_id !== $item['business_id']){
                $count = "0";
            }else{
                $count = "1";
            }
        }
        return $count;
    }
    
    /**
     * This function used to get avg review
     * @author : juman
     * @version : 1.0
     * @since : 13 sept 2019
     * @param {int} $business_id : This is the business id
    */
    function ratingAvg($business_id){
        $this->db->select('AVG(rating) avg_rating');
        $this->db->from('business_reviews');
        $this->db->where('business_reviews.business_id', $business_id);
        $query = $this->db->get();
        $result = $query->row();        
        return round($result->avg_rating);
    }
    /**
     * This function used to get total review
     * @author : juman
     * @version : 1.0
     * @since : 13 sept 2019
     * @param {int} $business_id : This is the business id
    */
    function totalReview($business_id){
        $this->db->select('business_reviews.business_id');
        $this->db->from('business_reviews');
        $this->db->where('business_reviews.business_id', $business_id);
        $query = $this->db->get();
        $rows = $query->num_rows();        
        return $rows;
    }
    
    /**
     * author: juman
     * since :24-sept-2019
     * This function is used to get the cities
     * @return array $result : This is result
     */
    function getCities()
    {
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('cities.city_status', 1);
        
        $this->db->order_by('cities.city_id', 'ASC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
     /**
     * author: juman
     * since :22-sept-2019
     * This function is used to get the area under city sing city id
     * @param number $city_id : This is city_id 
     * @return string $result 
     */
    function getAreaUnderCity($city_id){
        $this->db->select('*');
        $this->db->from('areas');
        $this->db->where('city_id', $city_id);
        $this->db->where('isDeleted', 0);
        $this->db->where('area_status', 1);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    /**
     * author: juman
     * since :22-sept-2019
     * This function is used to get the area name
     * @param number $area_id : This is area_id 
     * @return string $result 
     */
    function getAreaName($area_id){
        $this->db->select('*');
        $this->db->from('areas');
        $this->db->where('area_id', $area_id);
        $this->db->where('isDeleted', 0);
        $this->db->where('area_status', 1);
        $query = $this->db->get();
        $result = $query->row();        
        return $result->area_name;
    }
    /**
     * author: juman
     * since :24-sept-2019
     * This function is used to check valid area and city
     * @param number $city_id : This is city_id 
     * @param number $area_id : This is area_id 
     * @return string $result 
     */
    function checkValidLocation($city_id,$area_id){
        $this->db->select('area_id,city_id');
        $this->db->from('areas');
        $this->db->where('area_id', $area_id);
        $this->db->where('city_id', $city_id);
        $this->db->where('isDeleted', 0);
        $this->db->where('area_status', 1);
        $query = $this->db->get();
        $result = $query->num_rows();        
        return $result;
    }
    /**
     * author: juman
     * since :30-sept-2019
     * This function is used to check valid coupon code
     * @param text $coupon_code : This is coupon code 
     * @param datetime $cur_time : This is current time 
     * @return string $result 
     */
    function applyCoupon($coupon_code,$cur_time){
        $this->db->select('*');
        $this->db->from('coupons');
        $this->db->where('isDeleted', 0);
        $this->db->where('coupon_status', 1);
        $this->db->where('coupon_code', $coupon_code);
        $this->db->where('end_date_time >', $cur_time);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function checkUserUsage($userId,$coupon_id){
        $this->db->select('*');
        $this->db->from('coupon_used');
        $this->db->where('user_id', $userId);
        $this->db->where('coupon_id', $coupon_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $result = $query->num_rows();        
        return $result;
    }
    
     /**
     * author: juman
     * since :13-oct-2019
     * This function is used to get business offer by business_id
     * @param number $business_id : This is business_id
     * @return array $result 
     */
    function checkBusinessOffer($business_id){
        $tz = 'Asia/Dhaka';
        $tz_obj = new DateTimeZone($tz);
        $today = new DateTime("now", $tz_obj);
        $cur_time = $today->format('Y-m-d H:i:s');
        $this->db->select('*');
        $this->db->from('business_offers');
        $this->db->where('business_id', $business_id);
        $this->db->where('isDeleted', 0);
        $this->db->where('offer_status', 1);
        $this->db->where('end_time >', $cur_time);
        
        $query = $this->db->get();
        
        return $query->row();
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
    
}