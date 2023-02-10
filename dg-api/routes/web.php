<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return  $router->app->version();
});


$router->group(['prefix' => ''], function () use ($router) {
    $router->get('users', ['uses' => 'UserController@showAllUsers']);
    $router->get('verifyotp/{id}', ['uses' => 'UserController@verifyotp']);
    $router->post('login', ['uses' => 'AuthController@login']);
    $router->post('register', ['uses' => 'AuthController@register']);
    $router->get('category', ['uses' => 'CategoryController@showAll']);
    //basedonCatgetalldataofmenu
    $router->get('basedOnCatGetMenu/{id}', ['uses' => 'CategoryController@basedonCatgetalldataofmenu']);
    //CategoryController
    $router->get('admin/{id}', ['uses' => 'CategoryController@admin']);
    //restaurants_documents
    $router->get('restaurantsdocuments/{id}', ['uses' => 'CategoryController@restaurantsdocuments']);
    $router->post('categoryByHotelId', ['uses' => 'CategoryController@categoryByHotel']);
    
    //AllCat_ByHID
    $router->get('categoryByHotelId/{id}', ['uses' => 'CategoryController@AllCat_ByHID']);
    //AllSubCat_ByCatID
    //  $router->get('subCatByCatId/{id}', ['uses' => 'CategoryController@AllSubCat_ByCatID']);
     $router->get('getsubCatByCatId/{id}', ['uses' => 'CategoryController@AllSubCat_ByCatID']);
     
    $router->get('menu_submenu/{id}', ['uses' => 'CategoryController@AllCat_SubCat']);
    $router->get('menu_submenu1/{id}', ['uses' => 'CategoryController@AllCat_SubCat1']);
     $router->get('menu_submenu2/{id}', ['uses' => 'CategoryController@AllCat_SubCat2']);
    $router->get('getMenusWeb/{id}', ['uses' => 'CategoryController@menuDetailWeb']);
    
    
    $router->get('subcategory', ['uses' => 'Sub_CategoryController@showAll']);
     $router->get('menuBundle/{id}', ['uses' => 'Sub_CategoryController@menuBundle']);
    // addon_list
    
    
    //temp route
    $router->get('addon_list/{id}/{hotelid}', ['uses' => 'ItemDrinkMenuController@addon_list']);
    //basedOnCatId
     $router->get('basedOnCatId_addon_list/{id}/{hotelid}', ['uses' => 'ItemDrinkMenuController@basedOnCatId']);
    //showChildData
     $router->get('subcategorywithparent/{id}', ['uses' => 'Sub_CategoryController@showChildData']);
    $router->get('orderItems', ['uses' => 'Sub_CategoryController@showAll']);
    $router->post('addCategory', ['uses' => 'CategoryController@create']);
    //showallmenus
    $router->get('getallmenu/{id}', ['uses' => 'CategoryController@showallmenus']);
    
    //$router->post('updateCategory/{id}', ['uses' => 'CategoryController@update']);
    $router->post('addSubCategory', ['uses' => 'Sub_CategoryController@addSubCategory']);
    $router->post('updateSubCategory/{id}', ['uses' => 'Sub_CategoryController@updateSubCategory']);

    $router->post('addAddress', ['uses' => 'AddressController@create']);
    $router->post('updateAddress/{id}', ['uses' => 'AddressController@update']);
    $router->post('showByIdorderStatus/{id}', ['uses' => 'OrderController@showByIdorderStatus']);
    $router->get('restaurants', ['uses' => 'RestaurantController@showAllRestaurants']);
    
    //InvoiceStartDate($id)
    $router->get('InvoiceStartDate/{id}', ['uses' => 'RestaurantController@InvoiceStartDate']);
    // basedonname
    $router->post('basedonname', ['uses' => 'RestaurantController@basedonname']);
    $router->post('restaurantsBypincode', ['uses' => 'RestaurantController@restaurentByPin']);
    
    
    $router->post('restaurantsBypincode1', ['uses' => 'RestaurantController@restaurentByPin1']);
    $router->post('restaurentByPinandType', ['uses' => 'RestaurantController@restaurentByPinandType']);
    $router->post('empLogout', ['uses' => 'AuthController@empLogout']);
    $router->get('subcategory/{id}', ['uses' => 'Sub_CategoryController@showById']);
    $router->get('profile/{id}', ['uses' => 'UserController@getdataById']);
    $router->get('showOrders/{id}/{status}', ['uses' => 'OrderController@showAllOrdersByUID']);
    
    $router->get('OrderTab/{id}/{hid}', ['uses' => 'OrderController@OrderTab']);
    $router->get('WithDateOrderTab/{id}/{hid}/{date}', ['uses' => 'OrderController@WithDateOrderTab']);
    $router->post('ReportOrderTab/{id}/{hid}', ['uses' => 'OrderController@ReportOrderTab']);
    $router->post('OrderUpdate/{id}', ['uses' => 'OrderController@OrderUpdate']);
    
    $router->get('addresses/{id}', ['uses' => 'AddressController@showAllAddressByUID']);
    $router->get('addressbyid/{id}', ['uses' => 'AddressController@getaddressById']);
    
    
    //showAllAddressByUIDbyPincode
    $router->get('addresseswithmiles/{id}/{pincode}', ['uses' => 'AddressController@showAllAddressByUIDbyPincode']);
    
    
    $router->post('addCard', ['uses' => 'CardController@create']);
    $router->get('getAllCount', ['uses' => 'AuthController@getAllCount']);
    $router->post('addOrder', ['uses' => 'OrderController@create']);
    $router->post('updateorder/{id}', ['uses' => 'OrderController@update']);
    $router->post('addItems/{id}', ['uses' => 'OrderItemController@create']);
    $router->post('emp_login', ['uses' => 'AuthController@Emp_Login']);
    $router->post('emp_login_register', ['uses' => 'AuthController@Emp_Login_register']);
    $router->get('restaurants_orders_counts/{id}', ['uses' => 'OrderController@getCountOfOrder']);
    $router->get('restaurants_orders_list/{id}/{status}', ['uses' => 'OrderController@showAllOrdersByHotelID']);
    $router->get('orderItems/{id}', ['uses' => 'OrderController@showAllOrdersByONO']);
    $router->post('social_media', ['uses' => 'AuthController@Social_Media_Login']);
    $router->post('updateOrderStatus/{id}', ['uses' => 'OrderController@update']);
    $router->get('getOrderItems/{id}', ['uses' => 'OrderItemController@getOrderDetailsByOID']);
    
    $router->post('placeOrder', ['uses' => 'CommonController@placeOrder']);
    
    //SecureplaceOrder
    $router->post('SecureplaceOrder', ['uses' => 'CommonController@SecureplaceOrder']);
    
    $router->post('placeOrder1', ['uses' => 'CommonController@placeOrder1']);
    $router->get('deleteAddress/{id}', ['uses' => 'AddressController@delete']);
    $router->post('updateUser/{id}', ['uses' => 'UserController@update']);
    $router->get('getRestaurantsDetails/{id}', ['uses' => 'RestaurantController@getDetail']);
    $router->post('updateDriver/{id}', ['uses' => 'DriverController@update']);
    $router->post('addDriver', ['uses' => 'DriverController@create']);
    $router->get('getDriverById/{id}', ['uses' => 'DriverController@getdataById']);
    $router->get('getDriverByDC/{id}', ['uses' => 'DriverController@getBasedOnDeliveryAssignCode']);
    $router->post('restaurantsDetailUpdate/{id}', ['uses' => 'RestaurantController@update']);
    $router->get('checkContactExists/{number}', ['uses' => 'AuthController@checkContactExists']);
    $router->get('extramenu/{id}', ['uses' => 'ItemDrinkMenuController@showAll']);
    $router->get('getOrders/{id}/{hid}/{status}', ['uses' => 'OrderController@showAllOrdersByUIDANDHID1']);
    $router->get('getAddonCategory', ['uses' => 'CustomizeMasterController@showAll']);
    $router->post('addAddonCategory', ['uses' => 'CustomizeMasterController@create']);
    $router->post('updateAddonCategory/{id}', ['uses' => 'CustomizeMasterController@update']);
    $router->post('deleteAddonCategory/{id}', ['uses' => 'CustomizeMasterController@delete']);
    //AddonItems
    $router->get('getAddonItems/{id}', ['uses' => 'AddonItemsController@basednCatId']);
    $router->post('addAddonItems', ['uses' => 'AddonItemsController@create']);
    $router->post('updateAddonItems/{id}', ['uses' => 'AddonItemsController@update']);
    $router->post('deleteAddonItems/{id}', ['uses' => 'AddonItemsController@delete']);
    //LinkAddonMenuController
    $router->get('getLinkAddonMenu', ['uses' => 'LinkAddonMenuController@showAll']);
    $router->post('addLinkAddonMenu', ['uses' => 'LinkAddonMenuController@create']);
    $router->post('updateLinkAddonMenu/{id}', ['uses' => 'LinkAddonMenuController@update']);
    $router->post('deleteLinkAddonMenu/{id}', ['uses' => 'LinkAddonMenuController@delete']);
    
    
    //LinkAddonMenuController
    $router->get('getDeliveryCharge', ['uses' => 'DeliveryChargeController@showAll']);
    $router->post('addDeliveryCharge', ['uses' => 'DeliveryChargeController@create']);
    $router->post('updateDeliveryCharge/{id}', ['uses' => 'DeliveryChargeController@update']);
    $router->post('deleteDeliveryCharge/{id}', ['uses' => 'DeliveryChargeController@delete']);
     $router->get('getDC/{hid}', ['uses' => 'DeliveryChargeController@getDC']);
    
    // ranjitha started from here
    $router->get('food_item_add_on/{id}', ['uses' => 'ItemDrinkMenuController@foodItemAddOn']);
    $router->post('getHotelIdCategory', ['uses' => 'CustomizeMasterController@getHotelIdCategory']);
    $router->post('hotelinvoice', ['uses' => 'RestaurantController@hotelInvoice']);
    // nearByPopular
    $router->post('nearByPopular', ['uses' => 'RestaurantController@nearByPopular']);
    $router->post('updateToken', ['uses' => 'UserController@updateToken']);
    //CuisinesController
    $router->post('createCuisines', ['uses' => 'CuisinesController@createCuisines']);
    $router->post('updateCuisines/{id}', ['uses' => 'CuisinesController@updateCuisines']);
    $router->post('deleteCuisines/{id}', ['uses' => 'CuisinesController@deleteCuisines']);
    $router->get('selectCuisines', ['uses' => 'CuisinesController@selectCuisines']);
    
    //AddOnMultiSelectController
    $router->post('createaddonmultiselect', ['uses' => 'AddOnMultiSelectController@createaddonmultiselect']);
    $router->post('addonmultiselectBasedOnMenuIdAndHotelId', ['uses' => 'AddOnMultiSelectController@addonmultiselectBasedOnMenuIdAndHotelId']);
    $router->post('addonmultiselectBasedOnHotelId', ['uses' => 'AddOnMultiSelectController@addonmultiselectBasedOnHotelId']);
    $router->post('updateaddonmultiselect/{id}', ['uses' => 'AddOnMultiSelectController@updateAddonmultiSelect']);
    //LinkAddonMenuController
    $router->post('LinkAddOnMenuBasedOnMenuId', ['uses' => 'LinkAddonMenuController@LinkAddOnMenuBasedOnMenuId']);
    $router->post('updatelinkaddonmenu/{id}', ['uses' => 'LinkAddonMenuController@updateLinkAddOnMenu']);
    //RestaurantController
    $router->post('randomSearchByPostalcode', ['uses' => 'RestaurantController@randomSearchByPostalcode']);
    $router->post('searchBasedOnCity', ['uses' => 'RestaurantController@searchBasedOnCity']);
    $router->post('randomSearchByType', ['uses' => 'RestaurantController@randomSearchByType']);
    $router->post('randomSearchByDelivery', ['uses' => 'RestaurantController@randomSearchByDelivery']);
    $router->post('searchBasedOnTake_away', ['uses' => 'RestaurantController@searchBasedOnTake_away']);
    $router->post('searchBasedOnName', ['uses' => 'RestaurantController@searchBasedOnName']);
    //PromotetypeController
    $router->post('createPromoteType', ['uses' => 'PromotetypeController@createPromoteType']);
    $router->post('deletePromoteType/{id}', ['uses' => 'PromotetypeController@deletePromoteType']);
    $router->post('updatePromoteType/{id}', ['uses' => 'PromotetypeController@updatePromoteType']);
    $router->get('selectPromoteType/{id}', ['uses' => 'PromotetypeController@selectPromoteType']);
    //Sub_CategoryController
    $router->post('randomSearchByFood', ['uses' => 'Sub_CategoryController@randomSearchByFood']);
    
    $router->post('mailHotelInvoice', ['uses' => 'CommonController@mailHotelInvoice']);
    $router->post('send_email', ['uses' => 'RestaurantController@send_email_for_hotel_invoice']);
    $router->post('linkaddonbasedonmenuhotelids', ['uses' => 'LinkAddonMenuController@linkaddonbasedonmenuhotelids']);
    $router->post('updateInvoice/{id}', ['uses' => 'RestaurantController@updateInvoice']);
    $router->post('deleteInvoice/{id}', ['uses' => 'RestaurantController@deleteInvoice']);
    
    $router->post('getDetailsBasedOnCatId', ['uses' => 'Sub_CategoryController@getDetailsBasedOnCatId']);
    $router->post('getDetailsBasedOnCatId1', ['uses' => 'Sub_CategoryController@getDetailsBasedOnCatId1']);
    $router->post('orderdetails', ['uses' => 'OrderController@orderdetails']);
     $router->post('orderdetails1', ['uses' => 'OrderController@orderdetails1']);
    $router->post('getOrderdetailsByHotelId', ['uses' => 'OrderController@getOrderdetailsByHotelId']);
    $router->get('getAllOrderDetails', ['uses' => 'OrderController@getAllOrderDetails']);
    $router->get('getAllOrderDetailsnew', ['uses' => 'OrderController@getAllOrderDetailscustomercare']);
    
    $router->get('getAllOrderDetailsLimithundered', ['uses' => 'OrderController@getAllOrderDetailsLimithundered']);
    $router->post('updateRestaurantDiscount/{id}', ['uses' => 'RestaurantController@updateRestaurantDiscount']);
        $router->post('getaddonItem', ['uses' => 'CustomizeMasterController@getaddonItem']);
    $router->post('customizeMasterBasedOnHotelId', ['uses' => 'CustomizeMasterController@customizeMasterBasedOnHotelId']);
    
    
    
    
    //CouponController
       $router->get('getCoupons', ['uses' => 'CouponController@showAll']);
         $router->get('verifyCoupon/{id}/{secKey}/{uid}', ['uses' => 'CouponController@verify']);
          $router->get('getAllCoupons', ['uses' => 'CouponController@getAllcoupons']);
          $router->post('coupon/create', ['uses' => 'CouponController@create']);
          
          $router->get('getmetadata/{id}/{name}', ['uses' => 'CouponController@getmetaData']);
           $router->get('getmetadata/{id}', ['uses' => 'CouponController@getmetaDatah']);
          
          
           $router->get('getEmpLogins', ['uses' => 'EmpLoginController@showAll']);
        //   editEmpLogin
        $router->post('editEmpLogin/{id}', ['uses' => 'EmpLoginController@editEmpLogin']);
        
        
        
        //OpeninghourController
    $router->get('getopeninghours', ['uses' => 'OpeninghourController@showAll']);
    $router->get('getopeninghoursByHotelAndType/{hotel_id}/{type}', ['uses' => 'OpeninghourController@filter']);
    // create
    $router->post('openinghrcreate', ['uses' => 'OpeninghourController@create']);
    $router->post('openinghrupdate/{id}', ['uses' => 'OpeninghourController@update']);
    
    
    
    
    
    //BookingTable
    $router->get('getbookingtablerecords', ['uses' => 'BookingtableController@showAllRestaurants']);
    $router->post('addbookingtablerecords', ['uses' => 'BookingtableController@create']);
    $router->post('updatebookingtablerecords/{id}', ['uses' => 'BookingtableController@update']);
    $router->post('confirmbookingtable/{id}', ['uses' => 'BookingtableController@confirm']);
    //checkavalability
$router->post('checkavalability', ['uses' => 'BookingtableController@checkavalability']);

//OfferCategoryController.php
$router->get('getoffercat', ['uses' => 'OfferCategoryController@all']);
    $router->post('addoffercat', ['uses' => 'OfferCategoryController@create']);
    $router->post('updateoffercat/{id}', ['uses' => 'OfferCategoryController@update']);
    
     $router->get('deals', ['uses' => 'OfferCategoryController@deals']);
    
    //OfferListController.php
$router->get('getofferlist', ['uses' => 'OfferListController@all']);
    $router->post('addofferlist', ['uses' => 'OfferListController@create']);
    $router->post('updateofferlist/{id}', ['uses' => 'OfferListController@update']);
    
    // /basedOnItemOffer
     $router->get('getofferlist/{id}/{hotel_id}', ['uses' => 'OfferListController@basedOnItemOffer']);
     //basedOnItemOfferWithOutItem
     $router->get('getofferlistWithoutItem/{hotel_id}', ['uses' => 'OfferListController@basedOnItemOfferWithOutItem']);
     
     $router->get('getofferlistbasedontotal/{hotel_id}', ['uses' => 'OfferCategoryController@basedOnTotal']);
     
     
 $router->get('getoffermaster', ['uses' => 'OfferMasterController@all']);   
 
  $router->get('offerCatByHotel/{id}', ['uses' => 'OfferCategoryController@offerCatByHotel']);  
     
     
     $router->get('temp', ['uses' => 'CommonController@ss']);
     
    
});


