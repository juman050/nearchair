<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairHome
 * This is the Home controller for frontend of this preoject.
 * @author : Emon
 * @version : 1.0
 * @since : 26 Augest 2019
 */
class NearchairHome extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public $Public_Vars = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->model('app/frontend_common_model');
        $this->load->model('app/app_model');
        $this->load->model('common_model');
        $this->global['system_data'] = $this->common_model->get_system_info();
    }
    
    /**
     * This function is load all data for home page
     */
    public function index()
    {
        $data=array();
        $this->global['pageTitle'] = 'home';
        $this->global['pageName'] = 'Home';
        $con = array('category_type'=>'1','isDeleted'=>0,'status'=>1);
        $con2 = array('category_type'=>'2','isDeleted'=>0,'status'=>1);
        $con3 = array('category_type'=>'3','isDeleted'=>0,'status'=>1);
        $data['categories'] = $this->app_model->get_categories1($con);
        $data['categories2'] = $this->app_model->get_categories2($con2);
        $data['categories3'] = $this->app_model->get_categories3($con3);
        $data['sliders'] = $this->app_model->get_sliders();
        $this->loadFrontendViews("home/index", $this->global, $data, NULL);

    }
    
    /**
     * This function is load all data for about page
     */
    public function about()
    {
        $this->global['pageTitle'] = 'about us';
        $this->global['pageName'] = 'about';
        $this->loadFrontendViews("home/about", $this->global, NULL, NULL);

    }
    /**
     * This function is load all data for contact page
     */
    public function contact()
    {
        $this->global['pageTitle'] = 'contact us';
        $this->global['pageName'] = 'contact';
        $this->loadFrontendViews("home/contact", $this->global, NULL, NULL);

    }
    
    /**
     * This function is load all data for instructions page
     */
    public function instructions()
    {
        $this->global['pageTitle'] = 'instructions';
        $this->global['pageName'] = 'instructions';
        $this->loadFrontendViews("home/instructions", $this->global, NULL, NULL);

    }
    
    /**
     * This function is used to get single category data with services
     * @param $slug : here segment is the category id
     * @author : juman
     * @version : 1.0
     * @since : 05 sept 2019
     */
    public function singlecategory($category_id=NULL)
    {
        $data=array();
        $category = $this->app_model->get_single_category($category_id);
        if($category_id == null)
        {
            redirect('app/home');
        }
        $data['category_services'] = $this->app_model->get_category_services($category_id);
        $this->global['pageTitle'] = $category->category_name;
        $this->global['pageName']  = 'Category';
        
        $data['category_data'] = $category;
        $this->loadFrontendViews("home/single_categories", $this->global, $data, NULL);

    }
    
    /**
     * This function is used to get businesses according to service slug
     * @param $id : here slug is the service slug
     * @author : juman
     * @version : 1.0
     * @since : 05 sept 2019
    */
    public function goto_business($service_id=NULL)
    {
        $data=array();
        $service = $this->app_model->get_serviceInfo($service_id);
        if($service_id == null)
        {
            redirect('app/home');
        }
        $this->global['pageTitle'] = $service->service_name;
        $this->global['pageName'] = 'business';
        
        $data['business_list'] = $this->app_model->get_businesses_by_service($service->service_name);
        $this->loadFrontendViews("home/businesses", $this->global, $data, NULL);

    }
    /**
     * This function is used to get single business with services
     * @param $id : here slug is the business slug
     * @author : juman
     * @version : 1.0
     * @since : 05 sept 2019
    */
    function business($slug){
        $data=array();
        $data['business'] = $this->app_model->get_business_by_slug($slug);
        $this->global['pageTitle'] = $data['business']->business_name;
        $this->global['pageName'] = 'single_business';
        
        $business_id = $this->app_model->get_business_id($slug);
        if($business_id>0){
            $data['business_gallery'] = $this->app_model->get_business_gallery($business_id);
            $rowperpage = 3;
            $limit = 0;
            $data['reviews_count'] = $this->app_model->get_business_reviews_count($business_id);
            $data['business_reviews'] = $this->app_model->get_business_reviews($business_id,$rowperpage,$limit);
        }
        $data['categories'] = $this->app_model->get_categories();
        $this->loadFrontendViews("home/business_details", $this->global, $data, NULL);
    }
    /**
     * This function is used to add new review to the business
     * @author : juman
     * @version : 1.0
     * @since : 13 sept 2019
    */
    function addreview(){
        $userId = get_cookie('user_id');
        $allreviews = $this->input->post('allreviews');
        $data['business_id'] = $this->input->post('business_id');
        $data['user_id']=$userId;
        $data['rating'] = $this->input->post('rating');
        $data['review_text'] = $this->input->post('review_text');
        date_default_timezone_set("Asia/Dhaka");
	    $data['createdDtm'] = date('Y-m-d H:i:s');
        $review_id = $this->app_model->addnew_business_reviews($data);
        if($review_id>0){
            $data['allreviews'] = (int)$allreviews;
            $data['user']= $this->app_model->get_user($userId);
            $this->load->view("app/home/addnew_review",$data);
        }
        
        
    }
    /**
     * This function is used to load more reviews for a business
     * @author : juman
     * @version : 1.0
     * @since : 11 sept 2019
    */
    function loadMoreReviews(){
        $limit = $this->input->post('row');
        $business_id = $this->input->post('business_id');
        $rowperpage = 3;
        $data['more_reviews'] = $this->app_model->get_business_reviews($business_id,$rowperpage,$limit);
        $this->load->view("app/home/loadmore_reviews",$data);
    }
    /**
     * This function is used to check business is in cart or not
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
    */
    function checkBusinessInCart(){
        $count = count($this->cart->contents());
        $businessInCart = $this->common_model->checkBusinessInCart($this->input->post('business_id'));
        if(!empty($count) && empty($businessInCart)){
            echo "true";
        }else{
            echo "false";
        }
    }
     /**
     * This function is used to add single cart data
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
    */
    function addcartData(){
        $data=array();
        $count = count($this->cart->contents());
        $data['pageName']="cart_summary";
        $cartdata=array();
        $cart_total = $this->cart->total();
        if($this->session->userdata('minimum_total') && $cart_total < $this->session->userdata('minimum_total')){
            $this->session->unset_userdata('coupon_id');
            $this->session->unset_userdata('coupon_amount');
            $this->session->unset_userdata('coupon_code');
            $this->session->unset_userdata('minimum_total');
        }
        $businessInCart = $this->common_model->checkBusinessInCart($this->input->post('business_id'));
        
        $cartdata = array(
            'id'         => $this->input->post('service_id'), 
            'qty'        => $this->input->post('qty'),
            'name'        => "service_name",
            'cat_id'     => $this->input->post('category_id'),
            'price'      => $this->input->post('service_price'),
            'service_time'      => $this->input->post('service_time'),
            'business_id'=> $this->input->post('business_id'), 
        );
        if(!empty($count) && empty($businessInCart)){
            $this->cart->destroy(); 
            $this->cart->insert($cartdata);
        }
        else{
            $this->cart->insert($cartdata);
        }
        $this->session->set_userdata('sess_business_id',$this->input->post('business_id'));
        $this->load->view("app/home/cart_summary",$data);
    }
    /**
     * This function is used to add single cart data for home service
     * @author : juman
     * @version : 1.0
     * @since : 04 oct 2019
    */
     function homeserviceAddCartData(){
        
        $data=array();
        $data['pageName']="cart_summary";
        $rowId=uniqid();
        $cartArray = array();
        
        $cartArray = array(
        	$rowId=>array(
        	'rowId'  => $rowId, 
        	'serviceId'  => $this->input->post('service_id'), 
            'qty'        => $this->input->post('qty'),
            'catId'      => $this->input->post('category_id'),
            'servicePrice'=> $this->input->post('service_price'),
            'serviceTime'=> $this->input->post('service_time')
        ));
        
        if(empty($_SESSION["shopping_cart"])) {
            $_SESSION["shopping_cart"] = $cartArray;
        }else{
            $_SESSION["shopping_cart"] = array_merge(
                 $_SESSION["shopping_cart"],$cartArray
            );
        //     $array_keys = array_keys($_SESSION["shopping_cart"]);
        //     if(in_array($rowId,$array_keys)) {	
        //     } else {
        //         $_SESSION["shopping_cart"] = array_merge(
        //           $_SESSION["shopping_cart"],$cartArray
        //         );
        // 	}
        }
        
        $this->load->view("app/homeservice/cart_summary",$data);
     }
     /**
     * This function is used to remove current service from cart
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
    */
    function removeCurrentData(){
        $data=array();
        $data['pageName']="cart_summary";
        
        $bag = $this->cart->contents();
        foreach ($bag as $item) {
            $item_id[0] = $item['id'];
            $business_id[0] = $item['business_id'];
            if ($item_id[0] == $this->input->post('service_id') && $business_id[0]== $this->input->post('business_id')) {
                $data = array( 'rowid' => $item['rowid'], 'qty'   => ($item['qty'] - 1 ));
                $this->cart->update($data);
            }
        }
        $cart_total = $this->cart->total();
        if($this->session->userdata('minimum_total') && $cart_total < $this->session->userdata('minimum_total')){
            $this->session->unset_userdata('coupon_id');
            $this->session->unset_userdata('coupon_amount');
            $this->session->unset_userdata('coupon_code');
            $this->session->unset_userdata('minimum_total');
        }
        $this->load->view("app/home/cart_summary",$data);
    }
    
    /**
     * This function is used to remove current home service from cart
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
    */
    function homeserviceRemoveCurrentData(){
        $data=array();
        $data['pageName']="cart_summary";
        
        if(!empty($_SESSION["shopping_cart"])) {
            foreach($_SESSION["shopping_cart"] as $key => $value) {
              if($this->input->post('service_id') == $value['serviceId']){
                 unset($_SESSION["shopping_cart"][$key]);
              }
              if(empty($_SESSION["shopping_cart"])){
                 unset($_SESSION["shopping_cart"]);
              }
            } 
        }
        
        $this->load->view("app/homeservice/cart_summary",$data);
    }
    
    /**
     * This function is used to remove current home service from cart
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
    */
    function removeHomeServiceFromCart(){
        $data=array();
        $data['pageName']="homeservice_cart_body";
        if(!empty($_SESSION["shopping_cart"])) {
            foreach($_SESSION["shopping_cart"] as $key => $value) {
              if($this->input->post("rowId") == $key){
                unset($_SESSION["shopping_cart"][$key]);
              }
              if(empty($_SESSION["shopping_cart"])){
                unset($_SESSION["shopping_cart"]);
              }
            } 
        }else{
            unset($_SESSION["shopping_cart"]);
        }
        
        $this->load->view("app/homeservice/cart_body",$data);
    }
    
    
     /**
     * This function is used to add data from cart 
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
    */
    function addToCart(){
        $data=array();
        $data['pageName']="cart_body";
        $cart_total = $this->cart->total();
        if($this->session->userdata('minimum_total') && $cart_total < $this->session->userdata('minimum_total')){
            $this->session->unset_userdata('coupon_id');
            $this->session->unset_userdata('coupon_amount');
            $this->session->unset_userdata('coupon_code');
            $this->session->unset_userdata('minimum_total');
        }
        $cartdata=array();
        $cartdata = array(
            'id'         => $this->input->post('service_id'), 
            'qty'        => $this->input->post('qty'),
            'name'        => "service_name",
            'cat_id'     => $this->input->post('category_id'),
            'price'      => $this->input->post('service_price'),
            'service_time'      => $this->input->post('service_time'),
            'business_id'=> $this->input->post('business_id'), 
        );
        
        $this->cart->insert($cartdata);
        $this->load->view("app/home/cart_body",$data);
    }
    
    /**
     * This function is used to remove dat from cart
     * @author : juman
     * @version : 1.0
     * @since : 06 sept 2019
    */
    function removeFromCart(){
        
        $data=array();
        $data['pageName']="cart_body";
        $data = array( 'rowid' => $this->input->post('rowid'), 'qty'=> ($this->input->post('qty') - 1));
        $this->cart->update($data);
        $data['business_id'] = $this->input->post('business_id');
        $cart_total = $this->cart->total();
        if($this->session->userdata('minimum_total') && $cart_total < $this->session->userdata('minimum_total')){
            $this->session->unset_userdata('coupon_id');
            $this->session->unset_userdata('coupon_amount');
            $this->session->unset_userdata('coupon_code');
            $this->session->unset_userdata('minimum_total');
        }
        $this->load->view("app/home/cart_body",$data);
    }
    
    /**
     * This function is used to cart page
     * @author : juman
     * @version : 1.0
     * @since : 05 sept 2019
    */
    function checkout(){
        
        $count = count($this->cart->contents());
        if($count>0){
            $cart_total = $this->cart->total();
            if($this->session->userdata('minimum_total') && $cart_total < $this->session->userdata('minimum_total')){
                $this->session->unset_userdata('coupon_id');
                $this->session->unset_userdata('coupon_amount');
                $this->session->unset_userdata('coupon_code');
                $this->session->unset_userdata('minimum_total');
            }
            $data=array();
            $this->global['pageTitle'] = 'Checkout';
            $this->global['pageName'] = 'checkout';
            $this->loadFrontendViews("home/checkout", $this->global, $data, NULL);
        }else{
            redirect('app/home', 'refresh');
        }
    }
    
    /**
     * This function is used to book order now
     * @author : Juman
     * @version : 1.0
     * @since : 07 Sept 2019
     */ 
    function bookOrderNow(){
        $order_type = $this->input->post('order_type');
        $order_total = $this->input->post('order_total');
        $payment_method = $this->input->post('payment_method');
        $business_id = $this->input->post('business_id');
        $count = count($this->cart->contents());
        if($this->app_model->checkBusinessAvailable($business_id)>0){
            if($count>0){
                if(get_cookie('isUserLoggedIn') == TRUE){
                    if($payment_method=='bkash' || $payment_method=='rocket'){
                        $transaction_id =$this->input->post('transaction_id');
                    }else{
                        $transaction_id =NULL;
                    }
                    $userId = get_cookie('user_id');
                    $booked_id = $this->app_model->bookOrderNow($order_type,$order_total,$payment_method,$business_id,$userId,$transaction_id);
                    if($booked_id>0){
                        $this->cart->destroy();
                        $data['order_status'] = $booked_id;
                        
                    }else{
                        $data['order_status'] = '0';
                    }
                    $data['user_login'] = 'true';
                }else{
                    $data['user_login'] = 'false';
                }
                $data['available'] = 'on';
            }else{
                $data['order_status'] = '0';
            }
        }else{
            $data['available'] = 'off';
        }
        header('Content-type: application/json');
		echo json_encode( $data );
    }
     /**
     * This function is used to book home service order
     * @author : Juman
     * @version : 1.0
     * @since : 06 oct 2019
     */ 
    function homeserviceOrder(){
        $subtotal=0;
        if(!empty($_SESSION["shopping_cart"])) {
            foreach($_SESSION["shopping_cart"] as $cart){
                $subtotal = $subtotal + ($cart['qty'] * $cart['servicePrice']);
            }
            
        }
        $sdata=array();
        $sdata['order_type'] = $this->input->post('order_type');
        if($sdata['order_type']==1){
            $sdata['advance_order_date'] = $this->input->post('datetime');
        }
        $sdata['order_subtotal']=str_replace(',', '',$subtotal);
        $sdata['order_total'] = str_replace(',', '', $this->input->post('order_total'));
        $payment_method = $this->input->post('payment_method');
        $sdata['payment_method'] = $this->input->post('payment_method');
        $sdata['customer_name'] = $this->input->post('customer_name');
        $sdata['customer_contact'] = $this->input->post('customer_contact');
        $sdata['customer_area'] = $this->input->post('customer_area');
        $sdata['customer_address'] = $this->input->post('customer_address');
        date_default_timezone_set("Asia/Dhaka");
        $sdata['order_date'] = date('Y-m-d H:i:s');
	    $sdata['createdDtm'] = date('Y-m-d H:i:s');
	    
	     
        if($this->global['system_data']->home_service>0){
            if(!empty($_SESSION["shopping_cart"])) {
                if($payment_method=='bkash' || $payment_method=='rocket'){
                    $sdata['transaction_id'] =$this->input->post('transaction_id');
                }else{
                    $sdata['transaction_id'] =NULL;
                }
                $booked_id = $this->app_model->homeserviceOrder($sdata);
                if($booked_id>0){
                    unset($_SESSION["shopping_cart"]);
                    $data['order_status'] = $booked_id;
                }else{
                    $data['order_status'] = '0';
                }
                $data['available'] = 'on';
            }else{
                $data['order_status'] = '0';
            }
        }else{
            $data['available'] = 'off';
        }
        header('Content-type: application/json');
		echo json_encode( $data );
    }
    
    
    /**
     * This function is used to book advance order
     * @author : Juman
     * @version : 1.0
     * @since : 09 Sept 2019
     */ 
    function advanceBookingOrder(){ 
        $datetime = $this->input->post('datetime');
        $order_type = $this->input->post('order_type');
        $order_total = $this->input->post('order_total');
        $payment_method = $this->input->post('payment_method');
        $business_id = $this->input->post('business_id');
        $count = count($this->cart->contents());
        if($this->app_model->checkBusinessAvailable($business_id)>0){
            if($count>0){
                if(get_cookie('isUserLoggedIn') == TRUE){
                    $userId = get_cookie('user_id');
                    if($payment_method=='bkash' || $payment_method=='rocket'){
                        $transaction_id =$this->input->post('transaction_id');
                    }else{
                        $transaction_id =NULL;
                    }
                    $booked_id = $this->app_model->advanceBookingOrder($order_type,$order_total,$payment_method,$business_id,$userId,$datetime,$transaction_id);
                    if($booked_id>0){
                        $this->cart->destroy();
                        $data['order_status'] = $booked_id;
                    }else{
                        $data['order_status'] = '0';
                    }
                    $data['user_login'] = 'true';
                }else{
                    $data['user_login'] = 'false';
                }
                $data['available'] = 'on';
            }else{
                $data['order_status'] = '0';
            }
        }else{
            $data['available'] = 'off';
        }
            
        
        header('Content-type: application/json');
		echo json_encode( $data );
    }
    
    
    function applyCoupon(){
        $coupon_code = $this->security->xss_clean($this->input->post('coupon_code'));
        $cart_total = $this->cart->total();
        $tz = 'Asia/Dhaka';
        $tz_obj = new DateTimeZone($tz);
        $today = new DateTime("now", $tz_obj);
        $cur_time = $today->format('Y-m-d H:i:s');
        $result = $this->common_model->applyCoupon($coupon_code,$cur_time);
        $data = array();
        if(!empty($result)){
            
            $userId = get_cookie('user_id');
            $used_usage = $this->common_model->checkUserUsage($userId,$result->coupon_id);
            if( $result->user_usage > $used_usage){
                if($cart_total>=$result->minimum_total){
                    
                    $data['status']="TRUE";
                    if($result->discount_type=="1"){
                        $coupon_amount = $cart_total * ($result->discount_amount/100);
                    }else{
                        $coupon_amount = $result->discount_amount;
                    }
                    $this->session->set_userdata('coupon_id',$result->coupon_id);
                    $this->session->set_userdata('minimum_total',$result->minimum_total);
                    $this->session->set_userdata('coupon_amount',$coupon_amount);
                    $this->session->set_userdata('coupon_code',$coupon_code);
                    $data['coupon_code']=$coupon_code;
                    $data['coupon_amount']=$coupon_amount;
                    
                    //$this->load->view("app/home/cart_body",$data);
                    
                }else{
                    $data['minimum_total']= "Please order minimum ".$result->minimum_total;
                }
            }else{
                $data['status']="FALSE";
            }
                
        }else{
            $data['status']="FALSE";
        }
        echo(json_encode($data));
    }
    
    
    /**
     * This function is used to search business
     * @author : juman
     * @version : 1.0
     * @since : 14 sept 2019
    */
    function searchBusiness(){
        $keyword = $this->input->post('keyword');
        $data=array();
        $data['business_list'] = $this->app_model->searchBusiness($keyword);
        
        $this->load->view("app/home/search_data", $data);
    }
    /**
     * This function is used to get all categories with service
     * @author : juman
     * @version : 1.0
     * @since : 15 oct 2019
    */
    function getAllCategories(){
        $data=array();
        $data['pageName'] = 'categories_service';
        $this->load->view("app/home/get_categories", $data);
    }
    /**
     * This function is used to get area under a city
     * @author : juman
     * @version : 1.0
     * @since : 24 sept 2019
    */
    function getAreaUnderCity(){
        $city_id = $this->input->post('city_id');
            
        $result = $this->common_model->getAreaUnderCity($city_id);
        $html ='';
        if (!empty($result)){
            $html.= '<option value disabled>Select Area</option>';
            foreach($result as $area){
               $html.= '<option value="'.$area->area_id.'">'.$area->area_name.'</option>';
            }
        }
        else { $html.= '<option value disabled selected>Select Area</option>';  }
        
        echo $html;
    }
    
    function nearestBusiness(){
        $data=array();
        $data['nc_location']='nc';
        $this->global['pageTitle'] = 'nearest business';
        $this->global['pageName'] = 'business';
        $city_id = get_cookie('city');
        $area_id = get_cookie('area');
        if(isset($city_id) && isset($area_id)){
            $attr = array('city_id'=>$city_id,'area_id'=>$area_id);
            $data['business_list'] = $this->app_model->get_nearest_businesses($attr);
            $this->loadFrontendViews("home/businesses", $this->global, $data, NULL);
        
        }
    }
    
    /**
     * author: juman
     * since :24-sept-2019
     * This function is used to check valid area and city
     * @return string $result 
     */
    function setCookieData(){
        $city_id = $this->input->post('city_id');
        $area_id = $this->input->post('area_id');
            
        $result = $this->common_model->checkValidLocation($city_id,$area_id);
        delete_cookie("city");
        delete_cookie("area");
        if ($result>0){
            $data=['isValid' => 'true'];
            $expire_time=time() +2592000;
            set_cookie('city',$city_id,$expire_time);
            set_cookie('area',$area_id,$expire_time);
            
        }else { $data=['isValid' => 'false']; }
        header('Content-type: application/json');
        echo json_encode($data) ;
    }
    
    /**
     * author: juman
     * since :24-sept-2019
     * This function is used to check valid area and city
     * @return string $result 
     */
    function setAreaData(){
        $city_id=1;
        $area_id=$this->uri->segment(4);
            
        $result = $this->common_model->checkValidLocation($city_id,$area_id);
        delete_cookie("city");
        delete_cookie("area");
        if ($result>0){
            $expire_time=time() +2592000;
            set_cookie('city',$city_id,$expire_time);
            set_cookie('area',$area_id,$expire_time);
            return redirect(site_url("app/nearestBusiness"),"refresh");
        }else {  
            return redirect(site_url("app/home"),"refresh");
        }
    }
    
    
    /**
     * This function is load all data for home service
     */
    public function homeservice()
    {
        $data=array();
        $this->global['pageTitle'] = 'Home Service';
        $this->global['pageName'] = 'home_service';
        
        $con = array('category_type'=>'1','isDeleted'=>0,'status'=>1);
        $con2 = array('category_type'=>'2','isDeleted'=>0,'status'=>1);
        $data['categories'] = $this->app_model->get_categories1($con);
        $data['categories2'] = $this->app_model->get_categories2($con2);
        
        $this->loadFrontendViews("homeservice/index", $this->global, $data, NULL);

    }
    
    /**
     * This function is load all data for home service customer billing page
     */
    public function homeserviceCustomerInfo()
    {
        $this->global['pageTitle'] = 'Billing Info';
        $this->global['pageName'] = 'homeservice_customer_info';
        
        $this->loadFrontendViews("homeservice/customer_info", $this->global, NULL, NULL);

    }
    
    function homeserviceCheckout(){
        if(empty($_SESSION["shopping_cart"])) {
            return redirect(site_url("app/homeservice"),"refresh");
        }
        $this->global['pageTitle'] = 'Checkout';
        $this->global['pageName'] = 'homeservice_checkout';
        $data=array();
        $data['customer_name'] = $this->input->get("customer_name");
        $data['customer_contact'] = $this->input->get("customer_contact");
        $data['customer_area'] = $this->input->get("area_id");
        $data['customer_address'] = $this->input->get("customer_address");
        
        $this->loadFrontendViews("homeservice/homeservice_checkout", $this->global, $data, NULL);
    }
    
    /**
     * This function is used to send push notification
     * @author : juman
     * @version : 1.0
     * @since : 03 nov 2019
    */
    function pushNotification(){
        $order_id = $this->input->post('order_id');
        $business_id = $this->app_model->getSingleOrder($order_id);
        notifyToAdmin($business_id,$order_id);
    }
    
    

    /**
     * This function is load all data for home page
     */
    public function whoops()
    {
        $data=array();
        $this->global['pageTitle'] = 'NearChair : 404';
        $data['pageName'] = '404';
        $this->loadFrontendViews("404", $this->global, $data, NULL);

    }
    
}