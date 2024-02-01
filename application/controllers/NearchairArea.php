<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairArea (This is Area Controller)
 * NearchairArea Class to control all user related operations.
 * @author : Emon
 * @version : 1.0
 * @since : 22 September 2019
 */
class NearchairArea extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_area_model');
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
            
            $count = $this->nearchair_area_model->areaListingCount($searchText);

            $returns = $this->paginationCompress ( "areaListing/", $count, 10 );
            
            $data['areaRecords'] = $this->nearchair_area_model->areaListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'NearChair : Area';
            
            $this->loadAdminViews("area/index", $this->global, $data, NULL);
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
            
            $this->global['pageTitle'] = 'NearChair : Add New Area';

            $data['cities'] = $this->nearchair_area_model->getCities();
            $this->loadAdminViews("area/addNew", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to add new area to the system
     */
    function addNewArea()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('area_name','Area Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('city_id','City','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $area_name = ucwords(strtolower($this->security->xss_clean($this->input->post('area_name'))));
                $city_id = $this->input->post('city_id');
                
                $catInfo = array('area_name'=> $area_name,'city_id'=> $city_id,'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('nearchair_area_model');
                $result = $this->nearchair_area_model->addNewArea($catInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Area created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Area creation failed');
                }
                
                redirect('backoffice/area/addNew');
            }
        }
    }

    /**
     * This function is used load Area edit information
     * @param number $area : Optional : This is area  id
     */
    function editArea($area_id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($area_id == null)
            {
                redirect('backoffice/areaListing');
            }
            
            $data['catInfo'] = $this->nearchair_area_model->getAreaInfo($area_id);
            $data['cities'] = $this->nearchair_area_model->getCities();
            $this->global['pageTitle'] = 'NearChair : Edit Area';
            
            $this->loadAdminViews("area/editOld", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the area information
     */
    function updateArea()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $area_id = $this->input->post('area_id');
            
            $this->form_validation->set_rules('area_name','Area Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('city_id','City','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($area_id);
            }
            else
            {
                $area_name = ucwords(strtolower($this->security->xss_clean($this->input->post('area_name'))));
                $city_id = $this->input->post('city_id');
                
                $catInfo = array();
                
                $catInfo = array('area_name'=> $area_name,'city_id'=> $city_id,'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->nearchair_area_model->updateArea($catInfo, $area_id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Area updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Area updation failed');
                }
                
                redirect('backoffice/areaListing');
            }
        }
    }
    
    /**
     * This function is used to delete the area using area_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteArea()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $area_id = $this->input->post('area_id');
            $areaInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_area_model->deleteArea($area_id, $areaInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to move the area using area_id and area_status
     * @return boolean $result : TRUE / FALSE
     */
    function moveArea()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $area_id = $this->input->post('area_id');
            $area_status = $this->input->post('area_status');
            $areaInfo = array('area_status'=>$area_status,'updatedBy'=>$this->vendorId,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_area_model->moveArea($area_id, $areaInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * author: juman
     * since :22-sept-2019
     * This function is used to get the area under city sing city id
     * @return string $result 
     */
    function getAreaUnderCity()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $city_id = $this->input->post('city_id');
            
            $result = $this->nearchair_area_model->getAreaUnderCity($city_id);
            $html ='';
            if (!empty($result)){
                $html.= '<option value disabled>Select Area</option>';
                foreach($result as $area){
                   $html.= '<option value="'.$area->area_id.'">'.$area->area_name.'</option>';
                }
            }
            else { $html.= '<option value disabled selected>Select Area</option>';  }
            
            echo $html;
        }
    }
}