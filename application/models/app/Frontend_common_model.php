<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : frontend_common_model
 * Common Model for frontend
 * @author : Emon
 * @version : 1.0
 * @since : 26 Augest 2019
 */
class frontend_common_model extends CI_Model
{

    /**
     * This common function is for getting data.
     * @param string $table : This is table name
     * @return array $where : This is where condition. Also optional
     * @author : Emon
     * @version : 1.0
     * @since : 26 Augest 2019
     */ 

    function get_where($table,$where=array())
    {
        $this->db->select('*');
        $this->db->from($table);
        if($where){
            $this->db->where($where);
        }
        return $this->db->get()->result();
    }


    /**
     * This function is used to get single field
     * @param $table : table name
     * @param $where : condition for getting data
     * @param $fieldname : set specific field name
     * @author : Emon
     * @version : 1.0
     * @since : 26 Augest 2019

     */
    function get_single_field($table,$where=array(),$fieldname=""){
        $this->db->select($fieldname);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        
        return $query->row()->$fieldname;
    }

    /**
     * This function is use for insert data
     * @param $table : table name
     * @param $data : inserted data NB. check table field name of $data index
     * @return : Last Insert Id
     * @author : Emon
     * @version : 1.0
     * @since : 26 Augest 2019

     */
    function insertData($table,$data=array())
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
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
        if($this->db->update($table, $data))
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * This function is used to delete
     * @param $table : table name
     * @param $where : condition for getting data
     * @author : Emon
     * @version : 1.0
     * @since : 26 Augest 2019

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
     * @since : 03-09-2019

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