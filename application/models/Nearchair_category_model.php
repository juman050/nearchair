<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : NearchairCategory_model (NearchairCategory Model)
 * NearchairCategory model class to get to handle Category related data 
 * @author : juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class Nearchair_category_model extends CI_Model
{

	/**
     * This function is used to get the category listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function categoryListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('categories');
        if(!empty($searchText)) {
            $likeCriteria = "(categories.category_name  LIKE '%".$searchText."%'
                            OR  categories.category_description  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('categories.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the category listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function categoryListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('categories');
        if(!empty($searchText)) {
            $likeCriteria = "(categories.category_name  LIKE '%".$searchText."%'
                            OR  categories.category_description  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('categories.isDeleted', 0);
        $this->db->order_by('categories.category_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }


    /**
     * This function is used to add new category to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewCategory($cat_info)
    {
        $this->db->trans_start();
        $this->db->insert('categories', $cat_info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


     /**
     * This function is used to get single category information
     * @param number $category_id : This is category_id 
     * @return boolean $result : TRUE / FALSE
     */
    function getCategoryInfo($category_id)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('isDeleted', 0);
        $this->db->where('category_id', $category_id);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function is used to update the Category information
     * @param array $userInfo : This is Categories updated information
     * @param number $category_id : This is category_id
     */
    function updateCategory($catInfo, $category_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->update('categories', $catInfo);
        return TRUE;
    }
    
    /**
     * This function is used to move the category information
     * @param number $category_id : This is category_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveCategory($category_id, $categoryInfo)
    {
        $this->db->where('category_id', $category_id);
        $this->db->update('categories', $categoryInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to delete the category information
     * @param number $category_id : This is category_id 
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCategory($category_id, $catInfo)
    {
        $this->db->where('category_id', $category_id);
        $this->db->update('categories', $catInfo);
        
        return $this->db->affected_rows();
    }
    
    /**
     * This function is used to check whether slug url is already exist or not
     * @param {string} $slug : This is slug url
     * @param {number} $category_id : This is category id
     * @return {mixed} $result : This is searched result
     */
    function checkCategorySlugExists($slug, $category_id = 0){
        $this->db->select("category_slug");
        $this->db->from("categories");
        $this->db->where("category_slug", $slug);   
        $this->db->where("isDeleted", 0);
        if($category_id != 0){
            $this->db->where("category_id !=", $category_id);
        }
        $query = $this->db->get();

        return $query->result();
    }
    

}