<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : LoginController (app/LoginController)
 * This is for saloon owner login, registration etc
 * @author : Emon
 * @version : 1.0
 * @since : 26 Augest 2019
 */
class LoginController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('app/frontend_login_model');
        $this->load->model('app/app_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isOwnerLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isOwnerLoggedIn()
    {
        $isOwnerLoggedIn = $this->session->userdata('isOwnerLoggedIn');
        
        if(!isset($isOwnerLoggedIn) || $isOwnerLoggedIn != TRUE)
        {
            $data=array();
            $this->global['pageTitle'] = 'NearChair : Login';
            $data['pageName'] = 'Login';
            $this->global['pageName'] = 'Login';
            $this->loadOwnerViews("auth/login", $this->global, $data, NULL);
        }
        else
        {
            redirect('app/profile');
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginOwner()
    {

        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
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
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            
            $result = $this->frontend_login_model->loginOwner($email, $password);
            
            if(!empty($result))
            {

                $sessionArray = array('owner_id'=>$result->owner_id,                    
                                        'owner_name'=>$result->owner_name,
                                        'owner_email'=>$result->owner_email,
                                        'owner_mobile'=>$result->owner_mobile,
                                        'createdDtm'=>$result->createdDtm,
                                        'isOwnerLoggedIn' => TRUE
                                );

                $this->session->set_userdata($sessionArray);
                // redirect('app/profile');
                $data = array('status'=>'success','msg'=>'Success','ownerid'=>$result->owner_id);
                echo json_encode($data);
                exit;
            }
            else
            {
                $data = array('status'=>'error','msg'=>'Email or password mismatch');
                echo json_encode($data);
                exit;
            }
        }
    }




}

?>