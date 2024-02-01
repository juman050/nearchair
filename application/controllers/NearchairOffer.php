<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Nearchairoffer (offer Controller)
 * Nearchairoffer Class to control all business offer related operations.
 * @author : juman
 * @version : 1.0
 * @since : 12 oct 2019
 */
class NearchairOffer extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_offer_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the add new form
     * @param number $business_id : Optional : This is business id
     */
    function addNew($business_id=NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($business_id == null)
            {
                redirect('dashboard');
            }
            $offes = $this->nearchair_offer_model->checkBusinessOffer($business_id);
            if(!empty($offes)){
                redirect('backoffice/offer/editOffer/'.$offes->offer_id);
            }
            $data['business_id'] =$business_id;
            $this->global['pageTitle'] = 'NearChair : Add New offer';
            $this->loadAdminViews("offer/addNew", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to add new offer to the business
     */
    function addNewOffer()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('offer_title','Offer title','trim|required|max_length[128]');
            $this->form_validation->set_rules('offer_type','Offer type','trim|required');
            $this->form_validation->set_rules('discount','Discount','trim|required');
            $this->form_validation->set_rules('offer_status','Offer status','trim|required');
            $this->form_validation->set_rules('start_time','Start Date','trim|required');
            $this->form_validation->set_rules('end_time','End Date','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew($this->input->post('business_id'));
            }
            else
            {
                $offerData = array();
                $offerData['offer_title'] = $this->input->post('offer_title');
                $offerData['business_id'] =$this->input->post('business_id');
                $offerData['offer_type'] = $this->input->post('offer_type');
                if($offerData['offer_type']!=="all"){
                    $service_ids = array();
                    foreach($this->input->post('service_ids') as $val)
                    {
                      $service_ids[] = (int) $val;
                    }
                    $service_ids = implode(',', $service_ids);
                    $offerData['service_ids'] =$service_ids;
                }
                $offerData['discount'] =$this->input->post('discount');
                $offerData['offer_status'] = $this->input->post('offer_status');
                $offerData['start_time'] = $this->input->post('start_time');
                $offerData['end_time'] = $this->input->post('end_time');
                $offerData['createdDtm']= date('Y-m-d H:i:s');
                $offer_id = $this->nearchair_offer_model->addNewOffer($offerData);
                
                if($offer_id > 0)
                {
                    $this->session->set_flashdata('success', 'New Offer created successfully');
                    redirect('backoffice/offer/editOffer/'.$offer_id);
                }
                else
                {
                    $this->session->set_flashdata('error', 'Offer creation failed');
                    redirect('backoffice/offer/addNew/'.$this->input->post('business_id'));
                }
                
                
                
            }
        }
        
    }
    /**
     * This function is used load offer edit information
     * @param number $offer : Optional : This is offer id
     */
    function editOffer($offer_id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($offer_id == null)
            {
                redirect('dashboard');
            }
            
            $data['offerInfo'] = $this->nearchair_offer_model->getOfferInfo($offer_id);
            
            $this->global['pageTitle'] = 'NearChair : Edit offer';
            
            $this->loadAdminViews("offer/editOld", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to edit the offer information
     */
    function updateOffer()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $offer_id = $this->input->post('offer_id');
            
            $this->form_validation->set_rules('offer_title','Offer title','trim|required|max_length[128]');
            $this->form_validation->set_rules('offer_type','Offer type','trim|required');
            $this->form_validation->set_rules('discount','Discount','trim|required');
            $this->form_validation->set_rules('offer_status','Offer status','trim|required');
            $this->form_validation->set_rules('start_time','Start Date','trim|required');
            $this->form_validation->set_rules('end_time','End Date','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOffer($offer_id);
            }
            else
            {
                
                $offerData = array();
                $offerData['offer_title'] = $this->input->post('offer_title');
                $offerData['business_id'] =$this->input->post('business_id');
                $offerData['offer_type'] = $this->input->post('offer_type');
                if($offerData['offer_type']!=="all"){
                    $service_ids = array();
                    foreach($this->input->post('service_ids') as $val)
                    {
                      $service_ids[] = (int) $val;
                    }
                    $service_ids = implode(',', $service_ids);
                    $offerData['service_ids'] =$service_ids;
                }
                $offerData['discount'] =$this->input->post('discount');
                $offerData['offer_status'] = $this->input->post('offer_status');
                $offerData['start_time'] = $this->input->post('start_time');
                $offerData['end_time'] = $this->input->post('end_time');
                $offerData['updatedDtm']= date('Y-m-d H:i:s');
                $result = $this->nearchair_offer_model->updateOffer($offerData, $offer_id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Offer updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Offer updation failed');
                }
                
                redirect('backoffice/offer/editOffer/'.$offer_id);
            }
        }
    }
}