<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Nearchairoffer_model (Nearchairoffer Model)
 * Nearchairoffer model class to get to handle offer related data 
 * @author : juman
 * @version : 1.0
 * @since : 12 oct 2019
 */
class Nearchair_offer_model extends CI_Model
{
    
    /**
     * This function is used to add new offer 
     * @param array $offerData : This is offer all data
     * @return number $insert_id : This is last insert id
     */
    function addNewOffer($offerData){
        $this->db->trans_start();
        $this->db->insert('business_offers', $offerData);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
     /**
     * This function is used to get single offer data
     * @param number $offer_id : This is offer id
     * @return array $row : this is an array
     */
    function getOfferInfo($offer_id){
        $this->db->select('*');
        $this->db->from('business_offers');
        $this->db->where('isDeleted', 0);
        $this->db->where('offer_id', $offer_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    /**
     * This function is used to update the offer information
     * @param array $offerData : This is offer updated information
     * @param number $offer_id : This is offer_id
     */
    function updateOffer($offerData, $offer_id){
        $this->db->where('offer_id', $offer_id);
        $this->db->update('business_offers', $offerData);
        return TRUE;
    }
    
    function checkBusinessOffer($business_id){
        $this->db->select('*');
        $this->db->from('business_offers');
        $this->db->where('isDeleted', 0);
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
}