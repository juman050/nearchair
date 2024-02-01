<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : ownerController (public/ownerController)
 * This class is only for authanticated owner
 * @author : Emon
 * @version : 1.0
 * @since : 26 Augest 2019
 */
class ownerController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('app/frontend_login_model');
        $this->load->model('app/frontend_owner_model');
        $this->load->model('app/frontend_common_model');
        $this->load->model('app/app_model');
        $this->isOwnerLoggedIn();
    }

    /**
     * Index Page for this controller.
    */
    public function index()
    {

        $data=array();
        $this->global['pageTitle'] = 'NearChair : Profile';
        $this->global['pageName'] = 'Profile';
        $where = array('isDeleted' => 0,'status' => 1);
        
        $ownerId = $this->session->userdata('owner_id');
        $data['owner_image'] = $this->frontend_common_model->get_single_field('owners',array('owner_id'=>$ownerId),'owner_image');
        $data['global_business_id'] = $bus_id = $this->frontend_owner_model->get_business_id($ownerId);
        $data['ratings'] = $this->frontend_owner_model->get_ratings($bus_id);
        $data['allbusinesses'] = $this->frontend_owner_model->get_business_info($ownerId);
        $this->loadOwnerViews("profile/index", $this->global, $data, NULL);

    }
    

    /**
     * Index Page for this controller.
    */
    public function sendOwnerEmail($slug)
    {

        $data=array();
        $this->global['pageTitle'] = 'NearChair : Profile';
        $this->global['pageName'] = 'Profile';
        $where = array('isDeleted' => 0,'status' => 1);
        
        $ownerId = $this->session->userdata('owner_id');
        $data['owner_image'] = $this->frontend_common_model->get_single_field('owners',array('owner_id'=>$ownerId),'owner_image');
        $data['global_business_id'] = $bus_id = $this->frontend_owner_model->get_business_id($ownerId);
        $data['ratings'] = $this->frontend_owner_model->get_ratings($bus_id);
        $data['allbusinesses'] = $this->frontend_owner_model->get_business_info($ownerId);
        $this->loadOwnerViews("profile/index", $this->global, $data, NULL);

    }
    

    /**
     * ownerOrders Page for this controller.
    */
    public function ownerOrders()
    {

        $data=array();
        $this->global['pageTitle'] = 'NearChair : Orders';
        $this->global['pageName'] = 'Order History';

        $ownerId = $this->session->userdata('owner_id');
        $data['global_business_id'] = $this->frontend_owner_model->get_business_id($ownerId);

        $data['allbusinesses'] = $this->frontend_owner_model->get_business_info($ownerId);
        if(isset($data['allbusinesses'][0]->business_id)){
            $data['userOrders'] = $this->frontend_owner_model->getBusinessOrders($data['allbusinesses'][0]->business_id);
        }
        $this->loadOwnerViews("profile/orders", $this->global, $data, NULL);

    }
    /**
     * ownerOrders Page for this controller.
    */
    public function pendingOrders()
    {

        $data=array();
        $this->global['pageTitle'] = 'NearChair : Orders';
        $this->global['pageName'] = 'Pending Orders';

        $ownerId = $this->session->userdata('owner_id');
        $data['global_business_id'] = $this->frontend_owner_model->get_business_id($ownerId);

        $data['allbusinesses'] = $this->frontend_owner_model->get_business_info($ownerId);
        if(isset($data['allbusinesses'][0]->business_id)){
            $data['userOrders'] = $this->frontend_owner_model->getBusinessPendingOrders($data['allbusinesses'][0]->business_id);
        }
        $this->loadOwnerViews("profile/pendingOrders", $this->global, $data, NULL);

    }
    

    /**
     * ownerBusinessInfo Page for this controller.
    */
    public function ownerBusiness()
    {
        $data=array();
        $this->global['pageTitle'] = 'NearChair : Business Info';
        $this->global['pageName'] = 'Business Info';
        
        $ownerId = $this->session->userdata('owner_id');
        $data['global_business_id'] = $this->frontend_owner_model->get_business_id($ownerId);
        
        $where2 = array('isDeleted' => 0,'city_status' => 1);
        $data['allCities'] = $this->frontend_common_model->get_where('cities',$where2);

        $data['allbusinesses'] = $this->frontend_owner_model->get_business_info($ownerId);
        $this->loadOwnerViews("profile/businessInfo", $this->global, $data, NULL);

    }
    

    /**
     * ownerBusinessInfo Page for this controller.
    */
    public function ownerAddService()
    {
        $data=array();
        $this->global['pageTitle'] = 'NearChair : Add Service';
        $this->global['pageName'] = 'Add Service';
        $ownerId = $this->session->userdata('owner_id');
        $data['global_business_id'] = $this->frontend_owner_model->get_business_id($ownerId);

        $where = array('isDeleted' => 0,'status' => 1);
        $data['allcategories'] = $this->frontend_common_model->get_where('categories',$where);

        $data['allbusinesses'] = $this->frontend_owner_model->get_business_info($ownerId);
        $this->loadOwnerViews("profile/addService", $this->global, $data, NULL);

    }
    

    /**
     * ownerBusinessInfo Page for this controller.
    */
    public function ownerGallery()
    {
        $data=array();
        $this->global['pageTitle'] = 'NearChair : Gallery';
        $this->global['pageName'] = 'Gallery';
        $ownerId = $this->session->userdata('owner_id');
        $data['global_business_id'] = $this->frontend_owner_model->get_business_id($ownerId);

        $data['allbusinesses'] = $this->frontend_owner_model->get_business_info($ownerId);
        $this->loadOwnerViews("profile/gallery", $this->global, $data, NULL);

    }
    


    /**
     * ownerBusinessInfo Page for this controller.
    */
    public function ownerServiceList()
    {
        $data=array();
        $this->global['pageTitle'] = 'NearChair : Service List';
        $this->global['pageName'] = 'Service List';
        $ownerId = $this->session->userdata('owner_id');
        $data['global_business_id'] = $this->frontend_owner_model->get_business_id($ownerId);

        $where = array('isDeleted' => 0,'status' => 1);
        $data['allcategories'] = $this->frontend_common_model->get_where('categories',$where);

        $data['seviceCategory'] = $this->frontend_owner_model->get_seviceCategory($ownerId);
        
        $data['allbusinesses'] = $this->frontend_owner_model->get_business_info($ownerId);
        $this->loadOwnerViews("profile/serviceList", $this->global, $data, NULL);

    }
    



    /**
     * Index Page for this controller.
    */
    public function add_gallery_image()
    {

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
                        $config['max_size']     = 5000;
                        $config['max_width']    = 2000;
                        $config['max_height']   = 2000;
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

                $result = $this->frontend_owner_model->add_gallery_image($business_id,$fileName);

                if($result==false){
                    throw new Exception('Something is wrong !');
                }
                if ($this->db->trans_status() === FALSE)
                {
                    throw new Exception("transaction error");
                }
                 $this->db->trans_commit();
                 
                 
                 echo $data = "Image Added Successfully";
                 exit;

            }
            catch(Exception $E){
                $this->db->trans_rollback();
                echo $data = $E->getMessage();
                exit;
            }
        }
        exit;

    }
    

    /**
     * Update Business
    */
    public function updateBusiness()
    {

            $this->load->library('form_validation');
            
            $business_id =$this->input->post('business_id');
            
            $this->form_validation->set_rules('business_name','Business Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('business_description','Business Description','trim|required');
    
            $this->form_validation->set_rules('mobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{11}$/]'); //{11} for 10 digits number
            $this->form_validation->set_rules('city_id',"Business City","trim|required");
            
            $this->form_validation->set_rules('address',"Business address","trim|required");
            $this->form_validation->set_rules('total_chairs', 'Total Chairs ', 'required|numeric|max_length[2]'); 
            $this->form_validation->set_rules('postal_code','Postal Code','trim|required|max_length[10]');
            
            if($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
                exit;
            }
            else
            {

                $business_name = ucwords(strtolower($this->security->xss_clean($this->input->post('business_name'))));
                $business_description = $this->security->xss_clean($this->input->post('business_description'));
                
                
                $businessInfo = array();
                $businessInfo['business_name']        = $business_name;
                $businessInfo['business_description'] = $business_description;
                $businessInfo['mobile_number']        = $this->input->post('mobile');
                $businessInfo['city_id']              = $this->input->post('city_id');
                $businessInfo['address']              = $this->input->post('address');
                $businessInfo['total_chairs']         = $this->input->post('total_chairs');
                $businessInfo['postal_code']          = $this->input->post('postal_code');
                $businessInfo['updatedDtm']           = date('Y-m-d H:i:s');
                
                // $businessInfo['business_img'] = "";
                if($_FILES['business_img']['name']!==""){
                    $upload_image=$this->_upload_files($_FILES);
                    if (array_key_exists('error', $upload_image)) {
                        print_r($upload_image['error']);
                    }else{
                        $businessInfo['business_img']=$upload_image['upload_data']['file_name'];
                    }
                }
                
                $result = $this->frontend_common_model->where_update('businesses',array('business_id' => $business_id), $businessInfo);
                
                if($result != false)
                {
                    $data = "Business Updated successfully";
                    
                }else{

                    $data = "Something Is Missing !";

                }
                
                echo $data;
                exit;
            }

    }
    

    /**
     * Update Order Status
    */
    public function changeOrderStatus()
    {
            $order_id =$this->input->post('order_id');
            $order_status =$this->input->post('or_status');
            
            $orderInfo = array();
            $orderInfo['order_status']        = $order_status;
            $result = $this->frontend_common_model->where_update('orders',array('order_id' => $order_id), $orderInfo);
            
            if($result != false)
            {
                redirect('app/pendingOrders');
                
            }else{
                redirect('app/pendingOrders');
            }

    }
    

    /**
     * Add Service
    */
    public function add_service()
    {
            $this->load->library('form_validation');
            
            $business_id =$this->input->post('business_id');
            $this->form_validation->set_rules('service_name','Service Name','trim|required');
            $this->form_validation->set_rules('cat_id',"Category Id","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_price',"Service Price","trim|required|numeric");
            $this->form_validation->set_rules('service_discount_price',"Discount Price","trim");
            $this->form_validation->set_rules('service_time_hr',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_time_min',"Service Time","trim|required|numeric|max_length[2]");
            $this->form_validation->set_rules('service_description',"Description","trim");


            if($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
                //$this->index();
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
                $serviceInfo['business_id']          = $business_id;
                $serviceInfo['service_time']         = $this->input->post('service_time_hr').':'.$this->input->post('service_time_min');
                $serviceInfo['service_price']        = $this->input->post('service_price');
                $serviceInfo['service_discount_price'] = $this->input->post('service_discount_price');
                $serviceInfo['createdDtm']           = date('Y-m-d H:i:s');
                
                if(($this->input->post('service_time_hr')=="") || ($this->input->post('service_time_min')==""))
                {
                    $this->session->set_flashdata('error_msg', 'Time Must Be Fill-Up');
                    $this->session->set_flashdata('error', 'error');
                    $this->index();
                }

                $result = $this->frontend_common_model->insertData('business_services',$serviceInfo);
                
                if($result != false)
                {
                    $data = array(
                        'msg' => 'Service Added successfully',
                        'status' => 'success',
                    );
                    
                }else{

                    $data = array(
                        'msg' => 'Something Is Missing !',
                        'status' => 'error',
                    );

                }
                
                echo  json_encode($data);
                exit;
            }

    }
    


    /**
    * This Function is for upload images
    *
    * @param 
    * @return Success Result Table html
    * @author emon
    * @version 2019-08-26
    */
    public  function deleteGalleryImage()
    {   
        $id = $this->input->post('gallery_id');
        $where = array('gallery_id' => $id);

        $imageName =$this->frontend_common_model->get_single_field('business_gallery',$where,'image');
        $result = $this->frontend_common_model->where_delete('business_gallery',$where);
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
    
    /**
    * This Function is for suggestion Service
    *
    * @param 
    * @return Service name's json data
    * @author emon
    * @version 2019-09-03
    */
    public  function suggestionService()
    {   
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->frontend_common_model->get_autosearch_data('business_services','service_name',$q);
        }    
    }

    
    /**
    * This Function is delete service
    *
    * @param 
    * @return Success Result Table html
    * @author emon
    * @version 2019-09-3
    */
    public  function deleteService()
    {
        $id = $this->input->get('id');
        $business_id = $this->input->get('business_id');
        $where = array('service_id' => $id,'business_id' => $business_id);
        $data = array('isDeleted' => 1);

        $result = $this->frontend_common_model->where_update('business_services',$where, $data);
        if($result){
            echo 'Service Deleted';
        }else{
            echo 'Something Is Wrong !';
        }
        exit;
                
    }



    /**
     * Get Single Service
    */
    public function getSingleService()
    {

        $id = $this->input->get('id');
        $business_id = $this->input->get('business_id');
        $where = array('service_id' => $id,'business_id' => $business_id);

        $serviceInfo = $this->frontend_common_model->get_where('business_services',$where);

        echo json_encode($serviceInfo);
        exit;
    }
    

    /**
     * Edit Service
    */
    public function editService()
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
            $this->form_validation->set_rules('service_discount_price',"Discount Price","trim");


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
                $serviceInfo['service_discount_price']        = $this->input->post('service_discount_price');
                $serviceInfo['updatedDtm']           = date('Y-m-d H:i:s');
                
                if(($this->input->post('service_time_hr')=="") || ($this->input->post('service_time_min')==""))
                {
                    $this->session->set_flashdata('error_msg', 'Time Must Be Fill-Up');
                    $this->session->set_flashdata('error', 'error');
                    $this->index();
                }
                $where = array('business_id' => $business_id,'service_id' => $service_id);
                $result = $this->frontend_common_model->where_update('business_services',$where, $serviceInfo);
                
                if($result != false)
                {
                    $data = array(
                        'msg' => 'Updated successfully',
                        'status' => 'success',
                    );
                    
                }else{

                    $data = array(
                        'msg' => 'Something Is Missing !',
                        'status' => 'error',
                    );

                }
                
                echo  json_encode($data);
                exit;
            }

    }
    


    /**
     * Get Single Business All servicess
    */
    public function singleBusinessServices()
    {
        $data=array();
        $this->global['pageTitle'] = 'NearChair : Profile';
        $this->global['pageName'] = 'Profile';

        $ownerId = $this->session->userdata('owner_id');
        $data['seviceList'] = $this->frontend_owner_model->get_seviceList($ownerId);
        $data['seviceCategory'] = $this->frontend_owner_model->get_seviceCategory($ownerId);
        $this->load->view('app/profile/appendServiceList',$data);
        // exit;

    }
    
    

    /**
     * Update business_status
    */
    public function change_business_status()
    {

            $sts =$this->input->post('sts');
            $business_id =$this->input->post('business_id');
            
            $businessInfo = array();
            $businessInfo['business_on_off']        = $sts;

            $result = $this->frontend_common_model->where_update('businesses',array('business_id' => $business_id), $businessInfo);
            
            if($result != false)
            {
                if($sts==1){
                    $data = "<span style='color:#12CC94;'>Online</span>";
                }else{
                    $data = "<span style='color:#FB3569;'>Offline</span>";
                }
                
            }else{

                $data = "Something Is Missing !";

            }
            
            echo $data;
            exit;
            

    }


    /**
     * Get Details of user single order
    */
    public function singleBusinessOrderDetails()
    {
        $data=array();
        $order_id = $this->input->post('order_id');
        $data['userOrders'] = $this->frontend_owner_model->getOrdersDetails($order_id);
        $data['userOrderServices'] = $this->frontend_owner_model->getOrderServices($order_id);
        $data['userOrderAdvanced'] = $this->frontend_owner_model->getOrderAdvanced($order_id);

        $ownerId = $this->session->userdata('owner_id');
        $data['global_business_id'] = $bussiness_id = $this->frontend_owner_model->get_business_id($ownerId);
        
        $data['isAnyOffer'] = $this->frontend_owner_model->isAnyOffer($bussiness_id);
        
        $this->load->view("app/profile/orderDetails",$data);
    }


    function ownerChangeProfilePic()
    {

            // Db Query Start
            $this->db->trans_begin();
            try{
                
                $businessInfo = array();
                $businessInfo['updatedDtm'] = date('Y-m-d H:i:s');

                if($_FILES['business_img']['name']!==""){
                     
                    $upload_image=$this->_upload_files($_FILES);

                    if (array_key_exists('error', $upload_image)) {
                        print_r($upload_image['error']);
                    }else{
                        $businessInfo['owner_image']=$upload_image['upload_data']['file_name'];
                    }
                }
                
                $ownerId = $this->session->userdata('owner_id');
                $result = $this->frontend_owner_model->update_business_image($ownerId,$businessInfo);

                if ($this->db->trans_status() === FALSE)
                {
                    throw new Exception("transaction error");
                }
                if($result!=FALSE){
                    $data = array(
                        'msg' => 'Image Updated',
                        'status' => 'success',
                    );
                }else{
                    throw new Exception('Something is wrong !');
                }

            }
            catch(Exception $E){

                $data = array(
                    'msg' => $E->getMessage(),
                    'status' => 'error',
                );
            }
            echo json_encode($data);
            exit;

    }

    
    /**
    * This Function is for upload images
    *
    * @param Driver Table Param 
    * @return Success Result Table Json
    * @author emon
    * @version 2019-08-26
    */
    private  function _upload_files($files)
    {  

        $config['upload_path']          = './drives/business';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 6000;
        $config['max_width']            = 2000;
        $config['max_height']           = 2000;

        $this->load->library('upload', $config);
        
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('business_img'))
        {
            return   $error = array('error' => $this->upload->display_errors());
        }
        else
        {
            return $data = array('upload_data' => $this->upload->data());
        }
    }
    


    
}

?>