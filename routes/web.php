<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('/');

Route::get('crons/', 'CronsController@crons')->name('crons');

Route::any('verifyOtp/', 'HomeController@verifyOtp')->name('verifyOtp');
Route::get('/resendOtp/{id}', 'HomeController@resendOtp')->name('resendOtp');

Route::get('/home', 'HomeController@index')->name('home');

// Farmer profile view route
Route::get('/farmer_profile', 'FarmerController@profile')->name('farmer_profile');
Route::get('/farmer_inventory', 'UsersController@inventories')->name('farmer_inventory');

// Trader profile view route
Route::get('/farmer_profile', 'TraderController@profile')->name('farmer_profile');
Route::get('/trader_inventory', 'TraderController@inventories')->name('trader_inventory');

// User profile view route
Route::get('/profile', 'UsersController@profile')->name('profile');

Route::get('/inventories', 'UsersController@inventories')->name('inventories');

Route::post('/get_total_loan_amount', 'UsersController@get_total_loan_amount')->name('get_total_loan_amount');

// Get todays price of this commodity
Route::post('/get_todays_price_by_inventory', 'UsersController@get_todays_price_by_inventory')->name('get_todays_price_by_inventory');

Route::get('/change_password', 'UsersController@change_password')->name('change_password');

Route::get('/user_finance_view', 'UsersController@user_finance_view')->name('user_finance_view');

Route::get('/request_for_loan/{id}', 'UsersController@request_for_loan')->name('request_for_loan');

Route::post('/loan_request', 'UsersController@loan_request')->name('loan_request');
Route::get('/loan_approved/{id}', 'UsersController@loan_approved')->name('loan_approved');
Route::post('/user_agree_for_loan/', 'UsersController@user_agree_for_loan')->name('user_agree_for_loan');

Route::post('/get_todays_price/', 'HomeController@get_todays_price')->name('get_todays_price');

// user update price
Route::post('/buy_sell_price_update', 'UsersController@update_price')->name('buy_sell_price_update');

// Corporate Deal Done
Route::post('/corporate_deal_done', 'UsersController@corporate_deal_done')->name('corporate_deal_done');

Route::get('/notifications', 'UsersController@notifications')->name('notifications');
Route::get('/deals/{status}', 'UsersController@deals')->name('deals');
Route::get('/bidding/{inventory_id}', 'UsersController@bidding')->name('bidding');

// Seller self bid submit
Route::post('/seller_bid', 'UsersController@seller_bid')->name('seller_bid');

// Deal done by seller
Route::get('/deal_done/{inventory_id}', 'UsersController@deal_done')->name('deal_done');

// show all notification
Route::get('/notifications', 'UsersController@notifications')->name('notifications');

//Corporate Buying
Route::get('/corporate_buying/{id}', 'UsersController@corporate_buying')->name('corporate_buying');

/* ***************************************************** */
// Ajax functions in Ajax controller
/* ***************************************************** */

// OTP verification
Route::post('/otpVerification', 'AjaxController@otpVerification')->name('otpVerification');
Route::post('/otpRegisterVerification', 'AjaxController@otpRegisterVerification')->name('otpRegisterVerification');
Route::post('/otpResend', 'AjaxController@otpResend')->name('otpResend');
Route::post('/registerOTPResend', 'AjaxController@registerOTPResend')->name('registerOTPResend');
Route::post('/getWarehouseDistance', 'AjaxController@getWarehouseDistance')->name('getWarehouseDistance');


/* ********************** Admin routes start here *************************** */
/* ************************************************************************** */

// Change password view
Route::get('/change_password_view', 'AdminController@change_password_view')->name('change_password_view');
Route::post('/change_password', 'AdminController@change_password')->name('change_password');

//User Profile on Dashboard
Route::any('/updateProfileImage', 'UsersController@updateProfileImage')->name('updateProfileImage');

// Admin dashboard view route
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::post('/getSalesCSV', 'DashboardController@getSalesCSV')->name('getSalesCSV');

//Facilitiy Master
Route::get('/facilitiy_master', 'AdminController@facilitiy_master')->name('facilitiy_master');
Route::post('/add_facility_master', 'AdminController@add_facility_master')->name('add_facility_master');
Route::get('/facility_master_delete/{id}', 'AdminController@facility_master_delete')->name('facility_master_delete');

// Bank Master
Route::get('/bank_master', 'FinanceController@bank_master')->name('bank_master');
Route::post('/add_bank_master', 'FinanceController@add_bank_master')->name('add_bank_master');
Route::any('/edit_bank_master', 'FinanceController@edit_bank_master')->name('edit_bank_master');
Route::get('/bank_master_delete/{id}', 'FinanceController@bank_master_delete')->name('bank_master_delete');


// User routes
Route::get('/users', 'AdminController@users')->name('users');
Route::get('/add_user_view', 'AdminController@add_user_view')->name('add_user_view');
Route::post('/add_user', 'AdminController@add_user')->name('add_user');
Route::get('/user_view/{user_id}', 'AdminController@user_view')->name('user_view');
Route::get('/user_edit_view/{user_id}', 'AdminController@user_edit_view')->name('user_edit_view');
Route::post('/user_edit', 'AdminController@user_edit')->name('user_edit');
Route::get('/user_delete/{user_id}', 'AdminController@user_delete')->name('user_delete');
Route::post('/create_user_group', 'AdminController@create_user_group')->name('create_user_group');
Route::get('/user_groups', 'AdminController@user_groups')->name('user_groups');
Route::post('/getReferredByUser', 'AdminController@getReferredByUser')->name('getReferredByUser');

// Enquiries Routes
Route::get('/enquiries', 'AdminController@enquiries')->name('enquiries');
Route::get('/approve/{user_id}', 'AdminController@approve')->name('approve');
Route::get('/unapprove/{user_id}', 'AdminController@unapprove')->name('unapprove');

// Admin Dashboard Done Deals and Paymenta
Route::get('/done_deals', 'AdminController@done_deals')->name('done_deals');
Route::any('/add_payment_ref', 'AdminController@add_payment_ref')->name('add_payment_ref');
Route::any('/payment_accept', 'AdminController@payment_accept')->name('payment_accept');
Route::get('/download_vikray_parchi/{id}/{email}', 'AdminController@download_vikray_parchi')->name('download_vikray_parchi');

// Warehouses Routes
Route::get('/warehouses', 'WarehouseController@index')->name('warehouses');
Route::get('/terminal_enquires', 'WarehouseController@terminal_enquires')->name('terminal_enquires');
// Delete terminal enquiry
Route::get('/delete_terminal_enquiry/{enquiry_id}', 'WarehouseController@delete_terminal_enquiry')->name('delete_terminal_enquiry');

Route::get('/add_warehouse_view', 'WarehouseController@add_warehouse_view')->name('add_warehouse_view');
Route::post('/add_warehouse', 'WarehouseController@add_warehouse')->name('add_warehouse');
Route::get('/warehouse_edit_view/{id}', 'WarehouseController@warehouse_edit_view')->name('warehouse_edit_view');
Route::post('/warehouse_edit', 'WarehouseController@warehouse_edit')->name('warehouse_edit');
Route::get('/warehouse_view/{id}', 'WarehouseController@warehouse_view')->name('warehouse_view');
Route::get('/warehouse_delete/{id}', 'WarehouseController@warehouse_delete')->name('warehouse_delete');


// Finance routes
Route::get('/finance', 'FinanceController@index')->name('finance');
Route::get('/request_view/{id}', 'FinanceController@request_view')->name('request_view');
Route::get('/request_response/{id}', 'FinanceController@request_response')->name('request_response');
Route::post('/request_responded', 'FinanceController@request_responded')->name('request_responded');
Route::post('/edit_loan_amount', 'FinanceController@edit_loan_amount')->name('edit_loan_amount');
Route::post('/updateRemainingAmount', 'FinanceController@updateRemainingAmount')->name('updateRemainingAmount');
Route::post('/updateMaxLoanAmount', 'FinanceController@updateMaxLoanAmount')->name('updateMaxLoanAmount');


// Inventory routes
Route::get('/inventory', 'InventoryController@index')->name('inventory');
Route::get('/create_inventory', 'InventoryController@create')->name('create_inventory');
Route::post('/add_inventory', 'InventoryController@add_inventory')->name('add_inventory');
Route::post('/upload_inventory', 'InventoryController@upload_inventory')->name('upload_inventory');
Route::get('/inventory_view/{user_id}/{id}', 'InventoryController@view')->name('inventory_view');

Route::get('/inventory_edit_view/{user_id}/{id}', 'InventoryController@inventory_edit_view')->name('inventory_edit_view');

Route::post('/inventory_edit', 'InventoryController@edit')->name('inventory_edit');

Route::get('/inventory_delete/{id}', 'InventoryController@delete')->name('inventory_delete');

// Items Routes
Route::get('/items', 'ItemsController@index')->name('items');
Route::get('/create_item', 'ItemsController@create_item')->name('create_item');
Route::post('/add_item', 'ItemsController@add_item')->name('add_item');
Route::get('/item_edit_view/{id}', 'ItemsController@view')->name('item_edit_view');
Route::post('/item_edit', 'ItemsController@edit')->name('item_edit');
Route::get('/item_delete/{id}', 'ItemsController@delete')->name('item_delete');

// facilities Routes
Route::get('/facility', 'FacilitiesController@index')->name('facility');
Route::get('/create_facility', 'FacilitiesController@create_facility')->name('create_facility');
Route::post('/add_facility', 'FacilitiesController@add_facility')->name('add_facility');
Route::get('/facility_edit_view/{id}', 'FacilitiesController@view')->name('facility_edit_view');
Route::post('/facility_edit', 'FacilitiesController@edit')->name('facility_edit');
Route::get('/facility_delete/{id}', 'FacilitiesController@delete')->name('facility_delete');

// Category Routes
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/create_category', 'CategoryController@create_category')->name('create_category');
Route::post('/add_category', 'CategoryController@add_category')->name('add_category');
Route::get('/category_edit_view/{id}', 'CategoryController@view')->name('category_edit_view');
Route::post('/edit_category', 'CategoryController@edit_category')->name('edit_category');
Route::get('/category_delete/{id}', 'CategoryController@delete')->name('category_delete');


//buy sell Routes
Route::get('/buy_sell', 'BuySellController@index')->name('buy_sell');
Route::get('/buy_sell_view/{id}', 'BuySellController@view')->name('buy_sell_view');
Route::post('/purchasing', 'BuySellController@purchasing')->name('purchasing');

//Website Pages
Route::get('/privacy-policy', 'HomeController@privacy_policy')->name('privacy-policy');
Route::get('/terms-conditions', 'HomeController@terms_conditions')->name('terms-conditions');
Route::get('/about-us', 'HomeController@about_us')->name('about-us');
Route::get('/terminal_view/{id}', 'HomeController@terminal_view')->name('terminal_view');
Route::get('/our-team', 'HomeController@our_team')->name('our-team');
Route::get('/qualiity-variance-calculator', 'HomeController@qualiity_variance_calculator')->name('qualiity-variance-calculator');
Route::get('/terminals', 'HomeController@our_warehoue')->name('terminals');
Route::get('/contact-us', 'HomeController@contact_us')->name('contact-us');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::post('/warehouse_enquiry', 'HomeController@warehouse_enquiry')->name('warehouse_enquiry');


// Login Register Registration Farmer
Route::get('/farmer_login', 'HomeController@farmer_login')->name('farmer_login');
Route::get('/farmer_register', 'HomeController@farmer_register')->name('farmer_register');
Route::get('/checkRegisterOTP', 'HomeController@checkRegisterOTP')->name('checkRegisterOTP');
Route::post('/farmer_registration', 'HomeController@farmer_registration')->name('farmer_registration');
Route::post('/registerLogin', 'HomeController@registerLogin')->name('registerLogin');

// Login Register Registration Trader
Route::get('/trader_login', 'HomeController@trader_login')->name('trader_login');
Route::get('/trader_register', 'HomeController@trader_register')->name('trader_register');
Route::post('/trader_registration', 'HomeController@trader_registration')->name('trader_registration');

// Mandi place Name
Route::get('/mandi_place_name', 'CommodityController@index')->name('mandi_place_name');
Route::get('/create_mandi', 'CommodityController@create_mandi')->name('create_mandi');
Route::post('/add_mandi', 'CommodityController@add_mandi')->name('add_mandi');
Route::get('/mandi_edit_view/{id}', 'CommodityController@view')->name('mandi_edit_view');
Route::post('/mandi_edit', 'CommodityController@edit')->name('mandi_edit');
Route::get('/mandi_delete/{id}', 'CommodityController@delete')->name('mandi_delete');

// Commodity Name
Route::get('/commodity_name', 'CommodityController@commodity_index')->name('commodity_name');
Route::get('/create_commodity', 'CommodityController@create_commodity')->name('create_commodity');
Route::post('/add_commodity', 'CommodityController@add_commodity')->name('add_commodity');
Route::get('/commodity_edit_view/{id}', 'CommodityController@commodity_view')->name('commodity_edit_view');
Route::post('/commodity_edit', 'CommodityController@commodity_edit')->name('commodity_edit');
Route::get('/commodity_delete/{id}', 'CommodityController@commodity_delete')->name('commodity_delete');

// Today's Price
Route::get('/today_price', 'CommodityController@today_price')->name('today_price');
Route::get('/create_today', 'CommodityController@create_today')->name('create_today');
Route::post('/add_today', 'CommodityController@add_today')->name('add_today');
Route::get('/today_price_edit_view/{id}', 'CommodityController@today_view')->name('today_price_edit_view');
Route::post('/today_price_edit/', 'CommodityController@today_edit')->name('today_price_edit');
Route::get('/today_price_delete/{id}', 'CommodityController@today_delete')->name('today_price_delete');

// Corporate Pricing
Route::post('/getCorporateDetails', 'CommodityController@getCorporateDetails')->name('getCorporateDetails');
Route::post('/updateCorporatePrice', 'CommodityController@updateCorporatePrice')->name('updateCorporatePrice');

// Users otp page
Route::get('/users_otp', 'AdminController@users_otp')->name('users_otp');

// Mandi samitis view
Route::get('/mandi_samiti', 'AdminController@mandi_samiti')->name('mandi_samiti');

// Mandi samitis Edit / Update
Route::post('/update_mandi_samiti/', 'AdminController@update_mandi_samiti')->name('update_mandi_samiti');
Route::get('/edit_mandi_samiti/{id}', 'AdminController@edit_mandi_samiti')->name('edit_mandi_samiti');

// Add mandi samiti page
Route::get('/add_mandi_samiti', 'AdminController@add_mandi_samiti')->name('add_mandi_samiti');

// Add new mandi samiti
Route::post('/create_mandi_samiti', 'AdminController@create_mandi_samiti')->name('create_mandi_samiti');

// Delete mandi samiti
Route::get('/delete_mandi_samiti/{id}', 'AdminController@delete_mandi_samiti')->name('delete_mandi_samiti');



/*************************************************************************************/
/*************************************************************************************/
/********************* Management Information System Routes **************************/
/*************************************************************************************/
/*************************************************************************************/

Route::get('/employees', 'MisController@index')->name('employees');
Route::post('/getEmp', 'MisController@getEmp')->name('getEmp');
Route::post('/addEmployee', 'MisController@addEmployee')->name('addEmployee');
Route::post('/updateEmployee', 'MisController@updateEmployee')->name('updateEmployee');
Route::get('/deleteEmployee/{id}', 'MisController@deleteEmployee')->name('deleteEmployee');

Route::get('/leads', 'LeadController@index')->name('leads');
Route::post('/get_lead', 'LeadController@get_lead')->name('get_lead');
Route::post('/createLead', 'LeadController@create')->name('createLead');
Route::post('/update_lead', 'LeadController@update_lead')->name('update_lead');

Route::get('/caseGen', 'CaseGenController@index')->name('caseGen');
Route::post('/getLeadGenRec', 'CaseGenController@getLeadGenRec')->name('getLeadGenRec');
Route::post('/createCase', 'CaseGenController@createCase')->name('createCase');

Route::get('/approvalCasesPass', 'CaseGenController@approvalCasesPass')->name('approvalCasesPass');
Route::get('/approvalCasesIn', 'CaseGenController@approvalCasesIn')->name('approvalCasesIn');
Route::get('/approvalCasesOut', 'CaseGenController@approvalCasesOut')->name('approvalCasesOut');

Route::get('/casesStatusPass', 'CaseGenController@casesStatusPass')->name('casesStatusPass');
Route::get('/casesStatusIn', 'CaseGenController@casesStatusIn')->name('casesStatusIn');
Route::get('/casesStatusOut', 'CaseGenController@casesStatusOut')->name('casesStatusOut');

Route::get('/completedCases', 'CaseGenController@completedCases')->name('completedCases');
Route::get('/cancelledCases', 'CaseGenController@cancelledCases')->name('cancelledCases');

Route::any('/emp-profile/{id}', 'MisController@emp_profile')->name('emp-profile');
Route::any('/getDistrict', 'HomeController@getDistrict')->name('getDistrict');

Route::get('/pricing', 'CaseGenController@pricing')->name('pricing');
Route::post('/addPrice', 'CaseGenController@addPrice')->name('addPrice');
Route::get('/close_case/{id}', 'CaseGenController@close_case')->name('close_case');

Route::get('/quality_report', 'CaseGenController@quality_report')->name('quality_report');
Route::post('/addQualityReport', 'CaseGenController@addQualityReport')->name('addQualityReport');

Route::get('/gate_pass', 'CaseGenController@gate_pass')->name('gate_pass');
Route::post('/addGatePass', 'CaseGenController@addGatePass')->name('addGatePass');

Route::get('/kanta_parchi', 'CaseGenController@kanta_parchi')->name('kanta_parchi');
Route::post('/addKantaParchi', 'CaseGenController@addKantaParchi')->name('addKantaParchi');

Route::get('/truck_book', 'CaseGenController@truck_book')->name('truck_book');
Route::post('/addTruckBook', 'CaseGenController@addTruckBook')->name('addTruckBook');

Route::get('/labour_book', 'CaseGenController@labour_book')->name('labour_book');
Route::post('/addLabourBook', 'CaseGenController@addLabourBook')->name('addLabourBook');

Route::get('/second_quality_report', 'CaseGenController@second_quality_report')->name('second_quality_report');
Route::post('/addSecondQualityReport', 'CaseGenController@addSecondQualityReport')->name('addSecondQualityReport');

Route::get('/second_kanta_parchi', 'CaseGenController@second_kanta_parchi')->name('second_kanta_parchi');
Route::post('/addSecondKantaParchi', 'CaseGenController@addSecondKantaParchi')->name('addSecondKantaParchi');

Route::get('/e_mandi', 'CaseGenController@e_mandi')->name('e_mandi');
Route::post('/addEmandi', 'CaseGenController@addEmandi')->name('addEmandi');

Route::get('/accounts', 'CaseGenController@accounts')->name('accounts');
Route::post('/addAccounts', 'CaseGenController@addAccounts')->name('addAccounts');

Route::get('/shipping_start', 'CaseGenController@shipping_start')->name('shipping_start');
Route::post('/addShippingStart', 'CaseGenController@addShippingStart')->name('addShippingStart');

Route::get('/shipping_end', 'CaseGenController@shipping_end')->name('shipping_end');
Route::post('/addShippingEnd', 'CaseGenController@addShippingEnd')->name('addShippingEnd');

Route::get('/quality_claim', 'CaseGenController@quality_claim')->name('quality_claim');
Route::post('/addQualityClaim', 'CaseGenController@addQualityClaim')->name('addQualityClaim');

Route::get('/truck_payment', 'CaseGenController@truck_payment')->name('truck_payment');
Route::post('/addTruckPayment', 'CaseGenController@addTruckPayment')->name('addTruckPayment');

Route::get('/labour_payment', 'CaseGenController@labour_payment')->name('labour_payment');
Route::post('/addLabourPayment', 'CaseGenController@addLabourPayment')->name('addLabourPayment');

Route::get('/payment_received', 'CaseGenController@payment_received')->name('payment_received');
Route::post('/addPaymentReceived', 'CaseGenController@addPaymentReceived')->name('addPaymentReceived');

Route::get('/cctv', 'CaseGenController@cctv')->name('cctv');
Route::post('/addCCTV', 'CaseGenController@addCCTV')->name('addCCTV');

Route::get('/commodity_deposit', 'CaseGenController@commodity_deposit')->name('commodity_deposit');
Route::post('/addCommodityDeposit', 'CaseGenController@addCommodityDeposit')->name('addCommodityDeposit');

Route::get('/warehouse_receipt', 'CaseGenController@warehouse_receipt')->name('warehouse_receipt');
Route::post('/addWarehouseReceipt', 'CaseGenController@addWarehouseReceipt')->name('addWarehouseReceipt');

Route::get('/storage_receipt', 'CaseGenController@storage_receipt')->name('storage_receipt');
Route::post('/addStorageReceipt', 'CaseGenController@addStorageReceipt')->name('addStorageReceipt');

Route::get('/release_order', 'CaseGenController@release_order')->name('release_order');
Route::post('/addReleaseOrder', 'CaseGenController@addReleaseOrder')->name('addReleaseOrder');

Route::get('/delivery_order', 'CaseGenController@delivery_order')->name('delivery_order');
Route::post('/addDeliveryOrder', 'CaseGenController@addDeliveryOrder')->name('addDeliveryOrder');

Route::get('/commodity_withdrawal', 'CaseGenController@commodity_withdrawal')->name('commodity_withdrawal');
Route::post('/addCommodityWithdrawal', 'CaseGenController@addCommodityWithdrawal')->name('addCommodityWithdrawal');

Route::post('/caseApprove', 'CaseGenController@caseApprove')->name('caseApprove');
Route::get('/viewCase/{case_id}', 'CaseGenController@viewCase')->name('viewCase');


/*************************************************************************************/
/*********************************  User Permissions *********************************/
/*************************************************************************************/

Route::get('/user_permissions', 'MisController@user_permissions')->name('user_permissions');
Route::post('/add_user_permission', 'MisController@add_user_permission')->name('add_user_permission');