<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Nearchairowner (owner Controller)
 * Nearchairowner Class to control all owner related operations.
 * @author : juman
 * @version : 1.0
 * @since : 19 Augest 2019
 */
class NearchairOwner extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_owner_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the list of the owner
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
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->nearchair_owner_model->ownerListingCount($searchText);

			$returns = $this->paginationCompress ( "ownerListing/", $count, 10 );
            
            $data['ownerRecords'] = $this->nearchair_owner_model->ownerListing($searchText, $returns["page"], $returns["segment"]);
            
            
            $this->global['pageTitle'] = 'NearChair : Owner Listing';
            
            $this->loadAdminViews("owner/owners", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function used to load the owners busninesses
     */
    
    function ownersBusiness(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            $this->load->model('common_model');
            
            $count = $this->common_model->ownersBusinessCount($searchText);

			$returns = $this->paginationCompress ( "ownersBusiness/", $count, 10 );
            
            $data['ownersBusinessRecords'] = $this->common_model->ownersBusiness($searchText, $returns["page"], $returns["segment"]);
            
            
            $data['businesses_data'] = $this->common_model->getAllBusinesses();
            $data['owners_data'] = $this->common_model->getAllOwners();
            
            $this->global['pageTitle'] = 'NearChair : Owners Businesses';
            
            $this->loadAdminViews("owner/owner_to_business", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to add new owner and business connection to the system
     */
    function addOwnersBusiness()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('business_id','Business','trim|required');
            $this->form_validation->set_rules('owner_id','Owner','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addOwnersBusiness();
            }
            else
            {
                $owner_id = $this->security->xss_clean($this->input->post('owner_id'));
                $business_id = $this->security->xss_clean($this->input->post('business_id'));
                
                $resnfo = array(    'owner_id'=> $owner_id,
                                    'business_id'=>$business_id,
                                    'createdBy'=>$this->vendorId, 
                                    'createdDtm'=>date('Y-m-d H:i:s')
                            );
                
                $this->load->model('common_model');
                $check = $this->common_model->checkOwnersBusiness($owner_id, $business_id);
                if($check>0){
                    $this->session->set_flashdata('error', 'Already connected.');
                }else{
                    $result = $this->common_model->addNewOwnerToBusiness($resnfo);
                
                    if($result > 0)
                    {
                        $this->session->set_flashdata('success', 'New Business connection created successfully');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Business connection creation failed');
                    }
                }
                
                
                redirect('ownersBusiness');
            }
        }
    }
    
    /**
     * This function is used to delete the owner using owners_business_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteOwnersBusiness()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $this->load->model('common_model');
            $id = $this->input->post('id');
            
            $result = $this->common_model->deleteOwnersBusiness($id);
            
            if ($result==TRUE) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = 'NearChair : Add New owner';

            $this->loadAdminViews("owner/addNew", $this->global, NULL, NULL);
        }
    }
    
    /**
     * This function is used to add new owner to the system
     */
    function addNewOwner()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('owner_name','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('owner_email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('owner_password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[owner_password]|max_length[20]');
            $this->form_validation->set_rules('owner_status','Owner status','trim|required|numeric');
            $this->form_validation->set_rules('owner_mobile','Mobile Number','required|min_length[11]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $owner_name = ucwords(strtolower($this->security->xss_clean($this->input->post('owner_name'))));
                $owner_email = strtolower($this->security->xss_clean($this->input->post('owner_email')));
                $owner_password = $this->input->post('owner_password');
                $owner_status = $this->input->post('owner_status');
                $mobile = $this->security->xss_clean($this->input->post('owner_mobile'));
                
                $ownerInfo = array(  'owner_name'=> $owner_name,
                                    'owner_email'=>$owner_email, 
                                    'owner_password'=>getHashedPassword($owner_password),
                                    'owner_mobile'=>$mobile,
                                    'owner_status'=>$owner_status, 
                                    'createdBy'=>$this->vendorId, 
                                    'createdDtm'=>date('Y-m-d H:i:s')
                             );
                
                $this->load->model('nearchair_owner_model');
                $result = $this->nearchair_owner_model->addNewOwner($ownerInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Owner created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Owner creation failed');
                }
                
                redirect('backoffice/owner/addNew');
            }
        }
    }
    
    /**
     * This function is used load owner edit information
     * @param number $owner_id : Optional : This is owner id
     */
    function editOwner($owner_id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($owner_id == null)
            {
                redirect('backoffice/ownerListing');
            }
            
            $data['ownerInfo'] = $this->nearchair_owner_model->getOwnerInfo($owner_id);
            
            $this->global['pageTitle'] = 'NearChair : Edit owner';
            
            $this->loadAdminViews("owner/editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the owner information
     */
    function updateOwner()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $owner_id = $this->input->post('owner_id');
            $this->form_validation->set_rules('owner_name','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('owner_email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('owner_password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[owner_password]|max_length[20]');
            $this->form_validation->set_rules('owner_status','Owner status','trim|required|numeric');
            $this->form_validation->set_rules('owner_mobile','Mobile Number','required|min_length[11]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOwner($owner_id);
            }
            else
            {
                $owner_name = ucwords(strtolower($this->security->xss_clean($this->input->post('owner_name'))));
                $owner_email = strtolower($this->security->xss_clean($this->input->post('owner_email')));
                $owner_password = $this->input->post('owner_password');
                $owner_status = $this->input->post('owner_status');
                $mobile = $this->security->xss_clean($this->input->post('owner_mobile'));
                
                $ownerInfo = array();
                if(empty($password))
                {
                    $ownerInfo = array( 'owner_name'=> $owner_name,
                                        'owner_email'=>$owner_email, 
                                        'owner_mobile'=>$mobile,
                                        'owner_status'=>$owner_status, 
                                        'updatedBy'=>$this->vendorId, 
                                        'updatedDtm'=>date('Y-m-d H:i:s')
                             );
                }else{
                    $ownerInfo = array( 'owner_name'=> $owner_name,
                                        'owner_email'=>$owner_email, 
                                        'owner_password'=>getHashedPassword($owner_password),
                                        'owner_mobile'=>$mobile,
                                        'owner_status'=>$owner_status, 
                                        'updatedBy'=>$this->vendorId, 
                                        'updatedDtm'=>date('Y-m-d H:i:s')
                             );
                }
                
                $result = $this->nearchair_owner_model->updateOwner($ownerInfo, $owner_id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Owner updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Owner updation failed');
                }
                
                redirect('backoffice/ownerListing');
            }
        }
    }
    
    
    /**
     * This function is used to move the owners using $owner_id and owner_status
     * @return boolean $result : TRUE / FALSE
     */
    function moveOwner()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $owner_id = $this->input->post('owner_id');
            $owner_status = $this->input->post('owner_status');
            $ownerInfo = array('owner_status'=>$owner_status,'updatedBy'=>$this->vendorId,'updatedDtm'=>date('Y-m-d H:i:s'));

            $result = $this->nearchair_owner_model->moveOwner($owner_id, $ownerInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }


    /**
     * This function is used to delete the owner using owner_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteOwner()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $owner_id = $this->input->post('owner_id');
            $ownerInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_owner_model->deleteOwner($owner_id, $ownerInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkOwnerEmailExists()
    {
        $owner_id = $this->input->post("owner_id");
        $email = $this->input->post("owner_email");

        if(empty($owner_id)){
            $result = $this->nearchair_owner_model->checkOwnerEmailExists($email);
        } else {
            $result = $this->nearchair_owner_model->checkOwnerEmailExists($email, $owner_id);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
}