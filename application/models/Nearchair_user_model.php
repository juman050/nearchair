<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Nearchair_user_model (Nearchair user Model)
 * Nearchairuser model class to get to handle user related data 
 * @author : juman
 * @version : 1.0
 * @since : 29 oct 2019
 */
class Nearchair_user_model extends CI_Model
{

	/**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '',$fromDate, $toDate,$attr= '')
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('users as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.user_id  LIKE '%".$searchText."%'
                            OR  BaseTbl.fullname  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%'
                            OR  BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
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
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '',$fromDate = '', $toDate = '', $page, $segment,$attr = '')
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('users as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.user_id  LIKE '%".$searchText."%'
                            OR  BaseTbl.fullname  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%'
                            OR  BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($attr)){
            $this->db->where($attr);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.user_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to delete the user information
     * @param number $user_id : This is user_id 
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($user_id, $userInfo)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $userInfo);
        
        return $this->db->affected_rows();
    }
    
    /**
     * This function is used to move the user information
     * @param number $user_id : This is $user_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveUser($user_id, $userInfo)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $userInfo);
        
        return $this->db->affected_rows();
    }
}