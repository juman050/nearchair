<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Nc_model (Nearchair Order Model)
 * Nc_model  class to get to handle order related data 
 * @author : juman
 * @version : 1.0
 * @since : 03 nov 2019
 */
class Nc_model extends CI_Model
{

    
    /**
     * This function is used to get the order listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function orders($attr = '')
    {
        $this->db->select('BaseTbl.*,businesses.business_name,businesses.city_id,businesses.mobile_number,users.fullname,users.mobile');
        $this->db->from('orders as BaseTbl');
        $this->db->join('businesses', 'BaseTbl.business_id = businesses.business_id','left');
        $this->db->join('users', 'BaseTbl.user_id = users.user_id','left');
        if(!empty($attr)){
            $this->db->where($attr);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.order_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    function moveOrder($order_id, $orderInfo)
    {
        $this->db->where('order_id', $order_id);
        $this->db->update('orders', $orderInfo);
        
        return $this->db->affected_rows();
    }
    
    function ownerUpdateToken($ownerId,$updateData){
        $this->db->where('owner_id',$ownerId);
        $this->db->update('owners', $updateData);
        if($this->db->affected_rows())
        {
            return true;
        }else{
            return false;
        }
    }
    

}