<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Nearchaircity_model (Nearchaircity Model)
 * Nearchaircity model class to get to handle city related data 
 * @author : juman
 * @version : 1.0
 * @since : 16 Augest 2019
 */
class Nearchair_city_model extends CI_Model
{

	/**
     * This function is used to get the city listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function cityListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('cities');
        if(!empty($searchText)) {
            $likeCriteria = "(cities.city_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('cities.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the city listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function cityListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('cities');
        if(!empty($searchText)) {
            $likeCriteria = "(cities.city_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('cities.isDeleted', 0);
        $this->db->order_by('cities.city_id', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    
    
    /**
     * This function is used to get the cities
     * @return array $result : This is result
     */
    function getCities()
    {
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('cities.city_status', 1);
        
        $this->db->order_by('cities.city_id', 'ASC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
     /**
     * This function is used to add new city to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewCity($cat_info)
    {
        $this->db->trans_start();
        $this->db->insert('cities', $cat_info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


     /**
     * This function is used to get single city information
     * @param number $city_id : This is city_id 
     * @return boolean $result : TRUE / FALSE
     */
    function getCityInfo($city_id)
    {
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('isDeleted', 0);
        $this->db->where('city_id', $city_id);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function is used to update the city information
     * @param array $userInfo : This is cities updated information
     * @param number $city_id : This is city_id
     */
    function updateCity($catInfo, $city_id)
    {
        $this->db->where('city_id', $city_id);
        $this->db->update('cities', $catInfo);
        return TRUE;
    }
    
    
    /**
     * This function is used to move the city information
     * @param number $city_id : This is city_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveCity($city_id, $cityInfo)
    {
        $this->db->where('city_id', $city_id);
        $this->db->update('cities', $cityInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to delete the city information
     * @param number $city_id : This is city_id 
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCity($city_id, $catInfo)
    {
        $this->db->where('city_id', $city_id);
        $this->db->update('cities', $catInfo);
        
        return $this->db->affected_rows();
    }
    
}