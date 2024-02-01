<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Nearchair_order_model (Nearchair Order Model)
 * Nearchairorder model class to get to handle order related data 
 * @author : juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class Nearchair_order_model extends CI_Model
{

	/**
     * This function is used to get the order listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function orderListingCount($searchText = '',$fromDate, $toDate,$attr= '')
    {
        $this->db->select('BaseTbl.*,businesses.business_name,businesses.city_id,businesses.mobile_number,users.fullname,users.mobile');
        $this->db->from('orders as BaseTbl');
        $this->db->join('businesses', 'BaseTbl.business_id = businesses.business_id','left');
        $this->db->join('users', 'BaseTbl.user_id = users.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.order_id  LIKE '%".$searchText."%'
                            OR  businesses.business_name  LIKE '%".$searchText."%'
                            OR  users.fullname  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.order_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.order_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($attr)){
            $this->db->where($attr);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the order listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function orderListing($searchText = '',$fromDate = '', $toDate = '', $page, $segment,$attr = '')
    {
        $this->db->select('BaseTbl.*,businesses.business_name,businesses.city_id,businesses.mobile_number,users.fullname,users.mobile');
        $this->db->from('orders as BaseTbl');
        $this->db->join('businesses', 'BaseTbl.business_id = businesses.business_id','left');
        $this->db->join('users', 'BaseTbl.user_id = users.user_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.order_id  LIKE '%".$searchText."%'
                            OR  businesses.business_name  LIKE '%".$searchText."%'
                            OR  users.fullname  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.order_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.order_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($attr)){
            $this->db->where($attr);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.order_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to delete the order information
     * @param number $order_id : This is order_id 
     * @return boolean $result : TRUE / FALSE
     */
    function deleteOrder($order_id, $orderInfo)
    {
        $this->db->where('order_id', $order_id);
        $this->db->update('orders', $orderInfo);
        
        return $this->db->affected_rows();
    }
    
    /**
     * This function is used to move the order information
     * @param number $order_id : This is order_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveOrder($order_id, $orderInfo)
    {
        $this->db->where('order_id', $order_id);
        $this->db->update('orders', $orderInfo);
        
        return $this->db->affected_rows();
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
    function getBusinessDetails($business_id){
        $this->db->select('businesses.*,cities.city_id,cities.city_name,areas.area_id,areas.area_name');
        $this->db->where("businesses.isDeleted", 0);
        $this->db->join('cities','cities.city_id = businesses.city_id');
        $this->db->join('areas','areas.area_id = businesses.area_id');
        $this->db->from('businesses');
        $this->db->where('businesses.business_id', $business_id);
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
    
    
}