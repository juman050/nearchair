<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function is used to get business offer by business_id
 * @param number $business_id : This is business_id
 * @return array $result 
 */
if( ! function_exists('getBusinessOffer')){
    function getBusinessOffer($business_id){
        $CI = get_instance();
        return $CI->common_model->checkBusinessOffer($business_id);
    }
}

if(! function_exists('isAnyOffer')){
    function isAnyOffer($business_id){
        $CI = get_instance();
        return $CI->common_model->isAnyOffer($business_id);
    }
}