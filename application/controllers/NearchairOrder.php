<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairOrder (order Controller)
 * Nearchairorder Class to control all Order related operations.
 * @author : juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class NearchairOrder extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_order_model');
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
            $count = $this->nearchair_order_model->orderListingCount($searchText,$fromDate,$toDate,$attr);
           
            $returns = $this->paginationCompress ( "orderListing/", $count, 10 );
            
            $data['orderRecords'] = $this->nearchair_order_model->orderListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
           
            $this->global['order_active'] = 'menu-open';
            $this->global['pageTitle'] = 'NearChair : Order';
            
            $this->loadAdminViews("order/index", $this->global, $data, NULL);
        }
    }
    /**
     * This function used to load the pending order only
     */
    function pending(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $data['searchText'] = $searchText;
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        
        
        $attr = array('BaseTbl.order_status'=>'0');
        $this->load->library('pagination');
        $count = $this->nearchair_order_model->orderListingCount($searchText,$fromDate,$toDate,$attr);
       
        $returns = $this->paginationCompress ( "orderPending/", $count, 10 );
        
        $data['orderRecords'] = $this->nearchair_order_model->orderListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
        
        $this->global['order_active'] = 'menu-open';
        $this->global['pageTitle'] = 'NearChair : Pending Order';
        
        $this->loadAdminViews("order/index", $this->global, $data, NULL);
    }
    
    /**
     * This function used to load the accepted order only
     */
    function accepted(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $data['searchText'] = $searchText;
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        
        
        $attr = array('BaseTbl.order_status'=>'1');
        $this->load->library('pagination');
        $count = $this->nearchair_order_model->orderListingCount($searchText,$fromDate,$toDate,$attr);
       
        $returns = $this->paginationCompress ( "orderAccepted/", $count, 10 );
        
        $data['orderRecords'] = $this->nearchair_order_model->orderListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
        
        $this->global['order_active'] = 'menu-open';
        $this->global['pageTitle'] = 'NearChair : Accepted Order';
        
        $this->loadAdminViews("order/index", $this->global, $data, NULL);
    }
    
    /**
     * This function used to load the accepted order only
     */
    function cancelled(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $data['searchText'] = $searchText;
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        
        
        $attr = array('BaseTbl.order_status'=>'2');
        $this->load->library('pagination');
        $count = $this->nearchair_order_model->orderListingCount($searchText,$fromDate,$toDate,$attr);
       
        $returns = $this->paginationCompress ( "orderCancelled/", $count, 10 );
        
        $data['orderRecords'] = $this->nearchair_order_model->orderListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
        
        $this->global['order_active'] = 'menu-open';
        $this->global['pageTitle'] = 'NearChair : Cancelled Order';
        
        $this->loadAdminViews("order/index", $this->global, $data, NULL);
    }
    
    
    /**
     * This function is used to delete the order using order_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteOrder()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $order_id = $this->input->post('order_id');
            $orderInfo = array('isDeleted'=>1,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_order_model->deleteOrder($order_id, $orderInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to move the business using order_id and order_status
     * @return boolean $result : TRUE / FALSE
     */
    function moveOrder()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $order_id = $this->input->post('order_id');
            $order_status = $this->input->post('order_status');
            $orderInfo = array('order_status'=>$order_status,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_order_model->moveOrder($order_id, $orderInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used load order information
     * @param number $order_id : Optional : This is order_id
     */
    function view($order_id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($order_id == null)
            {
                redirect('orderListing');
            }
            
            $data['orderInfo']=$orderData= $this->nearchair_order_model->getOrdersDetails($order_id);
            $data['orderServices'] = $this->nearchair_order_model->getOrderServices($order_id);
            $data['orderAdvanced'] = $this->nearchair_order_model->getOrderAdvanced($order_id);
            
            $this->global['pageTitle'] = 'NearChair : Order Details';
            
            $this->loadAdminViews("order/view", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to update the homeservice order using order_id and order_status
     * @return boolean $result : TRUE / FALSE
     */
    function updateOrder()
    {
        if($this->isAdmin() == TRUE)
        {
            redirect('orderListing');
        }
        else
        {
            $order_id = $this->input->post('order_id');
            $order_status = $this->input->post('order_status');
            $orderInfo = array('order_status'=>$order_status,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_order_model->moveOrder($order_id, $orderInfo);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Order updated successfully');
            }
            else { 
                $this->session->set_flashdata('error', 'Order updatetion failed');
            }
            redirect('backoffice/order/view/'.$order_id);
        }
    }
    
}