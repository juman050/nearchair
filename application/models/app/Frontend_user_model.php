<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : frontend_user_model (User Model)
 * @author : Emon
 * @version : 1.0
 * @since : 10 sept 2019
 */
class frontend_user_model extends CI_Model
{
    public function __construct() { 
        parent::__construct();
    }
    

    /**
     * This function is for checking username exists or not
     * @return boolean True/False
     */
    function check_number($mobile)
    {
        $this->db->select('*');
        $this->db->from("users");
        $this->db->where("mobile", $mobile);   
        $this->db->where("isDeleted", 0);
        $this->db->where("user_status", 1);

        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is for checking username exists or not
     * @return boolean True/False
     */
    function checkOldpassword($oldPassword,$userId)
    {
        $this->db->select('user_id, password');
        $this->db->from("users"); 
        $this->db->where("user_id", $userId);
        $this->db->where("isDeleted", 0);
        $this->db->where("user_status", 1);

        $query = $this->db->get();

        $user = $query->result();
        
        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
        
    }

    function changePassword($userId, $userInfo)
    {
        $this->db->where('user_id', $userId);
        $this->db->where("isDeleted", 0);
        $this->db->where("user_status", 1);
        $this->db->update('users', $userInfo);
        if($this->db->affected_rows()){
            return true;
        }else{
            echo false;
        }
    }

    function changeForgotPassword($mobile, $userInfo)
    {
        $this->db->where('mobile', $mobile);
        $this->db->where("isDeleted", 0);
        $this->db->where("user_status", 1);
        $this->db->update('users', $userInfo);
        if($this->db->affected_rows()){
            return true;
        }else{
            echo false;
        }
    }

    function getUserProfile($userId)
    {
        $this->db->select('users.*');
        $this->db->where('user_id', $userId);
        $this->db->where("isDeleted", 0);
        $this->db->where("user_status", 1);
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }

    function getUserOrders($userId)
    {
        $this->db->select('orders.*,businesses.business_name as business_name,businesses.address as address,businesses.city_id as city_id,cities.city_name as city_name');
        $this->db->where('orders.user_id', $userId);
        $this->db->where("orders.isDeleted", 0);
        $this->db->join('businesses','businesses.business_id = orders.business_id');
        $this->db->join('cities','cities.city_id = businesses.city_id');
        $this->db->order_by('orders.order_id','DESC');
        $this->db->from('orders');
        $query = $this->db->get();
        return $query->result();
    }
    
    function getOrdersDetails($order_id)
    {
        $this->db->select('orders.*,businesses.business_name as business_name,businesses.business_slug as business_slug,businesses.address as address,businesses.city_id as city_id,cities.city_name as city_name');
        $this->db->where('orders.order_id', $order_id);
        $this->db->where("orders.isDeleted", 0);
        $this->db->join('businesses','businesses.business_id = orders.business_id');
        $this->db->join('cities','cities.city_id = businesses.city_id');
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
    
    function get_where()
    {
        $this->db->select('*');
        $this->db->from('areas');
        $where = array('city_id'=>1,'area_status'=>1,'isDeleted'=>0);
        $this->db->where($where);
        $this->db->order_by('area_name','ASC');
        return $this->db->get()->result();
    }

}

?>