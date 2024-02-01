<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Nearchairarea_model (Nearchairarea Model)
 * Nearchairarea model class to get to handle area related data 
 * @author : Emon
 * @version : 1.0
 * @since : 22 sept, 2019
 */
class Nearchair_area_model extends CI_Model
{

	/**
     * This function is used to get the area listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function areaListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('areas');
        if(!empty($searchText)) {
            $likeCriteria = "(areas.area_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('areas.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the area listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function areaListing($searchText = '', $page, $segment)
    {
        $this->db->select('areas.*,cities.city_name');
        $this->db->from('areas');
        $this->db->join('cities','cities.city_id = areas.city_id');
        if(!empty($searchText)) {
            $likeCriteria = "(areas.area_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('areas.isDeleted', 0);
        $this->db->order_by('areas.area_id', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
        
        
    }
    
    
    
    /**
     * This function is used to get the Areas
     * @return array $result : This is result
     */
    function getAreas()
    {
        $this->db->select('*');
        $this->db->from('areas');
        $this->db->where('areas.area_status', 1);
        
        $this->db->order_by('areas.area_id', 'ASC');
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
    function addNewArea($cat_info)
    {
        $this->db->trans_start();
        $this->db->insert('areas', $cat_info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


     /**
     * This function is used to get single city information
     * @param number $area_id : This is area_id 
     * @return boolean $result : TRUE / FALSE
     */
    function getAreaInfo($area_id)
    {
        $this->db->select('*');
        $this->db->from('areas');
        $this->db->where('isDeleted', 0);
        $this->db->where('area_id', $area_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    /**
     * author: juman
     * since :22-sept-2019
     * This function is used to get the area under city sing city id
     * @param number $city_id : This is city_id 
     * @return string $result 
     */
    function getAreaUnderCity($city_id){
        $this->db->select('*');
        $this->db->from('areas');
         $this->db->where('city_id', $city_id);
        $this->db->where('isDeleted', 0);
        $this->db->where('area_status', 1);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    /**
     * This function is used to update the area information
     * @param array $userInfo : This is areas updated information
     * @param number $city_id : This is area_id
     */
    function updateArea($catInfo, $area_id)
    {
        $this->db->where('area_id', $area_id);
        $this->db->update('areas', $catInfo);
        return TRUE;
    }
    
    
    /**
     * This function is used to move the area information
     * @param number $area_id : This is area_id 
     * @return boolean $result : TRUE / FALSE
     */

    function moveArea($area_id, $areaInfo)
    {
        $this->db->where('area_id', $area_id);
        $this->db->update('areas', $areaInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to delete the area information
     * @param number $area_id : This is area_id 
     * @return boolean $result : TRUE / FALSE
     */
    function deleteArea($area_id, $catInfo)
    {
        $this->db->where('area_id', $area_id);
        $this->db->update('areas', $catInfo);
        
        return $this->db->affected_rows();
    }
    
}