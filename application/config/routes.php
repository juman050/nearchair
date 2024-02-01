<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = "welcome";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;


/*******************************Back Office Start ********************************************/

/***USER DEFINED ROUTES ***/

$route['backoffice'] = 'NearchairLogin';
$route['loginMe'] = 'NearchairLogin/loginMe';
$route['dashboard'] = 'NearchairDashboard';

$route['backoffice/logout'] = 'NearchairDashboard/logout';
$route['userListing'] = 'NearchairDashboard/userListing';
$route['userListing/(:num)'] = "NearchairDashboard/userListing/$1";
$route['backoffice/addNew'] = "NearchairDashboard/addNew";
$route['backoffice/addNewUser'] = "NearchairDashboard/addNewUser";
$route['backoffice/editOld'] = "NearchairDashboard/editOld";
$route['backoffice/editUser/(:num)'] = "NearchairDashboard/editOld/$1";
$route['backoffice/editUser'] = "NearchairDashboard/editUser";
$route['backoffice/deleteUser'] = "NearchairDashboard/deleteUser";
$route['backoffice/moveAdmin'] = "NearchairDashboard/moveAdmin";
$route['backoffice/profile'] = "NearchairDashboard/profile";
$route['backoffice/profile/(:any)'] = "NearchairDashboard/profile/$1";
$route['backoffice/profileUpdate'] = "NearchairDashboard/profileUpdate";
$route['backoffice/profileUpdate/(:any)'] = "NearchairDashboard/profileUpdate/$1";

$route['loadChangePass'] = "NearchairDashboard/loadChangePass";
$route['backoffice/changePassword'] = "NearchairDashboard/changePassword";
$route['backoffice/changePassword/(:any)'] = "NearchairDashboard/changePassword/$1";
$route['pageNotFound'] = "NearchairDashboard/pageNotFound";
$route['checkEmailExists'] = "NearchairDashboard/checkEmailExists";
$route['login-history'] = "NearchairDashboard/loginHistoy";
$route['login-history/(:num)'] = "NearchairDashboard/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "NearchairDashboard/loginHistoy/$1/$2";

/*** Forget Password DEFINED ROUTES For Administrative ***/
$route['backoffice/forgotPassword'] = "NearchairLogin/forgotPassword";
$route['backoffice/resetPasswordUser'] = "NearchairLogin/resetPasswordUser";
$route['backoffice/resetPasswordConfirmUser'] = "NearchairLogin/resetPasswordConfirmUser";
$route['backoffice/resetPasswordConfirmUser/(:any)'] = "NearchairLogin/resetPasswordConfirmUser/$1";
$route['backoffice/resetPasswordConfirmUser/(:any)/(:any)'] = "NearchairLogin/resetPasswordConfirmUser/$1/$2";
$route['backoffice/createPasswordUser'] = "NearchairLogin/createPasswordUser";



/*** Owner DEFINED ROUTES ***/
$route['ownerListing'] = 'NearchairOwner/index';
$route['ownerListing/(:num)'] = "NearchairOwner/index/$1";
$route['backoffice/owner/addNew'] = "NearchairOwner/addNew";
$route['backoffice/owner/addNewOwner'] = "NearchairOwner/addNewOwner";
$route['backoffice/owner/editOwner'] = "NearchairOwner/editOwner";
$route['backoffice/owner/editOwner/(:num)'] = "NearchairOwner/editOwner/$1";
$route['backoffice/owner/updateOwner'] = "NearchairOwner/updateOwner";
$route['backoffice/deleteOwner'] = "NearchairOwner/deleteOwner";
$route['backoffice/moveOwner'] = "NearchairOwner/moveOwner";
$route['checkOwnerEmailExists'] = "NearchairOwner/checkOwnerEmailExists";


$route['ownersBusiness'] = 'NearchairOwner/ownersBusiness';
$route['ownersBusiness/(:num)'] = "NearchairOwner/ownersBusiness/$1";
$route['backoffice/addOwnersBusiness'] = 'NearchairOwner/addOwnersBusiness';
$route['backoffice/deleteOwnersBusiness'] = 'NearchairOwner/deleteOwnersBusiness';

/*** Category DEFINED ROUTES ***/
$route['categoryListing'] = 'NearchairCategory/index';
$route['categoryListing/(:num)'] = "NearchairCategory/index/$1";
$route['backoffice/category/addNew'] = 'NearchairCategory/addNew';
$route['backoffice/category/addNewCategory'] = 'NearchairCategory/addNewCategory';
$route['backoffice/category/editCategory'] = "NearchairCategory/editCategory";
$route['backoffice/category/editCategory/(:num)'] = "NearchairCategory/editCategory/$1";
$route['backoffice/updateCategory'] = "NearchairCategory/updateCategory";
$route['backoffice/deleteCategory'] = "NearchairCategory/deleteCategory";
$route['backoffice/moveCategory'] = "NearchairCategory/moveCategory";
$route['checkCategorySlugExists'] = "NearchairCategory/checkCategorySlugExists";

/*** City DEFINED ROUTES ***/
$route['cityListing'] = 'NearchairCity/index';
$route['cityListing/(:num)'] = "NearchairCity/index/$1";
$route['backoffice/city/addNew'] = 'NearchairCity/addNew';
$route['backoffice/city/addNewCity'] = 'NearchairCity/addNewCity';
$route['backoffice/city/editCity'] = "NearchairCity/editCity";
$route['backoffice/city/editCity/(:num)'] = "NearchairCity/editCity/$1";
$route['backoffice/updateCity'] = "NearchairCity/updateCity";
$route['backoffice/deleteCity'] = "NearchairCity/deleteCity";
$route['backoffice/moveCity'] = "NearchairCity/moveCity";

/*** Area DEFINED ROUTES ***/
$route['areaListing'] = 'NearchairArea/index';
$route['areaListing/(:num)'] = "NearchairArea/index/$1";
$route['backoffice/area/addNew'] = 'NearchairArea/addNew';
$route['backoffice/area/addNewArea'] = 'NearchairArea/addNewArea';
$route['backoffice/area/editArea'] = "NearchairArea/editArea";
$route['backoffice/area/editArea/(:num)'] = "NearchairArea/editArea/$1";
$route['backoffice/updateArea'] = "NearchairArea/updateArea";
$route['backoffice/deleteArea'] = "NearchairArea/deleteArea";
$route['backoffice/moveArea'] = "NearchairArea/moveArea";



/*** business DEFINED ROUTES ***/
$route['businessListing'] = 'NearchairBusiness/index';
$route['businessListing/(:num)'] = "NearchairBusiness/index/$1";
$route['businessPending'] = 'NearchairBusiness/pending';
$route['businessPending/(:num)'] = "NearchairBusiness/pending/$1";
$route['businessAccepted'] = 'NearchairBusiness/accepted';
$route['businessAccepted/(:num)'] = "NearchairBusiness/accepted/$1";
$route['businessCancelled'] = 'NearchairBusiness/cancelled';
$route['businessCancelled/(:num)'] = "NearchairBusiness/cancelled/$1";



$route['backoffice/business/addNew'] = 'NearchairBusiness/addNew';
$route['backoffice/business/addNewBusiness'] = 'NearchairBusiness/addNewBusiness';
$route['backoffice/business/editBusiness'] = "NearchairBusiness/editBusiness";
$route['backoffice/business/editBusiness/(:num)'] = "NearchairBusiness/editBusiness/$1";
$route['backoffice/updateBusiness'] = "NearchairBusiness/updateBusiness";
$route['backoffice/deleteBusiness'] = "NearchairBusiness/deleteBusiness";
$route['backoffice/moveBusiness'] = "NearchairBusiness/moveBusiness";
$route['checkBusinessEmailExists'] = "NearchairBusiness/checkBusinessEmailExists";
$route['checkBusinessSlugExists'] = "NearchairBusiness/checkBusinessSlugExists";
$route['backoffice/area/getAreaUnderCity'] = 'NearchairArea/getAreaUnderCity';
$route['backoffice/business/addService/(:num)'] = "NearchairBusiness/addService/$1";
$route['backoffice/business/editService/(:num)/(:any)'] = "NearchairBusiness/editService/$1/$2";
$route['backoffice/business/storeBusinessService'] = "NearchairBusiness/storeBusinessService";
$route['backoffice/business/updateBusinessService'] = "NearchairBusiness/updateBusinessService";
$route['backoffice/deleteService'] = "NearchairBusiness/deleteService";
$route['backoffice/add_gallery_image'] = "NearchairBusiness/add_gallery_image";
$route['backoffice/deleteGalleryImage'] = "NearchairBusiness/deleteGalleryImage";
$route['backoffice/suggestionService'] = "NearchairBusiness/suggestionService";

/*** System Settings DEFINED ROUTES ***/
$route['backoffice/settings/systemInfo']      = 'NearchairSettings/index';
$route['backoffice/updateSystemInfo']         = 'NearchairSettings/updateSystemInfo';
$route['backoffice/settings/about_us']        = 'NearchairSettings/about_us';
$route['backoffice/updateAboutUs']            = 'NearchairSettings/updateAboutUs';
$route['backoffice/settings/logo']            = 'NearchairSettings/logo';
$route['backoffice/updateLogo']               = 'NearchairSettings/updateLogo';
$route['backoffice/updateAppLogo']            = 'NearchairSettings/updateAppLogo';
$route['backoffice/settings/slider']          = 'NearchairSettings/slider';
$route['backoffice/slider/addNewslider']      = 'NearchairSettings/addNewslider';
$route['backoffice/getSortedSliders']         = 'NearchairSettings/getSortedSliders';
$route['backoffice/deleteSlider']             = "NearchairSettings/deleteSlider";


/*** Order management ROUTES ***/
$route['orderListing'] = 'NearchairOrder/index';
$route['orderListing/(:num)'] = "NearchairOrder/index/$1";
$route['orderPending'] = 'NearchairOrder/pending';
$route['orderPending/(:num)'] = "NearchairOrder/pending/$1";
$route['orderAccepted'] = 'NearchairOrder/accepted';
$route['orderAccepted/(:num)'] = "NearchairOrder/accepted/$1";
$route['orderCancelled'] = 'NearchairOrder/cancelled';
$route['orderCancelled/(:num)'] = "NearchairOrder/cancelled/$1";
$route['backoffice/order/editOrder'] = "NearchairOrder/editOrder";
$route['backoffice/order/editOrder/(:num)'] = "NearchairOrder/editOrder/$1";
$route['backoffice/order/view'] = "NearchairOrder/view";
$route['backoffice/order/view/(:num)'] = "NearchairOrder/view/$1";
$route['backoffice/deleteOrder'] = "NearchairOrder/deleteOrder";
$route['backoffice/moveOrder'] = "NearchairOrder/moveOrder";
$route['backoffice/order/updateOrder'] = "NearchairOrder/updateOrder";

/***Homeservice Order management ROUTES ***/
$route['homserviceOrderListing'] = 'NearchairHomeserviceOrder/index';
$route['homserviceOrderListing/(:num)'] = "NearchairHomeserviceOrder/index/$1";
$route['backoffice/homserviceOrder/view'] = "NearchairHomeserviceOrder/view";
$route['backoffice/homserviceOrder/view/(:num)'] = "NearchairHomeserviceOrder/view/$1";
$route['homserviceOrderPending'] = 'NearchairHomeserviceOrder/pending';
$route['homserviceOrderPending/(:num)'] = "NearchairHomeserviceOrder/pending/$1";
$route['homserviceOrderAccepted'] = 'NearchairHomeserviceOrder/accepted';
$route['homserviceOrderAccepted/(:num)'] = "NearchairHomeserviceOrder/accepted/$1";
$route['homserviceOrderCancelled'] = 'NearchairHomeserviceOrder/cancelled';
$route['homserviceOrderCancelled/(:num)'] = "NearchairHomeserviceOrder/cancelled/$1";
$route['backoffice/deleteHomerserviceOrder'] = "NearchairHomeserviceOrder/deleteOrder";
$route['backoffice/moveHomeserviceOrder'] = "NearchairHomeserviceOrder/moveOrder";
$route['backoffice/homeservice/updateOrder'] = "NearchairHomeserviceOrder/updateOrder";

/*** User management ROUTES ***/
$route['users'] = 'NearchairUser/index';
$route['users/(:num)'] = "NearchairUser/index/$1";
$route['usersPending'] = 'NearchairUser/pending';
$route['usersPending/(:num)'] = "NearchairUser/pending/$1";
$route['usersAccepted'] = 'NearchairUser/accepted';
$route['usersAccepted/(:num)'] = "NearchairUser/accepted/$1";
$route['backoffice/moveUser'] = "NearchairUser/moveUser";
$route['backoffice/deleteCurrentUser'] = "NearchairUser/deleteUser";

/***Homeservice services  ROUTES ***/
$route['backoffice/homeServiceList'] = "NearchairHomeserviceOrder/homeServiceList";
$route['backoffice/homeService/storeBusinessService'] = "NearchairHomeserviceOrder/storeBusinessService";
$route['backoffice/homeService/editService/(:num)'] = "NearchairHomeserviceOrder/editService/$1";
$route['backoffice/homeService/updateBusinessService'] = "NearchairHomeserviceOrder/updateBusinessService";
$route['backoffice/homeService/deleteService'] = "NearchairHomeserviceOrder/deleteService";


/*Coupon Routes*/
$route['couponListing'] = 'NearchairCoupon/index';
$route['backoffice/coupon/addNew'] = 'NearchairCoupon/addNew';
$route['backoffice/coupon/addNewCoupon'] = 'NearchairCoupon/addNewCoupon';
$route['backoffice/coupon/editCoupon'] = "NearchairCoupon/editCoupon";
$route['backoffice/coupon/editCoupon/(:num)'] = "NearchairCoupon/editCoupon/$1";
$route['backoffice/updateCoupon'] = "NearchairCoupon/updateCoupon";
$route['backoffice/deleteCoupon'] = "NearchairCoupon/deleteCoupon";
$route['backoffice/moveCoupon'] = "NearchairCoupon/moveCoupon";


/*Business Offers Routes*/
$route['backoffice/offer/addNew'] = 'NearchairOffer/addNew';
$route['backoffice/offer/addNew/(:num)'] = 'NearchairOffer/addNew/$1';
$route['backoffice/offer/addNewOffer'] = 'NearchairOffer/addNewOffer';
$route['backoffice/offer/editOffer'] = 'NearchairOffer/editOffer';
$route['backoffice/offer/editOffer/(:num)'] = 'NearchairOffer/editOffer/$1';
$route['backoffice/updateOffer'] = 'NearchairOffer/updateOffer';
/*****************************************Back Office End **********************************/





/***************************************** FrontEnd Start **********************************/


$route['landing-page'] = "NearchairHome/index";


$route['app/home'] = "app/NearchairHome/index";
$route['app/searchBusiness'] = "app/NearchairHome/searchBusiness";
$route['app/whoops'] = "app/NearchairHome/whoops";
$route['app/login'] = "app/LoginController/index";
$route['app/loginOwner'] = "app/LoginController/loginOwner";
$route['app/logoutOwner'] = "app/LoginController/logoutOwner";

$route['app/profile'] = "app/OwnerController";
$route['app/successProfile/(:any)'] = "app/OwnerController/sendOwnerEmail/$1";
$route['app/updateOwnerToken'] = "app/Nc/ownerUpdateToken";

$route['app/ownerChangeProfilePic'] = "app/ownerController/ownerChangeProfilePic";
$route['app/ownerOrders'] = "app/ownerController/ownerOrders";
$route['app/pendingOrders'] = "app/ownerController/pendingOrders";
$route['app/add_service'] = "app/ownerController/add_service";
$route['app/ownerBusiness'] = "app/ownerController/ownerBusiness";
$route['app/ownerServiceList'] = "app/ownerController/ownerServiceList";
$route['app/ownerAddService'] = "app/ownerController/ownerAddService";
$route['app/ownerGallery'] = "app/ownerController/ownerGallery";
$route['app/add_gallery_image'] = "app/OwnerController/add_gallery_image";
$route['app/updateBusiness'] = "app/OwnerController/updateBusiness";
$route['app/deleteGalleryImage'] = "app/OwnerController/deleteGalleryImage";
$route['app/suggestionService'] = "app/ownerController/suggestionService";
$route['app/deleteService'] = "app/ownerController/deleteService";
$route['app/getSingleService'] = "app/ownerController/getSingleService";
$route['app/editService'] = "app/ownerController/editService";
$route['app/singleBusinessServices'] = "app/ownerController/singleBusinessServices";
$route['app/change_business_status'] = "app/ownerController/change_business_status";
$route['app/singleBusinessOrderDetails'] = "app/ownerController/singleBusinessOrderDetails";
$route['app/changeOrderStatus'] = "app/ownerController/changeOrderStatus";

$route['app/user'] = "app/UserController/index";
$route['app/loginUser'] = "app/UserController/loginUser";
$route['app/registerUser'] = "app/UserController/registerUser";

$route['app/forgotPassword'] = "app/UserController/forgotPassword";
$route['app/checkForgetVerifyCode'] = "app/UserController/checkForgetVerifyCode";
$route['app/checkForgotNumber'] = "app/UserController/checkForgotNumber";
$route['app/forgotChangePassword'] = "app/UserController/forgotChangePassword";
$route['app/ChangeForgotPassword'] = "app/UserController/ChangeForgotPassword";

$route['app/get_area_by_city'] = "app/UserController/get_area_by_city";
$route['app/insertUser'] = "app/UserController/insertUser";
$route['app/logoutUser'] = "app/UserController/logoutUser";
$route['app/userprofile'] = "app/UserProfileController";
$route['app/checkUsername'] = "app/UserController/checkUsername";
$route['app/checknumber'] = "app/UserController/checknumber";
$route['app/checkCode'] = "app/UserController/checkCode";
$route['app/verifyCode'] = "app/UserController/verifyCode";


$route['app/checkOldpassword'] = "app/UserProfileController/checkOldpassword";
$route['app/updateUserPassword'] = "app/UserProfileController/updateUserPassword";
$route['app/changeProfilePic'] = "app/UserProfileController/changeProfilePic";
$route['app/userProfileView'] = "app/UserProfileController/userProfileView";
$route['app/updateUserProfile'] = "app/UserProfileController/updateUserProfile";
$route['app/userProfileChangePassword'] = "app/UserProfileController/userProfileChangePassword";
$route['app/userProfileOrderList'] = "app/UserProfileController/userProfileOrderList";
$route['app/singleOrderDetails'] = "app/UserProfileController/singleOrderDetails";
$route['app/add_review'] = "app/UserProfileController/add_review";
$route['app/addreview'] = "app/UserProfileController/addreview";


$route['app/category/(:any)'] = 'app/NearchairHome/singlecategory/$1';
$route['app/goto_business/(:any)']  = "app/NearchairHome/goto_business/$1";
$route['app/business/(:any)']  = "app/NearchairHome/business/$1";
$route['app/loadMoreReviews']  = "app/NearchairHome/loadMoreReviews";
$route['app/checkout'] = "app/NearchairHome/checkout";
$route['app/addcartData']  = "app/NearchairHome/addcartData";
$route['app/removeCurrentData'] = "app/NearchairHome/removeCurrentData";
$route['app/addToCart'] = "app/NearchairHome/addToCart";
$route['app/removeFromCart'] = "app/NearchairHome/removeFromCart";
$route['app/checkBusinessInCart'] = "app/NearchairHome/checkBusinessInCart";
$route['app/applyCoupon'] = "app/NearchairHome/applyCoupon";
$route['app/bookOrderNow'] = "app/NearchairHome/bookOrderNow";
$route['app/advanceBooking'] = "app/NearchairHome/advanceBookingOrder";


$route['app/homeservice'] = "app/NearchairHome/homeservice";
$route['app/homeservice/addcartData'] = "app/NearchairHome/homeserviceAddCartData";
$route['app/homeservice/removeCurrentData'] = "app/NearchairHome/homeserviceRemoveCurrentData";
$route['app/homeservice/customer-from'] = "app/NearchairHome/homeserviceCustomerInfo";
$route['app/homeservice/checkout'] = "app/NearchairHome/homeserviceCheckout";
$route['app/homeservice/removeFromCart'] = "app/NearchairHome/removeHomeServiceFromCart";
$route['app/homeservice/homeserviceOrder'] = "app/NearchairHome/homeserviceOrder";


$route['app/getAllCategories'] = "app/NearchairHome/getAllCategories";
$route['app/getAreaUnderCity'] = "app/NearchairHome/getAreaUnderCity";
$route['app/setAreaData/(:any)/(:num)'] = "app/NearchairHome/setAreaData/$1/$2";
$route['app/nearestBusiness'] = "app/NearchairHome/nearestBusiness";
$route['app/setCookieData'] = "app/NearchairHome/setCookieData";
$route['app/about'] = "app/NearchairHome/about";
$route['app/contact'] = "app/NearchairHome/contact";
$route['app/instructions'] = "app/NearchairHome/instructions";

$route['app/pushNotification'] = "app/NearchairHome/pushNotification";


$route['app/nc/orders'] = "app/Nc/orders";



/*****************************************FrontEnd End **************************************/