<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : frontend_login_model (Owner Login Model)
 * @author : Emon
 * @version : 1.0
 * @since : 26 Augest 2019
 */
class frontend_login_model extends CI_Model
{
    public function __construct() { 
        parent::__construct(); 
    }
    
    /**
     * This function used to check the login credentials of the owner
     * @param string $email : This is email of the owner
     * @param string $password : This is encrypted password of the owner
     * @return boolean
     * @author Emon
     */
    function loginOwner($email, $password)
    {
        $this->db->select('owner_id, owner_name, owner_email, owner_mobile, owner_password, createdDtm');
        $this->db->from('owners');
        $this->db->where('owner_email', $email);
        $this->db->where('owner_status', 1);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        $user = $query->row();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->owner_password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     * @return boolean
     * @author Emon
     */
    function loginUser($mobile, $password)
    {
        $this->db->select('user_id, fullname, mobile, password, mobile, city, area');
        $this->db->from('users');
        $this->db->where('mobile', $mobile);
        $this->db->where('user_status', 1);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        $user = $query->row();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    

}

?>