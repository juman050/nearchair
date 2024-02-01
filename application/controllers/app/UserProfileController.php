<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : UserProfileController (public/UserProfileController)
 * This class is only for authanticated user
 * @author : Emon
 * @version : 1.0
 * @since : 12 sept 2019
 */
class UserProfileController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('app/frontend_login_model');
        $this->load->model('app/frontend_common_model');
        $this->load->model('app/frontend_user_model');
        $this->load->model('app/app_model');
        $this->load->model('common_model');
        $this->global['system_data'] = $this->common_model->get_system_info();
        $this->isUserLoggedIn();
    }

    /**
     * Index Page for this controller.
    */
    public function index()
    {
        $data=array();
        $this->global['pageTitle'] = 'Profile';
        $this->global['pageName'] = 'Profile';
        $userId = get_cookie('user_id');
        $data['userProfile'] = $this->frontend_user_model->getUserProfile($userId);
        $this->loadFrontendViews("user/index", $this->global, $data, NULL);
    }
    
    /**
     * Index Page for this controller.
    */
    public function userProfileView()
    {
        $data=array();
        $this->global['pageTitle'] = 'Profile';
        $this->global['pageName'] = 'Edit_Profile';
        $userId = get_cookie('user_id');
        
        $where = array('city_status' => 1,'isDeleted' => 0);
        $data['userProfile'] = $this->frontend_user_model->getUserProfile($userId);
        $data['cities'] = $this->frontend_common_model->get_where('cities',$where);
        $data['sylhet_areas'] = $this->frontend_user_model->get_where();
        $this->loadFrontendViews("user/profileView", $this->global, $data, NULL);
    }
    /**
     * Index Page for this controller.
    */
    public function userProfileChangePassword()
    {
        $data=array();
        $this->global['pageTitle'] = 'Change Password';
        $this->global['pageName'] = 'Change_Password';
        $userId = get_cookie('user_id');
        $data['userProfile'] = $this->frontend_user_model->getUserProfile($userId);
        $this->loadFrontendViews("user/userChangePassword", $this->global, $data, NULL);
    }
    /**
     * User Order List.
    */
    public function userProfileOrderList()
    {
        $data=array();
        $this->global['pageTitle'] = 'My Booking';
        $this->global['pageName'] = 'My_Booking';
        $userId = get_cookie('user_id');
        $data['userProfile'] = $this->frontend_user_model->getUserProfile($userId);
        $data['userOrders'] = $this->frontend_user_model->getUserOrders($userId);
        $this->loadFrontendViews("user/userOrderList", $this->global, $data, NULL);
    }
    
    /**
     * Get Details of user single order
    */
    public function singleOrderDetails()
    {
        $data=array();
        $userId = get_cookie('user_id');
        $order_id = $this->input->post('order_id');
        $data['userOrders'] = $this->frontend_user_model->getOrdersDetails($order_id);
        $data['userOrderServices'] = $this->frontend_user_model->getOrderServices($order_id);
        $data['userOrderAdvanced'] = $this->frontend_user_model->getOrderAdvanced($order_id);
        $this->load->view("app/user/orderDetails",$data);
    }
    

    /**
     *  Check Old Password
    */
	function checkOldpassword(){

		$oldPassword=$this->input->post('oldPassword');
		$userId = get_cookie('user_id');
		$checkpassword=$this->frontend_user_model->checkOldpassword($oldPassword,$userId);
        if(empty($checkpassword)){ echo("false"); }
        else { echo("true"); }
	}

    function updateUserPassword()
    {
        $newPassword=$this->input->post('newPassword');
        $userId = get_cookie('user_id');
        $usersData = array('password'=>getHashedPassword($newPassword),'updatedDtm'=>date('Y-m-d H:i:s'));
        
        $result = $this->frontend_user_model->changePassword($userId, $usersData);
        
        if($result != false)
        {
            $data = array(
                'msg' => 'Successfully Changed',
                'status' => 'success',
            );

        }else{

            $data = array(
                'msg' => 'Something Is Missing !',
                'status' => 'error',
            );

        }
        echo json_encode($data);
        exit;
    }


    function updateUserProfile()
    {
        $userInfo['fullname']=$fullname=$this->input->post('fullname');
        $userInfo['email']=$this->input->post('email');
        $userInfo['city']=$city=$this->input->post('city');
        $userInfo['area']=$area=$this->input->post('area');
        $userInfo['address']=$this->input->post('address');
        $userInfo['gender']=$this->input->post('gender');
        
        $userMobile = get_cookie('mobile');
        $userId = get_cookie('user_id');
        $where = array('user_id' => $userId);
        $result = $this->frontend_common_model->where_update('users',$where, $userInfo);
        
        if($result != false)
        {
            $data = array(
                'msg' => 'Profile Updated',
                'status' => 'success',
            );

            $expire_time=time() +2592000;
            set_cookie('user_id',$userId,$expire_time);
            set_cookie('fullname',$fullname,$expire_time);
            set_cookie('city',$city,$expire_time);
            set_cookie('area',$area,$expire_time);
            set_cookie('mobile',$userMobile,$expire_time);
            set_cookie('isUserLoggedIn',TRUE,$expire_time);
        
        
        }else{

            $data = array(
                'msg' => 'Something Is Missing !',
                'status' => 'error',
            );

        }
        echo json_encode($data);
        exit;
    }

    function addreview()
    {
        $ratingInfo['business_id']=$this->input->post('business_id');
        $ratingInfo['user_id']=$this->input->post('user_id');
        $ratingInfo['order_id']=$this->input->post('order_id');
        $ratingInfo['rating']=$this->input->post('rating');
        $ratingInfo['review_text']=$this->input->post('review_text');
        date_default_timezone_set("Asia/Dhaka");
        $ratingInfo['createdDtm'] = date('Y-m-d H:i:s');
        $result = $this->frontend_common_model->insertData('business_reviews',$ratingInfo);
        
        if($result != false)
        {
            $data = array(
                'msg' => 'Sucessfully rated !',
                'status' => 'success',
            );
        }else{

            $data = array(
                'msg' => 'Something Is Missing !',
                'status' => 'error',
            );

        }
        echo json_encode($data);
        exit;
    }



    function changeProfilePic()
    {

            // Db Query Start
            $this->db->trans_begin();   
            
            try{
                

                $userInfo = array();
                $userInfo['updatedDtm'] = date('Y-m-d H:i:s');

                if($_FILES['image']['name']!==""){
                    $upload_image=$this->_upload_files($_FILES);
                    if (array_key_exists('error', $upload_image)) {
                        print_r($upload_image['error']);
                    }else{
                        $userInfo['image']=$upload_image['upload_data']['file_name'];
                    }
                }
                $userId = get_cookie('user_id');
                $result = $this->frontend_common_model->where_update('users',array('user_id' => $userId), $userInfo);

                if($result==false){
                    throw new Exception('Something is wrong !');
                }
                if ($this->db->trans_status() === FALSE)
                {
                    throw new Exception("transaction error");
                }
                $data = array(
                    'msg' => 'Image Updated',
                    'status' => 'success',
                );

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
        $config['upload_path']          = './drives/users/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPEG|JPG|PNG';
        $config['max_size']             = 6000;
        $config['max_width']            = 3000;
        $config['max_height']           = 3000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('image'))
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