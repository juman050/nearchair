<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Nearchaircoupon_model (Nearchaircoupon Model)
 * Nearchaircoupon model class to get to handle coupon related data 
 * @author : juman
 * @version : 1.0
 * @since : 16 Augest 2019
 */
class Nearchair_coupon_model extends CI_Model
{

	/**
     * This function is used to get the coupon listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function couponListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('coupons');
        if(!empty($searchText)) {
            $likeCriteria = "(coupons.coupon_title  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('coupons.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the coupon listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function couponListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('coupons');
        if(!empty($searchText)) {
            $likeCriteria = "(coupons.coupon_title  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('coupons.isDeleted', 0);
        $this->db->order_by('coupons.coupon_id', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    /**
     * This function is used to add new coupon 
     * @param array $couponData : This is coupon all data
     * @return number $insert_id : This is last insert id
     */
    function addNewcoupon($couponData){
        $this->db->trans_start();
        $this->db->insert('coupons', $couponData);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function is used to get single coupon information
     * @param number $coupon_id : This is coupon_id 
     * @return boolean $result : TRUE / FALSE
     */
    function getCouponInfo($coupon_id)
    {
        $this->db->select('*');
        $this->db->from('coupons');
        $this->db->where('isDeleted', 0);
        $this->db->where('coupon_id', $coupon_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    /**
     * This function is used to update the coupon information
     * @param array $couponData : This is Coupon updated information
     * @param number $coupon_id : This is coupon_id
     */
    function updateCoupon($couponData, $coupon_id){
        $this->db->where('coupon_id', $coupon_id);
        $this->db->update('coupons', $couponData);
        return TRUE;
    }
    
    /**
     * This function is used to delete the coupon information
     * @param number $coupon_id : This is coupon_id 
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCoupon($coupon_id, $couponData)
    {
        $this->db->where('coupon_id', $coupon_id);
        $this->db->update('coupons', $couponData);
        
        return $this->db->affected_rows();
    }
    /**
     * This function is used to move the coupon information
     * @param number $coupon_id : This is coupon_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveCoupon($coupon_id, $couponInfo)
    {
        $this->db->where('coupon_id', $coupon_id);
        $this->db->update('coupons', $couponInfo);
        
        return $this->db->affected_rows();
    }
    
}