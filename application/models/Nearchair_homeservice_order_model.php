<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Nearchair_homeservice_order_model (Nearchair homeservice Order Model)
 * Nearchairorder model class to get to handle homeservice order related data 
 * @author : juman
 * @version : 1.0
 * @since : 09 oct 2019
 */
class Nearchair_homeservice_order_model extends CI_Model
{

	/**
     * This function is used to get the homrservice order listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function orderListingCount($searchText = '',$fromDate, $toDate,$attr= '')
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('order_homeservice as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.orderId  LIKE '%".$searchText."%'
                            OR  BaseTbl.customer_name  LIKE '%".$searchText."%')";
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
     * This function is used to get the homrservice order listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function orderListing($searchText = '',$fromDate = '', $toDate = '', $page, $segment,$attr = '')
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('order_homeservice as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.orderId  LIKE '%".$searchText."%'
                            OR  BaseTbl.customer_name  LIKE '%".$searchText."%')";
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
        $this->db->order_by('BaseTbl.orderId', 'DESC');
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
        $this->db->where('orderId', $order_id);
        $this->db->update('order_homeservice', $orderInfo);
        
        return $this->db->affected_rows();
    }
    
     /**
     * This function is used to move the order information
     * @param number $order_id : This is order_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveOrder($order_id, $orderInfo)
    {
        $this->db->where('orderId', $order_id);
        $this->db->update('order_homeservice', $orderInfo);
        
        return $this->db->affected_rows();
    }
    
    
    /**
     * This function is for getting business category and services
     * @return boolean True/False
     */
    function get_seviceList()
    {
        $this->db->select('services.*,categories.category_name,categories.category_type');
        $this->db->from('services as services');
        $this->db->join('categories','categories.category_id = services.catId');

        $this->db->where('services.isDeleted',0);
        $this->db->where('categories.isDeleted',0);
        $this->db->where('categories.status',1);
        $this->db->order_by('services.catId','ASC');

        $query = $this->db->get();
        return $query->result();

    }

    
     /**
     * This function is used to get single category information
     * @return boolean $result : All Categories / FALSE
     */
    function get_singleService($service_id)
    {
        $this->db->select('*');
        $this->db->from('services');
        $this->db->where('serviceId',$service_id);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to add new business to system
     * @return number $insert_id : This is last inserted id
     */
    function insertData($table,$service_info)
    {
        $this->db->trans_start();
        $this->db->insert($table, $service_info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    

    /**
     * This function is used to update
     * @param $table : table name
     * @param $where : condition for update data
     * @param $data : updated data NB. check table field name of $data index
     * @author : Emon
     * @version : 1.0
     * @since : 9 oct 2019

     */
    function where_update($table,$where=array(), $data=array())
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        
        return TRUE;
    }

    function getOrdersDetails($order_id)
    {
        
        $this->db->select('order_homeservice.*');
        $this->db->where('order_homeservice.orderId', $order_id);
        $this->db->where("order_homeservice.isDeleted", 0);
        $this->db->from('order_homeservice');
        $query = $this->db->get();
        return $query->result();

    }
    function getOrderServices($order_id)
    {
        $this->db->select('order_homeservices.*,services.*');
        $this->db->where('order_homeservices.orderId', $order_id);
        $this->db->join('services','services.serviceId = order_homeservices.serviceId');
        $this->db->from('order_homeservices');
        $query = $this->db->get();
        return $query->result();
    }
    


}