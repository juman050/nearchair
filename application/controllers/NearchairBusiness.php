<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairBusiness (Business Controller)
 * NearchairBusiness Class to control all user related operations.
 * @author : juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class NearchairBusiness extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_business_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the business
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

           
            $attr ="";
                

            $count = $this->nearchair_business_model->businessListingCount($searchText,$attr);

            $returns = $this->paginationCompress ("businessListing/", $count, 30);
            
            $data['businessRecords'] = $this->nearchair_business_model->businessListing($searchText, $returns["page"], $returns["segment"],$attr);
            
            $this->global['pageTitle'] = 'NearChair : Businesses';
            $this->global['business_active'] = 'menu-open';
            
            $this->loadAdminViews("business/index", $this->global, $data, NULL);
        }
    }
    
     /**
     * This function used to load the pending business only
     */
    function pending(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        
        
        $attr = array('business_status'=>'0');
        
        $this->load->library('pagination');
        $count = $this->nearchair_business_model->businessListingCount($searchText,$attr);

        $returns = $this->paginationCompress ("businessPending/", $count, 30 );
        
        $data['businessRecords'] = $this->nearchair_business_model->businessListing($searchText, $returns["page"], $returns["segment"],$attr);
        
        $this->global['pageTitle'] = 'NearChair : Business Pending';
        $this->global['business_active'] = 'menu-open';
        
        $this->loadAdminViews("business/index", $this->global, $data, NULL);
    }
    
    /**
     * This function used to load the accepted business only
     */
    function accepted(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        $attr = array('business_status'=>'1');
        
        $this->load->library('pagination');
        $count = $this->nearchair_business_model->businessListingCount($searchText,$attr);

        $returns = $this->paginationCompress ("businessAccepted/", $count, 30);
       
        
        $data['businessRecords'] = $this->nearchair_business_model->businessListing($searchText, $returns["page"], $returns["segment"],$attr);
        
        $this->global['pageTitle'] = 'NearChair : Business Accepted';
        $this->global['business_active'] = 'menu-open';
        
        $this->loadAdminViews("business/index", $this->global, $data, NULL);
    }
    
    /**
     * This function used to load the accepted business only
     */
    function cancelled(){
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        
        
        $attr = array('business_status'=>'2');
        
        $this->load->library('pagination');
        $count = $this->nearchair_business_model->businessListingCount($searchText,$attr);

        $returns = $this->paginationCompress ("businessCancelled/", $count, 30 );
        
        $data['businessRecords'] = $this->nearchair_business_model->businessListing($searchText, $returns["page"], $returns["segment"],$attr);
        
        $this->global['pageTitle'] = 'NearChair : Business Cancelled';
        $this->global['business_active'] = 'menu-open';
        
        $this->loadAdminViews("business/index", $this->global, $data, NULL);
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
            $this->load->model('nearchair_city_model');
            $this->global['pageTitle'] = 'NearChair : Add New Business';
            $data['cities'] = $this->nearchair_city_model->getCities();

            $this->loadAdminViews("business/addNew", $this->global, $data, NULL);
        }
    }
    

    
    /**
     * This function is used to add new business to the system
     */
    function addNewBusiness()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('business_name','Business Name','trim|required|max_length[128]');
            $is_unique =  '';
            if(!$this->input->post('business_slug')){
                $slug = create_slug($this->input->post('business_slug'));
            }else{
                $slug = $this->input->post('business_slug');
            }
            
			if($slug) {
			   $is_unique =  '|is_unique[businesses.business_slug]';
			}
            $this->form_validation->set_rules('business_slug','Business Slug','trim|required'.$is_unique);
            
            $is_unique =  '';
			if($this->input->post('email')) {
			   $is_unique =  '|is_unique[businesses.email]';
			}
			$this->form_validation->set_rules('email', 'Business Email', 'required|valid_email|trim'.$is_unique);
			
			$this->form_validation->set_rules('mobile', 'Mobile Number ', 'required'); 
			$this->form_validation->set_rules('city_id',"Business City","trim|required");
			$this->form_validation->set_rules('area_id',"Business Area","trim|required");
			
			$this->form_validation->set_rules('address',"Business address","trim|required");
			$this->form_validation->set_rules('business_location',"Business Google Maps Link","trim|required");
			$this->form_validation->set_rules('total_chairs', 'Total Chairs ', 'required|numeric|max_length[2]'); 
			$this->form_validation->set_rules('opening_time', 'Opening time ', 'required'); 
			$this->form_validation->set_rules('closing_time', 'Closing time ', 'required'); 
			$this->form_validation->set_rules('postal_code','Postal Code','trim|required|max_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $business_name = ucwords(strtolower($this->security->xss_clean($this->input->post('business_name'))));
                $business_description = $this->security->xss_clean($this->input->post('business_description'));
                
                
                $businessInfo = array();
                $businessInfo['business_name']        = $business_name;
                $businessInfo['business_slug']        = $slug;
                $businessInfo['business_description'] = $business_description;
                
                $businessInfo['email']                = $this->input->post('email');
                $businessInfo['mobile_number']        = $this->input->post('mobile');
                $businessInfo['city_id']              = $this->input->post('city_id');
                $businessInfo['area_id']              = $this->input->post('area_id');
                $businessInfo['address']              = $this->input->post('address');
                $businessInfo['opening_time']         = $this->input->post('opening_time');
                $businessInfo['closing_time']         = $this->input->post('closing_time');
                $businessInfo['total_chairs']         = $this->input->post('total_chairs');
                $businessInfo['postal_code']          = $this->input->post('postal_code');
                $businessInfo['business_location']    = $this->input->post('business_location');
                $businessInfo['business_type']      = $this->input->post('business_type');
                $businessInfo['business_status']      = $this->input->post('business_status');
                
                $businessInfo['createdBy']            = $this->vendorId;
                $businessInfo['createdDtm']           = date('Y-m-d H:i:s');
                
                $businessInfo['business_img']=""; 
	 			if($_FILES['business_img']['name']!==""){
	 				$upload_image=$this->_upload_files($_FILES);
	 				if (array_key_exists('error', $upload_image)) {
	 				    print_r($upload_image['error']);
	 				}else{
	 					$businessInfo['business_img']=$upload_image['upload_data']['file_name'];
	 				}
	 			}
                
                $result = $this->nearchair_business_model->addNewBusiness($businessInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New business created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Business creation failed');
                }
                
                redirect('backoffice/business/addNew');
            }
        }
    }
    
    /**
     * This function is used load business edit information
     * @param number $business : Optional : This is business id
     */
    function editBusiness($business_id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($business_id == null)
            {
                redirect('businessListing');
            }
            
            $data['businessInfo'] = $this->nearchair_business_model->getBusinessInfo($business_id);
            $this->load->model('nearchair_city_model');
            $data['cities'] = $this->nearchair_city_model->getCities();
            
            $this->global['pageTitle'] = 'NearChair : Edit business';
            
            $this->loadAdminViews("business/editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to update business information
     */
    function updateBusiness($business_id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $business_id =$this->input->post('business_id');
            
            $this->form_validation->set_rules('business_name','Business Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('business_description','Business Description','trim|required');
    
            $original_email =$this->nearchair_business_model->getOrginalEmail($business_id);

			if($this->input->post('email') != $original_email) {
				$is_unique =  '|is_unique[businesses.email]';
			}else{
				$is_unique =  '';
			}
			

			$this->form_validation->set_rules('email', 'Business Email', 'required|valid_email|trim'.$is_unique);
			
			$this->form_validation->set_rules('mobile', 'Mobile Number ', 'required'); 
			$this->form_validation->set_rules('city_id',"Business City","trim|required");
			$this->form_validation->set_rules('area_id',"Business Area","trim|required");
			$this->form_validation->set_rules('business_location',"Business Google Maps Link","trim|required");
			$this->form_validation->set_rules('address',"Business address","trim|required");
			$this->form_validation->set_rules('opening_time', 'Opening time', 'required'); 
			$this->form_validation->set_rules('closing_time', 'Closing time', 'required'); 
			$this->form_validation->set_rules('total_chairs', 'Total Chairs ', 'required|numeric|max_length[2]'); 
			$this->form_validation->set_rules('postal_code','Postal Code','trim|required|max_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editBusiness($business_id);
            }
            else
            {
                $business_name = ucwords(strtolower($this->security->xss_clean($this->input->post('business_name'))));
                $business_description = $this->security->xss_clean($this->input->post('business_description'));
                
                
                $businessInfo = array();
                $businessInfo['business_name']        = $business_name;
                $businessInfo['business_description'] = $business_description;
                
                $businessInfo['email']                = $this->input->post('email');
                $businessInfo['mobile_number']        = $this->input->post('mobile');
                $businessInfo['city_id']              = $this->input->post('city_id');
                $businessInfo['area_id']              = $this->input->post('area_id');
                $businessInfo['address']              = $this->input->post('address');
                $businessInfo['opening_time']         = $this->input->post('opening_time');
                $businessInfo['closing_time']         = $this->input->post('closing_time');
                $businessInfo['total_chairs']         = $this->input->post('total_chairs');
                $businessInfo['postal_code']          = $this->input->post('postal_code');
                $businessInfo['business_location']    = $this->input->post('business_location');
                $businessInfo['business_status']      = $this->input->post('business_status');
                $businessInfo['business_type']      = $this->input->post('business_type');
                
                $businessInfo['updatedBy']            = $this->vendorId;
                $businessInfo['updatedDtm']           = date('Y-m-d H:i:s');
                
                 
	 			if($_FILES['business_img']['name']!==""){
	 				$upload_image=$this->_upload_files($_FILES);
	 				if (array_key_exists('error', $upload_image)) {
	 				    print_r($upload_image['error']);
	 				}else{
	 					$businessInfo['business_img']=$upload_image['upload_data']['file_name'];
	 				}
	 			}
                
                $result = $this->nearchair_business_model->updateBusiness($businessInfo,$business_id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Business updated successfully');
                    if($businessInfo['business_status']=='0'){
                        redirect('businessPending');
                    }elseif($businessInfo['business_status']=='1'){
                        redirect('businessAccepted');
                    }elseif($businessInfo['business_status']=='2'){
                        redirect('businessCancelled');
                    }else{
                        redirect('businessListing');
                    }
                    
                }
                else
                {
                    $this->session->set_flashdata('error', 'Business update failed');
                    redirect('backoffice/editBusiness/'.$business_id);
                }
                
                redirect('businessListing');
            }
        }
    }
    function numeric_wcomma ($str)
    {
        return preg_match('/^[0-9,]+$/', $str);
    }
    
    /**
     * This function is used to check whether email already exist or not
     */
    function checkBusinessEmailExists()
    {
        $business_id = $this->input->post("business_id");
        $email = $this->input->post("email");

        if(empty($business_id)){
            $result = $this->nearchair_business_model->checkBusinessEmailExists($email);
        } else {
            $result = $this->nearchair_business_model->checkBusinessEmailExists($email, $business_id);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to check whether slug already exist or not
     */
    function checkBusinessSlugExists()
    {
        $business_id = $this->input->post("business_id");
        $slug = $this->input->post("business_slug");

        if(empty($business_id)){
            $result = $this->nearchair_business_model->checkBusinessSlugExists($slug);
        } else {
            $result = $this->nearchair_business_model->checkBusinessSlugExists($slug, $business_id);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }


    /**
     * This function is used to move the business using business_id and business_status
     * @return boolean $result : TRUE / FALSE
     */
    function moveBusiness()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $business_id = $this->input->post('business_id');
            $business_status = $this->input->post('business_status');
            $businessInfo = array('business_status'=>$business_status,'updatedBy'=>$this->vendorId,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_business_model->moveBusiness($business_id, $businessInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }


    /**
     * This function is used to delete the business using business_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteBusiness()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $business_id = $this->input->post('business_id');
            $businessInfo = array('isDeleted'=>1,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_business_model->deleteBusiness($business_id, $businessInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    
    /**
	* This Function is for upload images
	*
	* @param Driver Table Param 
	* @return Success Result Table Json
	* @author juman
	* @version 2019-08-16
	*/
	private  function _upload_files($files)
	{	
	    $config['upload_path']          = './drives/business/';
	    $config['allowed_types']        = 'gif|jpg|png|jpeg';
	    $config['max_size']             = 3000;
	    $config['max_width']            = 2400;
	    $config['max_height']           = 1800;

	    $this->load->library('upload', $config);
        $this->upload->initialize($config);
	    if ( ! $this->upload->do_upload('business_img'))
	    {
	         return   $error = array('error' => $this->upload->display_errors());

	           // $this->load->view('upload_form', $error);
	    }
	    else
	    {
	           return $data = array('upload_data' => $this->upload->data());

	           // $this->load->view('upload_success', $data);
	    }
	}

    
    /**
     * This function is used to load the add new service
     */
    function addService($business_id = NULL)
    {

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = 'NearChair : Add New Service';
            $business_type= $this->nearchair_business_model->getBusinessType($business_id);
            if($business_type=="1" || $business_type=="2"){
                $data['allcategories'] = $this->nearchair_business_model->getCategoriesByType(array('category_type'=>$business_type));
            }else{
                $data['allcategories'] = $this->nearchair_business_model->getCategories();
            }
           
            $data['business_id'] = $business_id;
            $data['page_sts'] = 'ADD';
            $data['businessName'] = $this->nearchair_business_model->get_businessName($business_id);
            $data['seviceList'] = $this->nearchair_business_model->get_seviceList($business_id);
            $data['businessInfo'] = $this->nearchair_business_model->get_business_info($business_id);
            $this->loadAdminViews("business/addNewService", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to load the add new service
     */
    function editService($service_id = null, $business_id = null)
    {

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {

            if(($service_id > 0 && $service_id != "") && ($business_id > 0 && $business_id != "")){
                $this->global['pageTitle'] = 'NearChair : Edit Service';
                $business_type= $this->nearchair_business_model->getBusinessType($business_id);
                if($business_type>0){
                    $data['allcategories'] = $this->nearchair_business_model->getCategoriesByType(array('category_type'=>$business_type));
                }else{
                    $data['allcategories'] = $this->nearchair_business_model->getCategories();
                }
                $data['business_id'] = $business_id;
                $data['page_sts'] = 'EDIT';
                $data['businessName'] = $this->nearchair_business_model->get_businessName($business_id);
                $data['seviceList'] = $this->nearchair_business_model->get_seviceList($business_id);
                $data['singleService'] = $this->nearchair_business_model->get_singleService($service_id,$business_id);
                $data['businessInfo'] = $this->nearchair_business_model->get_business_info($business_id);
                $this->loadAdminViews("business/addNewService", $this->global, $data, NULL);
            }

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
            
            $business_id =$this->input->post('business_id');
            $this->form_validation->set_rules('service_name','Service Name','trim|required');
            $this->form_validation->set_rules('cat_id',"Category id","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_price',"Service Price","trim|required|numeric");
            $this->form_validation->set_rules('service_time_hr',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_time_min',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_description',"Description","trim");


            if($this->form_validation->run() == FALSE)
            {
                $this->addService($business_id);
            }
            else
            {


                $service_name = ucwords(strtolower($this->security->xss_clean($this->input->post('service_name'))));
                $service_description = $this->security->xss_clean($this->input->post('service_description'));
                
                
                $serviceInfo = array();
                $serviceInfo['service_name']        = $service_name;
                $serviceInfo['service_description'] = $service_description;
                
                $serviceInfo['service_slug']         = str_slug($service_name);
                $serviceInfo['cat_id']               = $this->input->post('cat_id');
                $serviceInfo['business_id']          = $business_id = $this->input->post('business_id');
                $serviceInfo['service_time']         = $this->input->post('service_time_hr').':'.$this->input->post('service_time_min');
                $serviceInfo['service_price']        = $this->input->post('service_price');
                $serviceInfo['createdDtm']           = date('Y-m-d H:i:s');
                
                if(($this->input->post('service_time_hr')=="") || ($this->input->post('service_time_min')==""))
                {
                    $this->session->set_flashdata('error_msg', 'Time Must Be Fill-Up');
                    $this->session->set_flashdata('error', 'error');
                    $this->addService($business_id);
                }

                $result = $this->nearchair_business_model->insertData('business_services',$serviceInfo);
                
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Service created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Service creation failed');
                }
                
                redirect('backoffice/business/addService/'.$business_id);

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

            $business_id =$this->input->post('business_id');
            $service_id =$this->input->post('service_id');
            $this->form_validation->set_rules('service_name','Service Name','trim|required');
            $this->form_validation->set_rules('cat_id',"Category Id","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_price',"Service Price","trim|required|numeric");
            $this->form_validation->set_rules('service_time_hr',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_time_min',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_description',"Description","trim");


            if($this->form_validation->run() == FALSE)
            {
                $this->index();
            }
            else
            {


                $service_name = ucwords(strtolower($this->security->xss_clean($this->input->post('service_name'))));
                $service_description = $this->security->xss_clean($this->input->post('service_description'));

                $serviceInfo = array();
                $serviceInfo['service_name']        = $service_name;
                $serviceInfo['service_description'] = $service_description;
                
                $serviceInfo['service_slug']         = str_slug($service_name);
                $serviceInfo['cat_id']               = $this->input->post('cat_id');
                $serviceInfo['service_time']         = $this->input->post('service_time_hr').':'.$this->input->post('service_time_min');
                $serviceInfo['service_price']        = $this->input->post('service_price');
                $serviceInfo['updatedDtm']           = date('Y-m-d H:i:s');
                
                if(($this->input->post('service_time_hr')=="") || ($this->input->post('service_time_min')==""))
                {
                    $this->session->set_flashdata('error_msg', 'Time Must Be Fill-Up');
                    $this->session->set_flashdata('error', 'error');
                    $this->index();
                }
                $where = array('business_id' => $business_id,'service_id' => $service_id);
                $result = $this->nearchair_business_model->where_update('business_services',$where,$serviceInfo);
                
                if($result!=FALSE)
                {
                    $this->session->set_flashdata('success', 'Service updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Service updated failed');
                }
                
                redirect('backoffice/business/addService/'.$business_id);
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
            $business_id = $this->input->post('business_id');
            $serviceInfo = array('isDeleted'=>1, 'updatedDtm'=>date('Y-m-d H:i:s'));
            $where = array('service_id'=>$service_id, 'business_id'=>$business_id);
            
            $result = $this->nearchair_business_model->where_update('business_services',$where, $serviceInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    
    /**
     * This function is used to load the add new form
     */
    function add_gallery_image()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else{
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('business_id','Business Id','trim|required|max_length[128]');
            
            if($this->form_validation->run() == FALSE)
            {                
                echo validation_errors();
                exit;
            }
            else
            {
    
                // Db Query Start
                $this->db->trans_begin();   
                
                try{
                    
    
                    $business_id = $this->input->post('business_id');
    
    
                    $fileName="";
                    if ($_FILES['gallery_image']['name']!=="") {
                        $files = $_FILES;
                        $count = count($_FILES['gallery_image']['name']);
                        for($i=0; $i<$count; $i++)
                        {
                            $random_var = rand(100000,999999);
                            $_FILES['gallery_image']['name']= $random_var.$files['gallery_image']['name'][$i];
                            $_FILES['gallery_image']['type']= $files['gallery_image']['type'][$i];
                            $_FILES['gallery_image']['tmp_name']= $files['gallery_image']['tmp_name'][$i];
                            $_FILES['gallery_image']['error']= $files['gallery_image']['error'][$i];
                            $_FILES['gallery_image']['size']= $files['gallery_image']['size'][$i];
                            $config['upload_path'] = './resource/app/images/gallery';
                            $config['allowed_types'] = '*';
                            $config['max_size']     = 15000;
                            $config['max_width']    = 5000;
                            $config['max_height']   = 5000;
                            $config['overwrite'] = false;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            $res = $this->upload->do_upload('gallery_image');
                            if(!$res) { echo json_encode($res);exit; }
                            $fileName = $_FILES['gallery_image']['name'];
                            $images[] = $fileName;
                        }
                        $fileName = implode(',',$images);
                    }
    
                    $result = $this->nearchair_business_model->add_gallery_image($business_id,$fileName);
    
                    if($result==false){
                        throw new Exception('Something is wrong !');
                    }
                    if ($this->db->trans_status() === FALSE)
                    {
                        throw new Exception("transaction error");
                    }
                     $this->db->trans_commit();
                     
                     $this->session->set_flashdata('success', 'Image Added Successfully');
    
                }
                catch(Exception $E){
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error', $E->getMessage());
                }
            }

            redirect('backoffice/business/addService/'.$business_id);
        }
    }
    
    
    /**
     * This function is used to load the add new form
     */
    function deleteGalleryImage()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $id = $this->input->post('gallery_id');
            $where = array('gallery_id' => $id);
    
            $imageName =$this->nearchair_business_model->get_single_field('business_gallery',$where,'image');
            $result = $this->nearchair_business_model->where_delete('business_gallery',$where);
            if($result){
                
                if($imageName){
                    $filename = 'resource/app/images/gallery/'.$imageName;
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                    
                    echo 'Image Deleted';
                }
                
            }else{
                echo 'Something Is Wrong !';
            }
            exit;
        }
    }


    public  function suggestionService()
    {   
        
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if (isset($_GET['term'])){
              $q = strtolower($_GET['term']);
              $this->nearchair_business_model->get_autosearch_data('business_services','service_name',$q);
            }    
        }
    }
    


}