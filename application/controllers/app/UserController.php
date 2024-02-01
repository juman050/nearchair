<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : UserController (app/UserController)
 * This is for saloon user login, registration etc
 * @author : Emon
 * @version : 1.0
 * @since : 9 sept 2019
 */
class UserController extends BaseController
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
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isUserLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isUserLoggedIn()
    {
        $isUserLoggedIn = get_cookie('isUserLoggedIn');
        
        if(!isset($isUserLoggedIn) || $isUserLoggedIn != TRUE)
        {
            $data=array();
            $this->global['pageTitle'] = 'Login';
            $this->global['pageName'] = 'LogIn';
            $data['pageName'] = 'LogIn';
            $this->loadFrontendViews("auth/loginUser", $this->global, $data, NULL);
        }
        else
        {
            redirect('app/userprofile');
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginUser()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $error = validation_errors();
            $data = array('status'=>'error','msg'=>$error);
            echo json_encode($data);
            exit;
            // $this->index();
        }
        else
        {
            $mobile = $this->input->post('mobile');
            $password = $this->input->post('password');
            
            $result = $this->frontend_login_model->loginUser($mobile, $password);
            
            if(!empty($result))
            {
                
                $expire_time=time() +2592000;
                set_cookie('user_id',$result->user_id,$expire_time);
                set_cookie('fullname',$result->fullname,$expire_time);
                set_cookie('city',$result->city,$expire_time);
                set_cookie('area',$result->area,$expire_time);
                set_cookie('mobile',$result->mobile,$expire_time);
                set_cookie('isUserLoggedIn',TRUE,$expire_time);
                
                $data = array('status'=>'success','msg'=>'Success');
                echo json_encode($data);
                exit;
                // redirect('app/userprofile');
            }
            else
            {
                $data = array('status'=>'error','msg'=>'Mobile or password mismatch');
                echo json_encode($data);
                exit;
                // $this->index();
            }
        }
    }



    
    /**
     * This function used to show register form
     */
    public function registerUser()
    {
        $isUserLoggedIn = get_cookie('isUserLoggedIn');
        
        if(!isset($isUserLoggedIn) || $isUserLoggedIn != TRUE)
        {
            $data=array();
            $this->global['pageTitle'] = 'Register';
            $this->global['pageName'] = 'Register';
            $data['pageName'] = 'Register';
            $this->loadFrontendViews("auth/registerUser", $this->global, $data, NULL);
        }
        else
        {
            redirect('app/userprofile');
        }
    }

    /**
     * This function used to show register form
     */
    public function forgotPassword()
    {
        $isUserLoggedIn = get_cookie('isUserLoggedIn');
        
        if(!isset($isUserLoggedIn) || $isUserLoggedIn != TRUE)
        {
            $data=array();
            $this->global['pageTitle'] = 'Forgot Password';
            $this->global['pageName'] = 'Forgot Password';
            $data['pageName'] = 'Forgot Password';
            $this->loadFrontendViews("auth/forgotPassword", $this->global, $data, NULL);
        }
        else
        {
            redirect('app/userprofile');
        }
    }


    /**
     * This function used to show register form
     */
    public function checkForgetVerifyCode()
    {
        $isUserLoggedIn = get_cookie('isUserLoggedIn');
        
        if(!isset($isUserLoggedIn) || $isUserLoggedIn != TRUE)
        {
            $data=array();
            $this->global['pageTitle'] = 'Verify Code';
            $this->global['pageName'] = 'Verify Code';
            $data['pageName'] = 'Verify Code';
            $data['mobile'] = $this->input->get('mobile');
            $data['otp'] = $this->input->get('otp');
            $this->loadFrontendViews("auth/forgotVerifyCode", $this->global, $data, NULL);
        }
        else
        {
            redirect('app/userprofile');
        }
    }

    /**
     * This function used to show register form
     */
    public function forgotChangePassword()
    {
        $isUserLoggedIn = get_cookie('isUserLoggedIn');
        
        if(!isset($isUserLoggedIn) || $isUserLoggedIn != TRUE)
        {
            $data=array();
            $this->global['pageTitle'] = 'Change Password';
            $this->global['pageName'] = 'Change Password';
            $data['pageName'] = 'Change Password';
            $data['mobile'] = $this->input->get('mobile');
            $data['code'] = $this->input->get('code');
            $data['verified'] = $this->input->get('verified');
            if($data['verified']=='success'){
                
                $this->loadFrontendViews("auth/forgotChangePassword", $this->global, $data, NULL);
            }
            else if($data['verified']=='failed'){
                
             
                $data=array();
                
                $this->global['pageTitle'] = 'Verify Code';
                $this->global['pageName'] = 'Verify Code';
                $data['pageName'] = 'Verify Code';
                $data['mobile'] = $this->input->get('mobile');
                $data['code'] = $this->input->get('code');
                $data['otp'] = $this->input->get('verified');
                $this->loadFrontendViews("auth/forgotVerifyCode", $this->global, $data, NULL);
            }
        }
        else
        {
            redirect('app/userprofile');
        }
    }

    
    /**
     * This function used to register a new user
     */
    public function insertUser()
    {
            
            $userInfo['fullname'] = $fullname = $this->security->xss_clean($this->input->get('fullname'));
            $userInfo['password'] = $password = getHashedPassword($this->input->get('password'));
            $userInfo['mobile'] = $mobile = $this->input->get('mobile');
            $otp = $this->input->get('otp');
            // $userInfo['random_code'] = rand(1000,9999);
            //$userInfo['random_code'] = 1111;
            $userInfo['user_status'] = 0;
            $userInfo['createdDtm'] = $createdDtm = date('Y-m-d H:i:s');

            $result = $this->frontend_common_model->insertData('users',$userInfo);
            $userAllData['user_id'] = $result;
            $userAllData['fullname'] = $fullname;
            $userAllData['mobile'] = $mobile;
            $this->checkCode($userAllData);
        
    }
    
    
    
    /**
     * This function used to Check Number exists or not
     */
    public function checknumber()
    {
        $mobile = trim($this->input->post("mobile"));
        $result = $this->frontend_user_model->check_number($mobile);
        
        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }

    
    
    /**
     * This function used to Check Number exists or not
     */
    public function checkForgotNumber()
    {
        $mobile = trim($this->input->post("mobile"));
        $result = $this->frontend_user_model->check_number($mobile);
        
        if(empty($result)){ echo("false"); }
        else { echo("true"); }
    }

    
    /**
     * This function used to get random code
     */
    public function checkCode($data=array())
    {
        if(empty($data)){
            redirect('app/registerUser');
        }else{
            $this->global['pageTitle'] = 'Code';
            $this->global['pageName'] = 'Verify Code';
            $data['pageName'] = 'Register';
            $data['otp'] = $this->input->get('otp');

            if($data['otp'] == 'success'){
                
                $upData['user_status'] = 1;
                $where['user_id'] = $data['user_id'];
                $this->frontend_common_model->where_update('users',$where,$upData);
                
                
                $where2 = array('mobile'=>$data['mobile'],'user_status'=>0);
                $this->frontend_common_model->where_delete('users',$where2);

                $expire_time=time() +2592000;
                set_cookie('user_id',$data['user_id'],$expire_time);
                set_cookie('fullname',$data['fullname'],$expire_time);
                set_cookie('mobile',$data['mobile'],$expire_time);
                set_cookie('isUserLoggedIn',TRUE,$expire_time);
                
                
                redirect('app/userprofile');
            }
        

            $this->loadFrontendViews("auth/verifycode", $this->global, $data, NULL);
        }

            
    }
    
    /**
     * This function used to get random code
     */
    public function get_area_by_city()
    {
        $city_id = $this->input->post('city_id');
        if(empty($city_id)){
            redirect('app/registerUser');
        }else{
            $datas = $this->frontend_common_model->get_where('areas',array('city_id'=>$city_id,'area_status'=>1,'isDeleted'=>0));
            $str="";
            if(!empty($datas)){
                foreach($datas as $data){
                   $str.= "<option value='.$data->city_id.'>";
                   $str.= $data->area_name;
                   $str.= "</option>";
                } 
            }else{
                $str.= "<option value=''>No data inserted yet</option>";
            }
            echo $str;
            exit;
        

        }

            
    }
    
    /**
     * This function used to get random code
     */
    public function verifyCode()
    {
        $this->load->library('form_validation');
        
        $userInfo['user_id'] = $user_id = $this->input->get('user_id');
        $userInfo['fullname'] = $fullname = $this->security->xss_clean($this->input->get('fullname'));
        $userInfo['mobile'] = $mobile = $this->input->get('mobile');
        $userInfo['code'] = $code = $this->input->get('code');

    }
        


    /**
     * This function used to show register form
     */
    public function ChangeForgotPassword()
    {
        $isUserLoggedIn = get_cookie('isUserLoggedIn');
        
        if(!isset($isUserLoggedIn) || $isUserLoggedIn != TRUE)
        {
            $newPassword=$this->input->post('newPassword');
            $mobile = $this->input->post('mobile');
            $usersData = array('password'=>getHashedPassword($newPassword),'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->frontend_user_model->changeForgotPassword($mobile, $usersData);
            
            if($result != false)
            {
                $data = array(
                    'msg' => 'Password Updated successfully',
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
        else
        {
            redirect('app/userprofile');
        }
    }


}





?>