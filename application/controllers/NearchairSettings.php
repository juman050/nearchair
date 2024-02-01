<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairSettings (Settings Controller)
 * NearchairSettings Class to control all system setting related operations.
 * @author : juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class NearchairSettings extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the primary system information
     */
    public function index()
    {        
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            
            $data['system_data'] = $this->common_model->get_system_info();
            $data['setting_active'] ="active";
            
            $this->global['pageTitle'] = 'NearChair : System Settings';
            
            $this->loadAdminViews("settings/index", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function used to load about us page
     */
    public function about_us()
    {        
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            
            $data['system_data'] = $this->common_model->get_system_info();
            $data['setting_active'] ="active";
            
            $this->global['pageTitle'] = 'NearChair : About Us';
            
            $this->loadAdminViews("settings/about", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function used to load the logos
     */
    public function logo()
    {        
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            
            $data['system_data'] = $this->common_model->get_system_info();
            $data['setting_active'] ="active";
            
            $this->global['pageTitle'] = 'NearChair : Customize Logo';
            
            $this->loadAdminViews("settings/logo", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to update the System Info
     */
    function updateSystemInfo()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data = $this->common_model->get_system_info();
            $postedData =$this->input->post(NULL);
            if(empty($data)){
                //insert data
                $result = $this->common_model->insertSystemData($postedData);
                
                if($result>0)
                {
                    $this->session->set_flashdata('success', 'System Information Inserted successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'System Information insertion failed');
                }
            }else{
                //update data
                $result = $this->common_model->updateSystemData($postedData);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'System Information updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'System Information updation failed');
                }
            }
            redirect('backoffice/settings/systemInfo');
            
        }
    }
    
    /**
     * This function is used to update about us page Content
     */
    function updateAboutUs()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data = $this->common_model->get_system_info();
            $postedData =$this->input->post(NULL);
            if(empty($data)){
                //insert data
                $result = $this->common_model->insertSystemData($postedData);
                
                if($result>0)
                {
                    $this->session->set_flashdata('success', 'Content Inserted successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Content insertion failed');
                }
            }else{
                //update data
                $result = $this->common_model->updateSystemData($postedData);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Content updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Content updation failed');
                }
            }
            redirect('backoffice/settings/about_us');
            
        }
    }
    
    /**
     * This function is used to update the System Logos
     */
    function updateLogo()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data = $this->common_model->get_system_info();
            $img_name = "nearchair_web_logo";
	 	    $folder   = "logo/web";
            if(empty($data)){
                //insert data
	 			if($_FILES['nearchair_web_logo']['name']!==""){
	 				$upload_image=$this->_upload_files($_FILES,$img_name,$folder);
	 				if (array_key_exists('error', $upload_image)) {
	 				    print_r($upload_image['error']);
	 				}else{
	 					$logoInfo[$img_name]=$upload_image['upload_data']['file_name'];
	 				}
	 			}
                $result = $this->common_model->insertSystemData($logoInfo);
                
                if($result>0)
                {
                    $this->session->set_flashdata('success', 'Logo Inserted successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Logo insertion failed');
                }
            }else{
                //update data
                if($_FILES['nearchair_web_logo']['name']!==""){
	 				$upload_image=$this->_upload_files($_FILES,$img_name,$folder);
	 				if (array_key_exists('error', $upload_image)) {
	 				    print_r($upload_image['error']);
	 				}else{
	 					$logoInfo['nearchair_web_logo']=$upload_image['upload_data']['file_name'];
	 				}
	 			}
                $result = $this->common_model->updateSystemData($logoInfo);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Logo updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Logo updation failed');
                }
            }
            redirect('backoffice/settings/logo');
            
        }
    }
    /**
     * This function is used to update the System App Logo
     */
    function updateAppLogo()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data = $this->common_model->get_system_info();
            $img_name = "nearchair_app_logo";
	 	    $folder   = "logo/app";
            if(empty($data)){
                //insert data
                    
	 			if($_FILES['nearchair_app_logo']['name']!==""){
	 			    
	 				$upload_image=$this->_upload_files($_FILES,$img_name,$folder);
	 				if (array_key_exists('error', $upload_image)) {
	 				    print_r($upload_image['error']);
	 				}else{
	 					$logoInfo['nearchair_app_logo']=$upload_image['upload_data']['file_name'];
	 				}
	 			}
                $result = $this->common_model->insertSystemData($logoInfo);
                
                if($result>0)
                {
                    $this->session->set_flashdata('success', 'Logo Inserted successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Logo insertion failed');
                }
            }else{
                //update data
                
                if($_FILES['nearchair_app_logo']['name']!==""){
	 				$upload_image=$this->_upload_files($_FILES,$img_name,$folder);
	 				if (array_key_exists('error', $upload_image)) {
	 				    print_r($upload_image['error']);
	 				}else{
	 					$logoInfo['nearchair_app_logo']=$upload_image['upload_data']['file_name'];
	 				}
	 			}
                $result = $this->common_model->updateSystemData($logoInfo);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Logo updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Logo updation failed');
                }
            }
            redirect('backoffice/settings/logo');
            
        }
    }
    
    /**
     * This function used to load the sliders
     */
    public function slider()
    {        
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            
            $data['slider_data'] = $this->common_model->get_sliders();
            $data['setting_active'] ="active";
            
            $this->global['pageTitle'] = 'NearChair : Customize Slider';
            
            $this->loadAdminViews("settings/sliders", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to add new slider to the system
     */
    function addNewSlider()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('slider_name','Slider Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('slider_link','Slider Url','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->slider();
            }
            else
            {
                $slider_name = ucwords(strtolower($this->security->xss_clean($this->input->post('slider_name'))));
                $slider_link = strtolower($this->security->xss_clean($this->input->post('slider_link')));
                
                $sliderInfo = array('slider_name'=> $slider_name,'slider_link'=>$slider_link, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                $img_name="slider_img";
                $folder="slider";
                if($_FILES['slider_img']['name']!==""){
	 				$upload_image=$this->_upload_files($_FILES,$img_name,$folder);
	 				if (array_key_exists('error', $upload_image)) {
	 				    print_r($upload_image['error']);
	 				}else{
	 					$sliderInfo[$img_name]=$upload_image['upload_data']['file_name'];
	 				}
	 			}
                $result = $this->common_model->addNewSlider($sliderInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Slider created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Slider creation failed');
                }
                
                redirect('backoffice/settings/slider');
            }
        }
    }
    
    function getSortedSliders(){
        $position = $this->input->post('position');
        $this->Merged_Vars['result'] = $this->common_model->getSortedSliders($position);
    }
    /**
     * This function is used to delete the slider using slider_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteSlider(){
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $slider_id = $this->input->post('slider_id');
            $sliderInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->common_model->deleteSlider($slider_id, $sliderInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
	* This Function is for upload images
	*
	* @param category Table Param 
	* @return Success Result Table Json
	* @author juman
	* @version 2019-08-16
	*/
	private  function _upload_files($files,$img_name,$folder)
	{	

	    $config['upload_path']          = "./drives/".$folder;
	    $config['allowed_types']        = 'gif|jpg|png|jpeg';
	    $config['max_size']             = 3000;
	    $config['max_width']            = 3440;
	    $config['max_height']           = 3268;
        
	    $this->load->library('upload', $config);
        $this->upload->initialize($config);
	    if ( ! $this->upload->do_upload($img_name))
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
    
}