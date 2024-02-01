<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Nc
 * This class is only for administrative app
 * @author : juman
 * @version : 1.0
 * @since : 03 november 2019
 */
class Nc extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('app/nc_model');
    }


    /**
     * all orders screen
    */
    public function orders()
    {
        $attr ="";
        $data=array();
        $nc_key =$this->input->post('nc_key');
        if($nc_key !=""){
            try {
                if($nc_key=="order_pending"){
                    $order_id =$this->input->post('order_id');
                    $orderInfo = array('order_status'=>0,'updatedDtm'=>date('Y-m-d H:i:s'));
                    $result = $this->nc_model->moveOrder($order_id,$orderInfo);
                    if ($result > 0) { $data = array('status'=>TRUE); }else{$data = array('status'=>FALSE);}
                }else if($nc_key=="order_accepted"){
                    $order_id =$this->input->post('order_id');
                    $orderInfo = array('order_status'=>1,'updatedDtm'=>date('Y-m-d H:i:s'));
                    $result = $this->nc_model->moveOrder($order_id,$orderInfo);
                    if ($result > 0) { 
                        $data = array('status'=>TRUE);
                    }else{$data = array('status'=>FALSE);}
                }else if($nc_key=="order_cancelled"){
                    $order_id =$this->input->post('order_id');
                    $orderInfo = array('order_status'=>2,'updatedDtm'=>date('Y-m-d H:i:s'));
                    $result = $this->nc_model->moveOrder($order_id,$orderInfo);
                    if ($result > 0) { $data = array('status'=>TRUE); }else{$data = array('status'=>FALSE);}
                    
                }else if($nc_key=="order_admin"){
                    $attr ="";
                    $data = $this->nc_model->orders($attr);
                }else{
                    $data = array('status'=>'something_wrong');
                }
            }catch(Exception $e) {
              $data['exception']='Message: ' .$e->getMessage();
            }
            
            header('Content-type: application/json');
    		echo json_encode( $data );
        }
        

    }
    
    function order_details(){
        $nc_key =$this->input->post('nc_key');
        if($nc_key !="" && $nc_key=="order_details"){
            try {
                $data=array();
                $this->load->model('nearchair_order_model');
                $order_id =$this->input->post('order_id');
                $data['orderInfo']=$orderData= $this->nearchair_order_model->getOrdersDetails($order_id);
                $data['orderServices'] = $this->nearchair_order_model->getOrderServices($order_id);
                $data['orderAdvanced'] = $this->nearchair_order_model->getOrderAdvanced($order_id);
                $data['businessDetails'] = $this->nearchair_order_model->getBusinessDetails($orderData[0]->business_id);
                $data['isAnyOffer'] = isAnyOffer($orderData[0]->business_id);
            }catch(Exception $e) {
              $data['exception']='Message: ' .$e->getMessage();
            }
            header('Content-type: application/json');
            echo json_encode( $data );
        }
    }
    
    /**
     * ownerBusinessInfo Page for this controller.
    */
    public function ownerUpdateToken()
    {
        $data=array();
        $owner_id = $this->input->post('owner_id');
        $owner_token = $this->input->post('owner_token');
        
        
        $updateData = array('token' => $owner_token);
        $result = $this->nc_model->ownerUpdateToken($owner_id,$updateData);

        if($result){
            $data = array(
                'status' => TRUE,
            );
        }else{
            $data = array(
                'status' => FALSE,
            );
        }

        header('Content-type: application/json');
        echo json_encode($data);

    }
    
    
}