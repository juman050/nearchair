<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : NearchairHome
 * This is the Home controller for frontend of this preoject.
 * @author : Emon
 * @version : 1.0
 * @since : 8 Oct 2019
 */
class NearchairHome extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * This function is load all data for home page
     */
    public function index()
    {
        $data=array();
        $data['pageTitle'] = 'NearChair : Home';
        $data['pageName'] = 'Home';
        $this->load->view('landingPage/index',$data);

    }
    
}