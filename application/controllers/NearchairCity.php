<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairCity (City Controller)
 * NearchairCity Class to control all user related operations.
 * @author : juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class NearchairCity extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_city_model');
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
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->nearchair_city_model->cityListingCount($searchText);

            $returns = $this->paginationCompress ( "cityListing/", $count, 10 );
            
            $data['cityRecords'] = $this->nearchair_city_model->cityListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'NearChair : City';
            
            $this->loadAdminViews("city/index", $this->global, $data, NULL);
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
            
            $this->global['pageTitle'] = 'NearChair : Add New City';

            $this->loadAdminViews("city/addNew", $this->global, NULL, NULL);
        }
    }
    
    /**
     * This function is used to add new city to the system
     */
    function addNewCity()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('city_name','City Name','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $city_name = ucwords(strtolower($this->security->xss_clean($this->input->post('city_name'))));
                
                $catInfo = array('city_name'=> $city_name,'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('nearchair_city_model');
                $result = $this->nearchair_city_model->addNewCity($catInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New city created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'City creation failed');
                }
                
                redirect('backoffice/city/addNew');
            }
        }
    }

    /**
     * This function is used load city edit information
     * @param number $city : Optional : This is city id
     */
    function editCity($city_id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($city_id == null)
            {
                redirect('backoffice/cityListing');
            }
            
            $data['catInfo'] = $this->nearchair_city_model->getCityInfo($city_id);
            
            $this->global['pageTitle'] = 'NearChair : Edit city';
            
            $this->loadAdminViews("city/editOld", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the city information
     */
    function updateCity()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $city_id = $this->input->post('city_id');
            
            $this->form_validation->set_rules('city_name','City Name','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($city_id);
            }
            else
            {
                $city_name = ucwords(strtolower($this->security->xss_clean($this->input->post('city_name'))));
                
                $catInfo = array();
                
                $catInfo = array('city_name'=> $city_name,'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->nearchair_city_model->updateCity($catInfo, $city_id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'City updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'City updation failed');
                }
                
                redirect('backoffice/cityListing');
            }
        }
    }
    
    /**
     * This function is used to delete the city using city_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCity()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $city_id = $this->input->post('city_id');
            $cityInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_city_model->deleteCity($city_id, $cityInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to move the city using city_id and city_status
     * @return boolean $result : TRUE / FALSE
     */
    function moveCity()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $city_id = $this->input->post('city_id');
            $city_status = $this->input->post('city_status');
            $cityInfo = array('city_status'=>$city_status,'updatedBy'=>$this->vendorId,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_city_model->moveCity($city_id, $cityInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
}