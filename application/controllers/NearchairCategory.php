<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairCategory (Category Controller)
 * NearchairCategory Class to control all user related operations.
 * @author : juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class NearchairCategory extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nearchair_category_model');
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
            
            $count = $this->nearchair_category_model->categoryListingCount($searchText);

            $returns = $this->paginationCompress ( "categoryListing/", $count, 10 );
            
            $data['categoryRecords'] = $this->nearchair_category_model->categoryListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'NearChair : Category';
            
            $this->loadAdminViews("category/index", $this->global, $data, NULL);
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
            
            $this->global['pageTitle'] = 'NearChair : Add New Category';

            $this->loadAdminViews("category/addNew", $this->global, NULL, NULL);
        }
    }
    /**
     * This function is used to add new category to the system
     */
    function addNewCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('category_name','Category Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('category_description','Category Description','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $category_name = ucwords(strtolower($this->security->xss_clean($this->input->post('category_name'))));
                $category_slug = ucwords(strtolower($this->security->xss_clean($this->input->post('category_slug'))));
                $category_description = strtolower($this->security->xss_clean($this->input->post('category_description')));
                $category_type = $this->input->post('category_type');
                
                $catInfo = array('category_name'=> $category_name,'category_slug'=>$category_slug,'category_description'=>$category_description,'category_type'=>$category_type, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                $catInfo['category_img']=""; 
	 			if($_FILES['category_img']['name']!==""){
	 				$upload_image=$this->_upload_files($_FILES);
	 				if (array_key_exists('error', $upload_image)) {
	 				    print_r($upload_image['error']);
	 				}else{
	 					$catInfo['category_img']=$upload_image['upload_data']['file_name'];
	 				}
	 			}
                $this->load->model('nearchair_category_model');
                $result = $this->nearchair_category_model->addNewCategory($catInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Category created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Category creation failed');
                }
                
                redirect('backoffice/category/addNew');
            }
        }
    }

    /**
     * This function is used load category edit information
     * @param number $category : Optional : This is category id
     */
    function editCategory($category_id = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($category_id == null)
            {
                redirect('categoryListing');
            }
            
            $data['catInfo'] = $this->nearchair_category_model->getCategoryInfo($category_id);
            
            $this->global['pageTitle'] = 'NearChair : Edit Category';
            
            $this->loadAdminViews("category/editOld", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the category information
     */
    function updateCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $category_id = $this->input->post('category_id');
            
            $this->form_validation->set_rules('category_name','Category Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('category_description','Category Description','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($category_id);
            }
            else
            {
                $category_name = ucwords(strtolower($this->security->xss_clean($this->input->post('category_name'))));
                $category_description = strtolower($this->security->xss_clean($this->input->post('category_description')));
                $category_type = $this->input->post('category_type');
                $catInfo = array();
                
                $catInfo = array('category_name'=> $category_name,'category_description'=>$category_description,'category_type'=>$category_type, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                if($_FILES['category_img']['name']!==""){
	 				$upload_image=$this->_upload_files($_FILES);
	 				if (array_key_exists('error', $upload_image)) {
	 				    print_r($upload_image['error']);
	 				}else{
	 					$catInfo['category_img']=$upload_image['upload_data']['file_name'];
	 				}
	 			}
                $result = $this->nearchair_category_model->updateCategory($catInfo, $category_id);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Category updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Category updation failed');
                }
                
                redirect('categoryListing');
            }
        }
    }


    /**
     * This function is used to delete the category using category_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $category_id = $this->input->post('category_id');
            $catInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_category_model->deleteCategory($category_id, $catInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to move the category using category_id and category_status
     * @return boolean $result : TRUE / FALSE
     */
    function moveCategory()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $category_id = $this->input->post('category_id');
            $category_status = $this->input->post('category_status');
            $categoryInfo = array('status'=>$category_status,'updatedBy'=>$this->vendorId,'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->nearchair_category_model->moveCategory($category_id, $categoryInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to check whether slug already exist or not
     */
    function checkCategorySlugExists()
    {
        $category_id = $this->input->post("category_id");
        $slug = $this->input->post("category_slug");

        if(empty($category_id)){
            $result = $this->nearchair_category_model->checkCategorySlugExists($slug);
        } else {
            $result = $this->nearchair_category_model->checkCategorySlugExists($slug, $category_id);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    
    /**
	* This Function is for upload images
	*
	* @param category Table Param 
	* @return Success Result Table Json
	* @author juman
	* @version 2019-08-16
	*/
	private  function _upload_files($files)
	{	
	    $config['upload_path']          = './drives/category/';
	    $config['allowed_types']        = 'gif|jpg|png|jpeg';
	    $config['max_size']             = 3000;
	    $config['max_width']            = 2440;
	    $config['max_height']           = 2200;

	    $this->load->library('upload', $config);
        $this->upload->initialize($config);
	    if ( ! $this->upload->do_upload('category_img'))
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