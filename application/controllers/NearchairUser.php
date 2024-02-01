<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairUser (User Controller)
 * NearchairUser Class to control all User related operations.
 * @author : juman
 * @version : 1.0
 * @since : 29 oct 2019
 */
class NearchairUser extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_user_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {        
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $uri_segment = $this->security->xss_clean($this->input->post('uri_segment'));
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');
            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            $attr ="";
            $this->load->library('pagination');
            $count = $this->nearchair_user_model->userListingCount($searchText,$fromDate,$toDate,$attr);
           
            $returns = $this->paginationCompress ( "users/", $count, 30 );
            
            $data['userRecords'] = $this->nearchair_user_model->userListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
           
            $this->global['user_active'] = 'menu-open';
            $this->global['pageTitle'] = 'NearChair : User';
            
            $this->loadAdminViews("user/index", $this->global, $data, NULL);
        }
    }
    /**
     * This function used to load the pending user only
     */
    function pending(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $data['searchText'] = $searchText;
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        
        
        $attr = array('BaseTbl.user_status'=>'0');
        $this->load->library('pagination');
        $count = $this->nearchair_user_model->userListingCount($searchText,$fromDate,$toDate,$attr);
       
        $returns = $this->paginationCompress ( "usersPending/", $count, 30 );
        
        $data['userRecords'] = $this->nearchair_user_model->userListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
        
        $this->global['user_active'] = 'menu-open';
        $this->global['pageTitle'] = 'NearChair : Pending user';
        
        $this->loadAdminViews("user/index", $this->global, $data, NULL);
    }
    
    /**
     * This function used to load the accepted user only
     */
    function accepted(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $data['searchText'] = $searchText;
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        
        
        $attr = array('BaseTbl.user_status'=>'1');
        $this->load->library('pagination');
        $count = $this->nearchair_user_model->userListingCount($searchText,$fromDate,$toDate,$attr);
       
        $returns = $this->paginationCompress ( "usersAccepted/", $count, 30 );
        
        $data['userRecords'] = $this->nearchair_user_model->userListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
        
        $this->global['user_active'] = 'menu-open';
        $this->global['pageTitle'] = 'NearChair : Accepted user';
        
        $this->loadAdminViews("user/index", $this->global, $data, NULL);
    }
    /**
     * This function is used to delete the order using user_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $user_id = $this->input->post('user_id');
            $Info = array('isDeleted'=>1,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_user_model->deleteUser($user_id, $Info);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to move the business using user_id and user_status
     * @return boolean $result : TRUE / FALSE
     */
    function moveUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $user_id = $this->input->post('user_id');
            $user_status = $this->input->post('user_status');
            $userInfo = array('user_status'=>$user_status,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_user_model->moveUser($user_id, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    
}