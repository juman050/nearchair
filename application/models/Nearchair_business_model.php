<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : NearchairBusiness_model (Nearchairbusiness Model)
 * Nearchairbusiness model class to get to handle business related data 
 * @author : juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class Nearchair_business_model extends CI_Model
{

	/**
     * This function is used to get the business listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function businessListingCount($searchText = '',$attr)
    {
        $this->db->select('*');
        $this->db->from('businesses');
        if(!empty($searchText)) {
            $likeCriteria = "(businesses.business_name  LIKE '%".$searchText."%'
                            OR  businesses.business_description  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($attr)){
            $this->db->where($attr);
        }
        $this->db->where('businesses.isDeleted', 0);
        
        
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the business listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function businessListing($searchText = '', $page, $segment,$attr)
    {
        $this->db->select('*');
        $this->db->from('businesses');
        if(!empty($searchText)) {
            $likeCriteria = "(businesses.business_name  LIKE '%".$searchText."%'
                            OR  businesses.business_description  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('businesses.isDeleted', 0);
        if(!empty($attr)){
            $this->db->where($attr);
        }
        $this->db->order_by('businesses.business_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    
    /**
     * This function is used to add new business to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBusiness($business_info)
    {
        $this->db->trans_start();
        $this->db->insert('businesses', $business_info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    
    /**
     * This function is used to get single business information
     * @param number $business_id : This is business_id 
     * @return boolean $result : TRUE / FALSE
     */
    function getBusinessInfo($business_id)
    {
        $this->db->select('*');
        $this->db->from('businesses');
        $this->db->where('isDeleted', 0);
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    /**
     * This function is used to update the business information
     * @param array $userInfo : This is businesses updated information
     * @param number $adminId : This is business id
     */
    function updateBusiness($businessInfo, $business_id)
    {
        $this->db->where('business_id', $business_id);
        $this->db->update('businesses', $businessInfo);
        
        return TRUE;
    }
    /**
     * This function is used to get the business email information
     * @param number $adminId : This is business id
     */
    function getOrginalEmail($business_id){
        $this->db->select('businesses.email');
        $this->db->from('businesses');
        $this->db->where('isDeleted', 0);
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        
        return $query->row()->email;
    }
    

    /**
     * This function is used to delete the business information
     * @param number $business_id : This is business_id 
     * @return boolean $result : TRUE / FALSE
     */
    function deleteBusiness($business_id, $businessInfo)
    {
        $this->db->where('business_id', $business_id);
        $this->db->update('businesses', $businessInfo);
        
        return $this->db->affected_rows();
    }
    
    
    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $business_id : This is business id
     * @return {mixed} $result : This is searched result
     */
    function checkBusinessEmailExists($email, $business_id = 0)
    {
        $this->db->select("email");
        $this->db->from("businesses");
        $this->db->where("email", $email);   
        $this->db->where("isDeleted", 0);
        if($business_id != 0){
            $this->db->where("business_id !=", $business_id);
        }
        $query = $this->db->get();

        return $query->result();
    }
    /**
     * This function is used to check whether slug url is already exist or not
     * @param {string} $slug : This is slug url
     * @param {number} $business_id : This is business id
     * @return {mixed} $result : This is searched result
     */
    function checkBusinessSlugExists($slug, $business_id = 0){
        $this->db->select("business_slug");
        $this->db->from("businesses");
        $this->db->where("business_slug", $slug);   
        $this->db->where("isDeleted", 0);
        if($business_id != 0){
            $this->db->where("business_id !=", $business_id);
        }
        $query = $this->db->get();

        return $query->result();
    }


     /**
     * This function is used to move the business information
     * @param number $business_id : This is business_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveBusiness($business_id, $businessInfo)
    {
        $this->db->where('business_id', $business_id);
        $this->db->update('businesses', $businessInfo);
        
        return $this->db->affected_rows();
    }


     /**
     * This function is used to get single category information
     * @return boolean $result : All Categories / FALSE
     */
    function getCategories()
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 1);
        $this->db->order_By('category_id', 'DESC');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function getBusinessType($business_id){
        $this->db->select('businesses.business_type');
        $this->db->from('businesses');
        $this->db->where('isDeleted', 0);
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        
        return $query->row()->business_type;
    }
    
     /**
     * This function is used to get single category information
     * @return boolean $result : All Categories / FALSE
     */
    function getCategoriesByType($attr)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where($attr);
        $this->db->or_where('category_type','3');
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 1);
        $this->db->order_By('category_id', 'DESC');
        $query = $this->db->get();
        
        return $query->result();
    }
    
     /**
     * This function is used to get single category information
     * @return boolean $result : All Categories / FALSE
     */
    function get_businessName($business_id)
    {
        $this->db->select('*');
        $this->db->from('businesses');
        $this->db->where('business_id',$business_id);
        $query = $this->db->get();
        
        return $query->row()->business_name;
    }
    
    
     /**
     * This function is used to get single category information
     * @return boolean $result : All Categories / FALSE
     */
    function get_singleService($service_id,$business_id)
    {
        $this->db->select('*');
        $this->db->from('business_services');
        $this->db->where('business_id',$business_id);
        $this->db->where('service_id',$service_id);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is for getting business category and services
     * @return boolean True/False
     */
    function get_seviceList($business_id)
    {
        $this->db->select('business_services.*,categories.category_name');
        $this->db->from('business_services as business_services');
        $this->db->join('categories','categories.category_id = business_services.cat_id');

        $this->db->where('business_services.business_id',$business_id);
        $this->db->where('business_services.isDeleted',0);
        $this->db->where('categories.isDeleted',0);
        $this->db->where('categories.status',1);
        $this->db->order_by('business_services.cat_id','ASC');

        $query = $this->db->get();
        return $query->result();

    }
    
    
    
    /**
     * This function is used to add new business to system
     * @return number $insert_id : This is last inserted id
     */
    function insertData($table,$service_info)
    {
        $this->db->trans_start();
        $this->db->insert($table, $service_info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    

    /**
     * This function is used to update
     * @param $table : table name
     * @param $where : condition for update data
     * @param $data : updated data NB. check table field name of $data index
     * @author : Emon
     * @version : 1.0
     * @since : 26 Augest 2019

     */
    function where_update($table,$where=array(), $data=array())
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is for getting business info for single owner
     * @return boolean True/False
     */
    function get_business_info($business_id)
    {

        $this->db->select('businesses.*');
        $this->db->from('businesses');
        $query2 = $this->db->get();
        $business_details = $query2->result();
        $gallery_images = array();
        foreach ($business_details as $business) {

            $this->db->select('*');
            $this->db->from('business_gallery');
            $this->db->where('business_id',$business_id);
            $query3 = $this->db->get();
            $business->gallery_image = $query3->result();
        }
        return $business_details;

    }

    
    
    
    /**
     * This function is for adding multiple gallery image
     * @param string $business_id : Business Id
     * @param string $gallery_image : Gallery Images
     * @return boolean True/False
     * @author : Emon
     * @version : 1.0
     * @since : 30 Oct 2019
     */
    function add_gallery_image($business_id, $gallery_image)
    {
        if($gallery_image!='' )
        {
            $gallery_image1 = explode(',',$gallery_image);

            foreach($gallery_image1 as $file){

                $file_data = array(

                    'business_id' => $business_id,
                    'image' => $file,
                );

                $this->db->insert('business_gallery',$file_data);
            }

            return true;

        }else{
            return false;
        }

    }
    
    

    /**
     * This function is used to get single field
     * @param $table : table name
     * @param $where : condition for getting data
     * @param $fieldname : set specific field name
     * @author : Emon
     * @version : 1.0
     * @since : 30 Oct 2019

     */
    function get_single_field($table,$where=array(),$fieldname=""){
        $this->db->select($fieldname);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        
        return $query->row()->$fieldname;
    }
    
    /**
     * This function is used to delete
     * @param $table : table name
     * @param $where : condition for getting data
     * @author : Emon
     * @version : 1.0
     * @since : 30 Oct 2019

     */
    function where_delete($table,$where=array())
    {
        $this->db->where($where);
        $this->db->delete($table);
        return TRUE;
    }
    

    /**
     * This function is for getting autosearch data
     * @param $table : table name
     * @param $fieldName : field name
     * @param $q : nput data
     * @author : Emon
     * @version : 1.0
     * @since : 04-11-2019

     */
    function get_autosearch_data($table,$fieldName,$q){
        $this->db->select('*');
        $this->db->like($fieldName, $q);
        $this->db->group_by($fieldName, $q);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $row_set[] = htmlentities(stripslashes($row[$fieldName])); //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }
    
}