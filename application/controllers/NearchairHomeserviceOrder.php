<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairHomeserviceOrder (order Controller)
 * NearchairHomeserviceOrder Class to control all home service Order related operations.
 * @author : juman
 * @version : 1.0
 * @since : 09 oct 2019
 */
class NearchairHomeserviceOrder extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_homeservice_order_model');
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
            $count = $this->nearchair_homeservice_order_model->orderListingCount($searchText,$fromDate,$toDate,$attr);
           
            $returns = $this->paginationCompress ( "homerserviceOrderListing/", $count, 10 );
            
            $data['orderRecords'] = $this->nearchair_homeservice_order_model->orderListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
           
            $this->global['homeorder_active'] = 'menu-open';
            $this->global['pageTitle'] = 'NearChair : Home Service Order';
            
            $this->loadAdminViews("homeserviceOrder/index", $this->global, $data, NULL);
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
        $count = $this->nearchair_homeservice_order_model->orderListingCount($searchText,$fromDate,$toDate,$attr);
       
        $returns = $this->paginationCompress ( "orderPending/", $count, 10 );
        
        $data['orderRecords'] = $this->nearchair_homeservice_order_model->orderListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
        
        $this->global['homeorder_active'] = 'menu-open';
        $this->global['pageTitle'] = 'NearChair : Home Service Pending Order';
            
        $this->loadAdminViews("homeserviceOrder/index", $this->global, $data, NULL);
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
        $count = $this->nearchair_homeservice_order_model->orderListingCount($searchText,$fromDate,$toDate,$attr);
       
        $returns = $this->paginationCompress ( "orderAccepted/", $count, 10 );
        
        $data['orderRecords'] = $this->nearchair_homeservice_order_model->orderListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
        
        $this->global['homeorder_active'] = 'menu-open';
        $this->global['pageTitle'] = 'NearChair : Home Service Accepted Order';
        
        $this->loadAdminViews("homeserviceOrder/index", $this->global, $data, NULL);
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
        $count = $this->nearchair_homeservice_order_model->orderListingCount($searchText,$fromDate,$toDate,$attr);
       
        $returns = $this->paginationCompress ( "orderCancelled/", $count, 10 );
        
        $data['orderRecords'] = $this->nearchair_homeservice_order_model->orderListing($searchText,$fromDate,$toDate, $returns["page"], $returns["segment"],$attr);
        
        $this->global['homeorder_active'] = 'menu-open';
        $this->global['pageTitle'] = 'NearChair : Home Service Cancelled Order';
        
        $this->loadAdminViews("homeserviceOrder/index", $this->global, $data, NULL);
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
            
            $result = $this->nearchair_homeservice_order_model->deleteOrder($order_id, $orderInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to move the homeservice order using order_id and order_status
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
            
            $result = $this->nearchair_homeservice_order_model->moveOrder($order_id, $orderInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    
    /**
     * This function is used to load the add new service
     */
    function homeServiceList()
    {

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('nearchair_business_model');
            $this->global['pageTitle'] = 'NearChair : Add Service';
            $this->global['homeorder_active'] = 'menu-open';
            $data['page_sts'] = 'ADD';
            $data['allcategories'] = $this->nearchair_business_model->getCategories();
            $data['seviceList'] = $this->nearchair_homeservice_order_model->get_seviceList();
            $this->loadAdminViews("homeserviceOrder/addNewService", $this->global, $data, NULL);
        }
    }

    
    /**
     * This function is used to load the add new service
     */
    function storeBusinessService()
    {

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('service_name','Service Name','trim|required');
            $this->form_validation->set_rules('cat_id',"Category id","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_price',"Service Price","trim|required|numeric");
            $this->form_validation->set_rules('service_discount_price',"Service Discount Price","trim|numeric");
            $this->form_validation->set_rules('service_time_hr',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_time_min',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_description',"Description","trim");


            if($this->form_validation->run() == FALSE)
            {
                $this->homeServiceList();
            }
            else
            {


                $service_name = ucwords(strtolower($this->security->xss_clean($this->input->post('service_name'))));
                $service_description = $this->security->xss_clean($this->input->post('service_description'));
                
                
                $serviceInfo = array();
                $serviceInfo['serviceName']        = $service_name;
                $serviceInfo['serviceDescription'] = $service_description;
                
                $serviceInfo['serviceSlug']         = str_slug($service_name);
                $serviceInfo['catId']               = $this->input->post('cat_id');
                $serviceInfo['serviceTime']         = $this->input->post('service_time_hr').':'.$this->input->post('service_time_min');
                $serviceInfo['servicePrice']        = $this->input->post('service_price');
                $serviceInfo['serviceDiscountPrice'] = $this->input->post('service_discount_price');
                $serviceInfo['createdDtm']           = date('Y-m-d H:i:s');
                
                if(($this->input->post('service_time_hr')=="") || ($this->input->post('service_time_min')==""))
                {
                    $this->session->set_flashdata('error_msg', 'Time Must Be Fill-Up');
                    $this->session->set_flashdata('error', 'error');
                    $this->homeServiceList();
                }

                $result = $this->nearchair_homeservice_order_model->insertData('services',$serviceInfo);
                
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Service created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Service creation failed');
                }
                
                redirect('backoffice/homeServiceList');

            }
            
        }
    }
    
    
    /**
     * This function is used to load the edit new service
     */
    function editService($service_id = null)
    {

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

            if($service_id > 0 && $service_id != ""){
                
                $this->load->model('nearchair_business_model');
                $this->global['pageTitle'] = 'NearChair : Edit Service';
                $this->global['homeorder_active'] = 'menu-open';
                $data['allcategories'] = $this->nearchair_business_model->getCategories();
                $data['page_sts'] = 'EDIT';
                $data['seviceList'] = $this->nearchair_homeservice_order_model->get_seviceList();
                $data['singleService'] = $this->nearchair_homeservice_order_model->get_singleService($service_id);
                $this->loadAdminViews("homeserviceOrder/addNewService", $this->global, $data, NULL);
            }

        }
    }
    
    
    
    /**
     * This function is used to load the update service
     */
    function updateBusinessService()
    {

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $service_id =$this->input->post('service_id');
            $this->form_validation->set_rules('service_name','Service Name','trim|required');
            $this->form_validation->set_rules('cat_id',"Category Id","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_price',"Service Price","trim|required|numeric");
            $this->form_validation->set_rules('service_discount_price',"Service Discount Price","trim|numeric");
            $this->form_validation->set_rules('service_time_hr',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_time_min',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_description',"Description","trim");


            if($this->form_validation->run() == FALSE)
            {
                $this->homeServiceList();
            }
            else
            {


                $service_name = ucwords(strtolower($this->security->xss_clean($this->input->post('service_name'))));
                $service_description = $this->security->xss_clean($this->input->post('service_description'));

                $serviceInfo = array();
                $serviceInfo['serviceName']        = $service_name;
                $serviceInfo['serviceDescription'] = $service_description;
                
                $serviceInfo['serviceSlug']         = str_slug($service_name);
                $serviceInfo['catId']               = $this->input->post('cat_id');
                $serviceInfo['serviceTime']         = $this->input->post('service_time_hr').':'.$this->input->post('service_time_min');
                $serviceInfo['servicePrice']        = $this->input->post('service_price');
                $serviceInfo['serviceDiscountPrice'] = $this->input->post('service_discount_price');
                $serviceInfo['updatedDtm']           = date('Y-m-d H:i:s');
                
                if(($this->input->post('service_time_hr')=="") || ($this->input->post('service_time_min')==""))
                {
                    $this->session->set_flashdata('error_msg', 'Time Must Be Fill-Up');
                    $this->session->set_flashdata('error', 'error');
                    $this->homeServiceList();
                }
                $where = array('serviceId' => $service_id);
                $result = $this->nearchair_homeservice_order_model->where_update('services',$where,$serviceInfo);
                
                if($result!=FALSE)
                {
                    $this->session->set_flashdata('success', 'Service updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Service updated failed');
                }
                
                redirect('backoffice/homeServiceList');
            }
            
        }
    }
    
    /**
     * This function is used to delete the category using category_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteService()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $service_id = $this->input->post('service_id');

            $serviceInfo = array('isDeleted'=>1, 'updatedDtm'=>date('Y-m-d H:i:s'));
            $where = array('serviceId'=>$service_id);
            
            $result = $this->nearchair_homeservice_order_model->where_update('services',$where, $serviceInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used load home service order information
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
                redirect('homserviceOrderListing');
            }
            
            $data['orderInfo']= $this->nearchair_homeservice_order_model->getOrdersDetails($order_id);
            $data['orderServices'] = $this->nearchair_homeservice_order_model->getOrderServices($order_id);
            
            $this->global['pageTitle'] = 'NearChair : Homeservice Order Details';
            
            $this->loadAdminViews("homeserviceOrder/view", $this->global, $data, NULL);
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
            redirect('homserviceOrderListing');
        }
        else
        {
            $order_id = $this->input->post('order_id');
            $order_status = $this->input->post('order_status');
            $orderInfo = array('order_status'=>$order_status,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_homeservice_order_model->moveOrder($order_id, $orderInfo);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Order updated successfully');
            }
            else { 
                $this->session->set_flashdata('error', 'Order updatetion failed');
            }
            redirect('backoffice/homserviceOrder/view/'.$order_id);
        }
    }


}