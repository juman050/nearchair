<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : NearchairDashboard_model (NearchairDashboard Model)
 * NearchairDashboard model class to get to handle Dashboard related data 
 * @author : juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class Nearchair_dashboard_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.adminId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.admin_status, BaseTbl.createdDtm, Role.role');
        $this->db->from('admins as BaseTbl');
        $this->db->join('roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
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
    function userListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.adminId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile,BaseTbl.admin_status, BaseTbl.createdDtm, Role.role');
        $this->db->from('admins as BaseTbl');
        $this->db->join('roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.adminId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to move the user status information
     * @param number $admin_id : This is admin_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveAdmin($admin_id, $adminInfo)
    {
        $this->db->where('adminId', $admin_id);
        $this->db->update('admins', $adminInfo);
        
        return $this->db->affected_rows();
    }
    
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $adminId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $adminId = 0)
    {
        $this->db->select("email");
        $this->db->from("admins");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($adminId != 0){
            $this->db->where("adminId !=", $adminId);
        }
        $query = $this->db->get();

        return $query->result();
    }
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('admins', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $adminId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($adminId)
    {
        $this->db->select('adminId, name, email, mobile, roleId');
        $this->db->from('admins');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('adminId', $adminId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $adminId : This is user id
     */
    function editUser($userInfo, $adminId)
    {
        $this->db->where('adminId', $adminId);
        $this->db->update('admins', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $adminId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($adminId, $userInfo)
    {
        $this->db->where('adminId', $adminId);
        $this->db->update('admins', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $adminId : This is user id
     */
    function matchOldPassword($adminId, $oldPassword)
    {
        $this->db->select('adminId, password');
        $this->db->where('adminId', $adminId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('admins');
        
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
    
    /**
     * This function is used to change users password
     * @param number $adminId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($adminId, $userInfo)
    {
        $this->db->where('adminId', $adminId);
        $this->db->where('isDeleted', 0);
        $this->db->update('admins', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to get user login history
     * @param number $adminId : This is user id
     */
    function loginHistoryCount($adminId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.adminId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
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
        if($adminId >= 1){
            $this->db->where('BaseTbl.adminId', $adminId);
        }
        $this->db->from('last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $adminId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($adminId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.adminId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
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
        if($adminId >= 1){
            $this->db->where('BaseTbl.adminId', $adminId);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $adminId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoById($adminId)
    {
        $this->db->select('adminId, name, email, mobile, roleId');
        $this->db->from('admins');
        $this->db->where('isDeleted', 0);
        $this->db->where('adminId', $adminId);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function used to get user information by id with role
     * @param number $adminId : This is user id
     * @return aray $result : This is user information
     */
    function getUserInfoWithRole($adminId)
    {
        $this->db->select('BaseTbl.adminId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('admins as BaseTbl');
        $this->db->join('roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.adminId', $adminId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  