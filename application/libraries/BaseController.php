<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Juman
 * @version : 1.0
 * @since : 13 Augest 2019
 */
class BaseController extends CI_Controller {
	protected $role = '';
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	
	protected $ownerId = '';
	protected $ownerName = '';
	protected $ownerMobile = '';
	protected $ownerEmail = '';
	protected $ownerJoiningDate = '';
	
	protected $user_id = '';
	protected $fullname = '';
	protected $userEmail = '';
	protected $userMobile = '';
	protected $userCity = '';
	protected $userArea = '';
	
	protected $global = array ();
	protected $lastLogin = '';


	
	/**
	 * Takes mixed data and optionally a status code, then creates the response
	 *
	 * @access public
	 * @param array|NULL $data
	 *        	Data to output to the user
	 *        	running the script; otherwise, exit
	 */
	public function response($data = NULL) {
		$this->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
		exit ();
	}
	
	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn() {
		$isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
		
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect ( 'backoffice' );
		} else {
			$this->role = $this->session->userdata ( 'role' );
			$this->vendorId = $this->session->userdata ( 'adminId' );
			$this->name = $this->session->userdata ( 'name' );
			$this->roleText = $this->session->userdata ( 'roleText' );
			$this->lastLogin = $this->session->userdata ( 'lastLogin' );
			
			$this->global ['name'] = $this->name;
			$this->global ['role'] = $this->role;
			$this->global ['role_text'] = $this->roleText;
			$this->global ['last_login'] = $this->lastLogin;
		}
	}
	
	/**
	 * This function is used to check the access
	 */
	function isAdmin() {
		if ($this->role != ROLE_ADMIN) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * This function is used to check the access
	 */
	function isTicketter() {
		if ($this->role != ROLE_ADMIN || $this->role != ROLE_MANAGER) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * This function is used to load the set of views
	 */
	function loadThis() {
		$this->global ['pageTitle'] = 'CodeInsect : Access Denied';
		
		$this->load->view ( 'backoffice/includes/header', $this->global );
		$this->load->view ( 'backoffice/access' );
		$this->load->view ( 'backoffice/includes/footer' );
	}
	
	/**
	 * This function is used to logged out user from system
	 */
	function logout() {
		$this->session->sess_destroy ();
		redirect ( 'backoffice' );
	}

	/**
     * This function used to load views
     * @param {string} $viewName : This is view name
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $pageInfo : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return {null} $result : null
     */
    function loadAdminViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

        $this->load->view('backoffice/includes/header', $headerInfo);
        $this->load->view('backoffice/'.$viewName, $pageInfo);
        $this->load->view('backoffice/includes/footer', $footerInfo);
    }
	
	/**
	 * This function used provide the pagination resources
	 * @param {string} $link : This is page link
	 * @param {number} $count : This is page count
	 * @param {number} $perPage : This is records per page limit
	 * @return {mixed} $result : This is array of records and pagination data
	 */
	function paginationCompress($link, $count, $perPage = 10, $segment = SEGMENT) {
		$this->load->library ( 'pagination' );

		$config ['base_url'] = base_url () . $link;
		$config ['total_rows'] = $count;
		$config ['uri_segment'] = $segment;
		$config ['per_page'] = $perPage;
		$config ['num_links'] = 5;
		$config ['full_tag_open'] = '<nav><ul class="pagination">';
		$config ['full_tag_close'] = '</ul></nav>';
		$config ['first_tag_open'] = '<li class="arrow">';
		$config ['first_link'] = 'First';
		$config ['first_tag_close'] = '</li>';
		$config ['prev_link'] = 'Previous';
		$config ['prev_tag_open'] = '<li class="arrow">';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = 'Next';
		$config ['next_tag_open'] = '<li class="arrow">';
		$config ['next_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li class="arrow">';
		$config ['last_link'] = 'Last';
		$config ['last_tag_close'] = '</li>';
	
		$this->pagination->initialize ( $config );
		$page = $config ['per_page'];
		$segment = $this->uri->segment ( $segment );
	
		return array (
				"page" => $page,
				"segment" => $segment
		);
	}
	
	
	//*********************************************************************************//
	//************************  Start coding for frontend ****************************//
	//*********************************************************************************//

	/**
     * This function used to load views
     * @param {string} $viewPath : Path of page which will be load
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $data : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return View a page
     * @author Emon
     * @version 1.0
     * @since : 26 Augest 2019
     */

    function loadFrontendViews($viewPath = "", $headerInfo = array(), $data = array(), $footerInfo = array()){

        $this->load->view('app/includes/header', $headerInfo);
        $this->load->view('app/'.$viewPath, $data);
        $this->load->view('app/includes/footer', $footerInfo);
    }

	/**
     * This function used to load views
     * @param {string} $viewPath : Path of page which will be load
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $data : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return View a page
     * @author Emon
     * @version 1.0
     * @since : 26 Augest 2019
     */

    function loadOwnerViews($viewPath = "", $headerInfo = array(), $data = array(), $footerInfo = array()){

        $this->load->view('app/owner_includes/header', $headerInfo);
        $this->load->view('app/'.$viewPath, $data);
        $this->load->view('app/owner_includes/footer', $footerInfo);
    }





	/**
     * This function used to check customer login or not
     * @param Null
     * @return true or false
     * @author Emon
     * @version 1.0
     * @since : 26 Augest 2019
     */

	function isOwnerLoggedIn() {
		$isOwnerLoggedIn = $this->session->userdata('isOwnerLoggedIn');

		if (! isset ( $isOwnerLoggedIn ) || $isOwnerLoggedIn != TRUE) {
			redirect ( 'app/login' );
		} else {
			$this->ownerId = $this->session->userdata ( 'owner_id' );
			$this->ownerName = $this->session->userdata ( 'owner_name' );
			$this->ownerMobile = $this->session->userdata ( 'owner_mobile' );
			$this->ownerEmail = $this->session->userdata ( 'owner_email' );
			$this->ownerJoiningDate = $this->session->userdata ( 'createdDtm' );
			
			$this->global ['ownerId'] = $this->ownerId;
			$this->global ['ownerName'] = $this->ownerName;
			$this->global ['ownerMobile'] = $this->ownerMobile;
			$this->global ['ownerEmail'] = $this->ownerEmail;
			$this->global ['ownerJoiningDate'] = $this->ownerJoiningDate;
		}
	}
	




	/**
     * This function used to load access denied page
     * @param Null
     * @return view a page
     * @author Emon
     * @version 1.0
     * @since : 26 Augest 2019
     */

	function notAllow() {
		$this->global ['pageTitle'] = 'CodeInsect : Access Denied';
		
		$this->load->view ( 'app/includes/header', $this->global );
		$this->load->view ( 'app/access' );
		$this->load->view ( 'app/includes/footer' );
	}

	




	/**
     * logout function for an owner
     * @param Null
     * @return redirect a controller after successfully logout
     * @author Emon
     * @version 1.0
     * @since : 26 Augest 2019
     */
	
	function logoutOwner() {
		$this->session->sess_destroy ();
		redirect ( 'app/login' );
	}









	/**
     * This function used to check user login or not
     * @param Null
     * @return true or false
     * @author Emon
     * @version 1.0
     * @since : 9 sep 2019
     */

	function isUserLoggedIn() {
		$isUserLoggedIn = get_cookie('isUserLoggedIn');
		
		if (! isset ( $isUserLoggedIn ) || $isUserLoggedIn != TRUE) {
			redirect ( 'app/user' );
		} else {

			$this->user_id = get_cookie('user_id');
			$this->fullname = get_cookie('fullname');
			$this->userEmail = get_cookie('email');
			$this->userMobile = get_cookie('mobile');
			$this->userCity = get_cookie('city');
			$this->userArea = get_cookie('area');
			
			$this->global ['user_id'] = $this->user_id;
			$this->global ['fullname'] = $this->fullname;
			$this->global ['userEmail'] = $this->userEmail;
			$this->global ['userMobile'] = $this->userMobile;
			$this->global ['userCity'] = $this->userCity;
			$this->global ['userArea'] = $this->userArea;
		}
	}



	/**
     * logout function for an user
     * @param Null
     * @return redirect a controller after successfully logout
     * @author Emon
     * @version 1.0
     * @since : 9 sept 2019
     */
	
	function logoutUser() {
		delete_cookie('user_id');
		delete_cookie('fullname');
		delete_cookie('email');
		delete_cookie('mobile');
		delete_cookie('city');
		delete_cookie('area');
		delete_cookie('isUserLoggedIn');
		redirect ( 'app/home' );
	}












	//*********************************************************************************//
	//**************************  End of frontend code  *******************************//
	//*********************************************************************************//
	
	
	
	
	
}