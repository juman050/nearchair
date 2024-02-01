<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

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

if(!function_exists('notifyToAdmin')){
    function notifyToAdmin($business_id,$order_id){
        $CI = get_instance();
        $businessName = $CI->common_model->getBusinessName($business_id);
        $title=$businessName;
        $body='OrderId: '.$order_id;
        //$url and $token is fixed for all projects
        $url = "https://fcm.googleapis.com/fcm/send";
        $token = "/topics/all";
        $click_aciton = "com.nearchair.admin_TARGET_NOTIFICATION";
    
        // change the server key with firebase FCM serverkey
        $serverKey = 'AAAA4nn5ScM:APA91bHYzvcNsGx245zCHH1ccfX0UCO-_aZ4gCXkSwTEoFLik68BE3zX9jAnKmzmQjla4RyqVW39yuNUxQD_ZlawO2KvoyGncOFs9BHdoWUNmRlK-FWROZN0iDabJtsK6nWY3ZH_oc3O';
       
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'click_action' => 'com.nearchair.admin_TARGET_NOTIFICATION','badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }
}

if(!function_exists('notifyToOwner')){
    function notifyToOwner($order_id){
        $CI = get_instance();
        $title='You have a new order';
        $body='OrderId: '.$order_id;
        //$url and $token is fixed for all projects
        $url = "https://fcm.googleapis.com/fcm/send";
        $token = "/topics/owner";
        $click_aciton = "com.nearchair.owner_TARGET_NOTIFICATION";
    
        // change the server key with firebase FCM serverkey
        $serverKey = 'AAAA4nn5ScM:APA91bHYzvcNsGx245zCHH1ccfX0UCO-_aZ4gCXkSwTEoFLik68BE3zX9jAnKmzmQjla4RyqVW39yuNUxQD_ZlawO2KvoyGncOFs9BHdoWUNmRlK-FWROZN0iDabJtsK6nWY3ZH_oc3O';
       
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'click_action' => 'com.nearchair.owner_TARGET_NOTIFICATION','badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }
}

/**
 * This function used to get Formatted time difference
 * @param {datetime} $post_date : This is the date
 */
if(!function_exists('time_ago'))
{
    function time_ago($post_date)
    {
        $CI = &get_instance();
        $CI->load->helper('date');
        $post_date = strtotime($post_date);
        $tz = 'Asia/Dhaka';
        $tz_obj = new DateTimeZone($tz);
        $today = new DateTime("now", $tz_obj);
        $now = strtotime($today->format('Y-m-d H:i:s'));
        //$now = time();
        $units = 1;
        return timespan($post_date, $now, $units);
    }
}

/**
 * This function used to get settings
 */
if( ! function_exists('system_info')){
    function system_info(){
        $CI = get_instance();
        return $CI->common_model->get_system_info();
    }
}

/**
 * This function used to get all category
 */
if( ! function_exists('getAllCategory')){
    function getAllCategory(){
        $CI = get_instance();
        return $CI->app_model->get_categories();
    }
}



/**
 * This function used to check current user has review
 * * @param {int} $business_id : This is the business id
 */
if( ! function_exists('checkCurrentUserReview')){
    function checkCurrentUserReview($business_id){
        $CI = get_instance();
        return $CI->app_model->checkCurrentUserReview($business_id);
    }
}


/**
 * This function used to check current user has review
 * * @param {int} $business_id : This is the business id
 */
if( ! function_exists('check_reviewed')){
    function check_reviewed($order_id,$business_id,$user_id){
        $CI = get_instance();
        return $CI->app_model->check_reviewed($order_id,$business_id,$user_id);
    }
}

/**
 * This function used to get service under ctageory
 * * @param {int} $category_id : This is the category id
 */
if( ! function_exists('getServiceUnderCategory')){
    function getServiceUnderCategory($category_id){
        $CI = get_instance();
        return $CI->app_model->get_category_services($category_id);
    }
}



/**
 * This function used to get all cities
 */
if( ! function_exists('getAllCity')){
    function getAllCity(){
        $CI = get_instance();
        return $CI->common_model->getCities();
    }
}

/*
* This function is used to get the area under city sing city id
* @param number $city_id : This is city_id 
* @return string $result 
*/
if( ! function_exists('getAreaUnderCity')){
    function getAreaUnderCity($city_id){
        $CI = get_instance();
        return $CI->common_model->getAreaUnderCity($city_id);
        
    }
}

/*
* This function is used to get the area name
* @param number $area_id : This is area_id 
* @return string $result 
*/
if( ! function_exists('getAreaName')){
    function getAreaName($area_id){
        $CI = get_instance();
        return $CI->common_model->getAreaName($area_id);
        
    }
}

if(! function_exists('getAllCategoryByType')){
    function getAllCategoryByType($category_type){
        $CI = get_instance();
        return $CI->common_model->getAllCategoryByType($category_type);
    }
}
/**
 * This function used to get service under ctageory
 * * @param {int} $category_id : This is the category id
 * * @param {int} $business_id : This is the business id
 */
if( ! function_exists('getBusinessServiceUnderCategory')){
    function getBusinessServiceUnderCategory($category_id,$business_id){
        $CI = get_instance();
        return $CI->app_model->getBusinessServiceUnderCategory($category_id,$business_id);
    }
}
/**
 * This function used to get service under ctageory
 * * @param {int} $category_id : This is the category id
 */
if( ! function_exists('getHomeServiceUnderCategory')){
    function getHomeServiceUnderCategory($category_id){
        $CI = get_instance();
        return $CI->app_model->getHomeServiceUnderCategory($category_id);
    }
}

/**
 * This function used to get service under ctageory
 * * @param {int} $category_id : This is the category id
 * * @param {int} $business_id : This is the business id
 */
if( ! function_exists('getTotalService')){
    function getTotalService($category_id,$business_id){
        $CI = get_instance();
        return $CI->app_model->getTotalService($category_id,$business_id);
    }
}

/**
 * This function used to get home service under ctageory
 * * @param {int} $category_id : This is the category id
 */
if( ! function_exists('getTotalHomeService')){
    function getTotalHomeService($category_id){
        $CI = get_instance();
        return $CI->app_model->getTotalHomeService($category_id);
    }
}

/*
 * This function used to get avg review
 * @since : 13 sept 2019
 * @param {int} $business_id : This is the business id
 */
if( ! function_exists('ratingAvg')){
    function ratingAvg($business_id){
        $CI = get_instance();
        return $CI->common_model->ratingAvg($business_id);
    }
}

/*
 * This function used to get total review
 * @since : 13 sept 2019
 * @param {int} $business_id : This is the business id
 */
if( ! function_exists('totalReview')){
    function totalReview($business_id){
        $CI = get_instance();
        return $CI->common_model->totalReview($business_id);
    }
}


/**
 * This function used to get service name 
 * @param {int} $service_id : This is the service id
 * @param {int} $business_id : This is the business id
 */
if( ! function_exists('getServiceName')){
    function getServiceName($service_id,$business_id){
        $CI = get_instance();
        return $CI->common_model->getServiceName($service_id,$business_id);
    }
}

/**
 * This function used to get home service name 
 * @param {int} $service_id : This is the service id
 */
if( ! function_exists('getHomeServiceName')){
    function getHomeServiceName($service_id){
        $CI = get_instance();
        return $CI->common_model->getHomeServiceName($service_id);
    }
}

/**
 * This function used to get business name 
 * @param {int} $business_id : This is the business id
 */
if( ! function_exists('getBusinessName')){
    function getBusinessName($business_id){
        $CI = get_instance();
        return $CI->common_model->getBusinessName($business_id);
    }
}

/**
 * This function used to get business details 
 * @param {int} $business_id : This is the business id
 */
if( ! function_exists('getBusinessData')){
    function getBusinessData($business_id){
        $CI = get_instance();
        return $CI->common_model->getBusinessData($business_id);
    }
}

/**
 * This function used to get service in cart 
 * @param {int} $service_id : This is the service id
 * @param {int} $business_id : This is the business id
 */
if( ! function_exists('checkServiceCart')){
    function checkServiceCart($service_id,$business_id){
        $CI = get_instance();
        $count = $CI->common_model->checkServiceCart($service_id,$business_id);
        $str='';
        if($count>0){
            $str='clicked';
        }else{
            $str='noclick';
        }
        return $str;
    }
}
/**
 * This function used to get service in cart 
 * @param {int} $service_id : This is the service id
 * @param {int} $business_id : This is the business id
 */
if( ! function_exists('checkHomeServiceCart')){
    function checkHomeServiceCart($service_id){
        $CI = get_instance();
        $count = $CI->common_model->checkHomeServiceCart($service_id);
        $str='';
        if($count>0){
            $str='clicked';
        }else{
            $str='noclick';
        }
        return $str;
    }
}

/**
 * This function used to check business in cart 
 * @param {int} $business_id : This is the business id
 */
if( ! function_exists('checkBusinessInCart')){
    function checkBusinessInCart($business_id){
        $CI = get_instance();
        return $CI->common_model->checkBusinessInCart($business_id);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance(); 
                    
        $CI->load->library('email');
        
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        $CI->email->initialize($config);
        
        return $CI;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if(!function_exists('resetPasswordEmail'))
{
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;

        $CI = get_instance();
        $CI->load->library('email');
        $CI->email->set_newline('\r\n');
        $CI->email->set_mailtype("html");   
        //$CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->from("nearchair.com", "nearchair");
        $CI->email->subject("Reset Password");
        $CI->email->message($CI->load->view('resetPassword/email', $data, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();
        
        return $status;
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

if (!function_exists('create_slug')) {
    function create_slug($string)
    {
        $slug = trim($string);
        $slug = strtolower($slug);
        $slug = str_replace(' ', '-', $slug);
    
        return $slug;
    } 
}

if ( ! function_exists('str_slug'))
{

    function str_slug( $string ) {
        
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
        return strtolower(trim($string, '-'));
       
    }
}




?>