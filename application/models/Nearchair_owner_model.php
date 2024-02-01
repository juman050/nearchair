<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Nearchairowner_model (Nearchairowner Model)
 * Nearchairowner model class to get to handle owner related data 
 * @author : juman
 * @version : 1.0
 * @since : 19 Augest 2019
 */
class Nearchair_owner_model extends CI_Model
{
    /**
     * This function is used to get the owner listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function ownerListingCount($searchText = '')
    {
        $this->db->select('owners.*');
        $this->db->from('owners');
        if(!empty($searchText)) {
            $likeCriteria = "(owners.owner_email  LIKE '%".$searchText."%'
                            OR  owners.owner_name  LIKE '%".$searchText."%'
                            OR  owners.owner_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('owners.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    
    /**
     * This function is used to get the owner listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function ownerListing($searchText = '', $page, $segment)
    {
        $this->db->select('owners.*');
        $this->db->from('owners');
        if(!empty($searchText)) {
            $likeCriteria = "(owners.owner_email  LIKE '%".$searchText."%'
                            OR  owners.owner_name  LIKE '%".$searchText."%'
                            OR  owners.owner_mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('owners.isDeleted', 0);
        $this->db->order_by('owners.owner_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new Owner to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewOwner($ownerInfo)
    {
        $this->db->trans_start();
        $this->db->insert('owners', $ownerInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function is used to move the owner status information
     * @param number $owner_id : This is owner_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveOwner($owner_id, $ownerInfo)
    {
        $this->db->where('owner_id', $owner_id);
        $this->db->update('owners', $ownerInfo);
        
        return $this->db->affected_rows();
    }
    
    /**
     * This function is used to delete the owner information
     * @param number $owner_id : This is owner id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteOwner($owner_id, $userInfo)
    {
        $this->db->where('owner_id', $owner_id);
        $this->db->update('owners', $userInfo);
        
        return $this->db->affected_rows();
    }
    
    /**
     * This function used to get owner information by id
     * @param number $owner_id : This is owner id
     * @return array $result : This is owner information
     */
    function getOwnerInfo($owner_id)
    {
        $this->db->select('owners.*');
        $this->db->from('owners');
        $this->db->where('isDeleted', 0);
        $this->db->where('owner_id', $owner_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    /**
     * This function is used to update the owner information
     * @param array $ownerInfo : This is owners updated information
     * @param number $owner_id : This is owner id
     */
    function updateOwner($ownerInfo, $owner_id)
    {
        $this->db->where('owner_id', $owner_id);
        $this->db->update('owners', $ownerInfo);
        
        return TRUE;
    }
    
    

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $owner_id : This is owner id
     * @return {mixed} $result : This is searched result
     */
    function checkOwnerEmailExists($email, $owner_id = 0)
    {
        $this->db->select("owner_email");
        $this->db->from("owners");
        $this->db->where("owner_email", $email);   
        $this->db->where("isDeleted", 0);
        if($owner_id != 0){
            $this->db->where("owner_id !=", $owner_id);
        }
        $query = $this->db->get();

        return $query->result();
    }
    
}