<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Nearchaircoupon (coupon Controller)
 * Nearchaircoupon Class to control all coupon related operations.
 * @author : juman
 * @version : 1.0
 * @since : 27 sept 2019
 */
class NearchairCoupon extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_coupon_model');
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
            
            $count = $this->nearchair_coupon_model->couponListingCount($searchText);

            $returns = $this->paginationCompress ( "couponListing/", $count, 10 );
            
            $data['couponRecords'] = $this->nearchair_coupon_model->couponListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'NearChair : coupon';
            
            $this->loadAdminViews("coupon/index", $this->global, $data, NULL);
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
            
            $this->global['pageTitle'] = 'NearChair : Add New Coupon';
            $this->loadAdminViews("coupon/addNew", $this->global, NULL, NULL);
        }
    }
    /**
     * This function is used to add new coupon to the system
     */
    function addNewCoupon()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('coupon_title','coupon Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('coupon_code','coupon code','trim|required');
            $this->form_validation->set_rules('coupon_description','coupon Description','trim|required');
            $this->form_validation->set_rules('discount_type','Discount type','trim|required');
            $this->form_validation->set_rules('discount_value','Discount Value','trim|required');
            $this->form_validation->set_rules('minimum_total','Minimum Order Total','trim|required');
            $this->form_validation->set_rules('user_usage','per user usage','trim|required');
            $this->form_validation->set_rules('start_date_time','Start Date','trim|required');
            $this->form_validation->set_rules('end_date_time','End Date','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $couponData = array();
                $couponData['coupon_title'] = $this->input->post('coupon_title');
                $couponData['coupon_code'] =$this->security->xss_clean($this->input->post('coupon_code'));
                $couponData['coupon_description'] = $this->input->post('coupon_description');
                $couponData['discount_type'] = $this->security->xss_clean($this->input->post('discount_type'));
                $discount_value = $this->security->xss_clean($this->input->post('discount_value'));
                $couponData['discount_amount']=$discount_value ;
                
                $couponData['minimum_total'] = $this->security->xss_clean($this->input->post('minimum_total'));
                $couponData['user_usage'] = $this->security->xss_clean($this->input->post('user_usage'));
                $couponData['start_date_time'] = $this->input->post('start_date_time');
                $couponData['end_date_time'] = $this->input->post('end_date_time');
                $couponData['createdDtm']= date('Y-m-d H:i:s');
                $result = $this->nearchair_coupon_model->addNewcoupon($couponData);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New coupon created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'coupon creation failed');
                }
                
                redirect('backoffice/coupon/addNew');
            }
        }
    }
    
    /**
     * This function is used load coupon edit information
     * @param number $coupon : Optional : This is coupon id
     */
    function editCoupon($coupon_id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($coupon_id == null)
            {
                redirect('backoffice/couponListing');
            }
            
            $data['couponInfo'] = $this->nearchair_coupon_model->getCouponInfo($coupon_id);
            
            $this->global['pageTitle'] = 'NearChair : Edit coupon';
            
            $this->loadAdminViews("coupon/editOld", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the Coupon information
     */
    function updateCoupon()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $coupon_id = $this->input->post('coupon_id');
            
            $this->form_validation->set_rules('coupon_title','coupon Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('coupon_code','coupon code','trim|required');
            $this->form_validation->set_rules('coupon_description','coupon Description','trim|required');
            $this->form_validation->set_rules('discount_type','Discount type','trim|required');
            $this->form_validation->set_rules('discount_value','Discount Value','trim|required');
            $this->form_validation->set_rules('minimum_total','Minimum Order Total','trim|required');
            $this->form_validation->set_rules('user_usage','per user usage','trim|required');
            $this->form_validation->set_rules('start_date_time','Start Date','trim|required');
            $this->form_validation->set_rules('end_date_time','End Date','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editCoupon($coupon_id);
            }
            else
            {
                $couponData = array();
                $couponData['coupon_title'] = $this->input->post('coupon_title');
                $couponData['coupon_code'] =$this->security->xss_clean($this->input->post('coupon_code'));
                $couponData['coupon_description'] = $this->input->post('coupon_description');
                $couponData['discount_type'] = $this->security->xss_clean($this->input->post('discount_type'));
                $discount_value = $this->security->xss_clean($this->input->post('discount_value'));
                $couponData['discount_amount']=$discount_value ;
                
                $couponData['minimum_total'] = $this->security->xss_clean($this->input->post('minimum_total'));
                $couponData['user_usage'] = $this->security->xss_clean($this->input->post('user_usage'));
                $couponData['start_date_time'] = $this->input->post('start_date_time');
                $couponData['end_date_time'] = $this->input->post('end_date_time');
                $couponData['updatedDtm']= date('Y-m-d H:i:s');
                $result = $this->nearchair_coupon_model->updateCoupon($couponData, $coupon_id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Coupon updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Coupon updation failed');
                }
                
                redirect('couponListing');
            }
        }
    }
    
    /**
     * This function is used to delete the coupons using coupon_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCoupon()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $coupon_id = $this->input->post('coupon_id');
            $data = array('isDeleted'=>1,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_coupon_model->deleteCoupon($coupon_id, $data);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to move the Coupon using coupon_id and coupon_status
     * @return boolean $result : TRUE / FALSE
     */
    function moveCoupon()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $coupon_id = $this->input->post('coupon_id');
            $coupon_status = $this->input->post('coupon_status');
            $CouponInfo = array('coupon_status'=>$coupon_status,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_coupon_model->moveCoupon($coupon_id, $CouponInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }


    
}