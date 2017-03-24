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

// Route::get('/' , 'UserController@summary');

Route::get('/newuser', ['as' => 'addnew' , 'uses'=>'UserController@add']);

Route::post('/addnew', 'UserController@addnew1');

Route::get('/user', 'UserController@summary');

Route::get('/edituser/recnum/{recnum}' , ['as' => 'edit_user' , 'uses'=>'UserController@edit']);

Route::post('/update_user', ['as' => 'updateuser' , 'uses'=>  'userController@userupdate']);

Route::get('/deleteuser/recnum/{recnum}', ['as' => 'delete_user' , 'uses'=>  'userController@removeuser']);

Route::get('/' , 'LoginController@index');

Route::post('/loginuser', ['as' => 'checkuser' , 'uses'=>'LoginController@processlogin']);

Route::get('/bom' , 'MasterController@pssummary');

Route::post('/bom' , 'MasterController@pssummary');

Route::get('/bom/data' , 'MasterController@pssummary');

Route::get('/psdetails/recnum/{recnum}' , ['as' => 'ps_details' , 'uses'=>'MasterController@psdetails']);

Route::get('/editps/recnum/{recnum}' , ['as' => 'ps_edit' , 'uses'=>'MasterController@editps']);

Route::get('/copyps/recnum/{recnum}' , ['as' => 'ps_copy' , 'uses'=>'MasterController@copyps']);

Route::post('/submit_psedit', ['as' => 'submit_editps' , 'uses'=>'MasterController@submit_psedit']);

Route::post('/submit_pscopy', ['as' => 'submit_copyps' , 'uses'=>'MasterController@submit_pscopy']);

Route::post('/getallemps', ['as' => 'getallemps' , 'uses'=>'MasterController@getallemps1']);

Route::get('/getallemps' , 'MasterController@getallemps');

Route::get('/logout' , ['as' => 'logout' , 'uses'=>'LoginController@logout']);

Route::get('/newps' , 'MasterController@newps');

Route::post('/submit_psnew', ['as' => 'submit_newps' , 'uses'=>'MasterController@submit_addps']);

Route::get('/printps/recnum/{recnum}' , ['as' => 'ps_print' , 'uses'=>'MasterController@printps']);

Route::post('/checkmrs' , 'MasterController@check_activemrs4ps');

Route::get('/mrs_summary' , 'MasterController@mrs_summary');

Route::post('/mrs_summary' , 'MasterController@mrs_summary');

Route::get('/mrs_summary/data' , 'MasterController@mrs_summary');

Route::get('/mrsdetails/recnum/{recnum}' , ['as' => 'mrs_details' , 'uses'=>'MasterController@mrsdetails']);

Route::get('/newmrs' , 'MasterController@newmrs');

Route::post('/submit_mrsnew', ['as' => 'submit_newmrs' , 'uses'=>'MasterController@submit_addmrs']);

Route::get('/getspec4mrs' , 'MasterController@getspec4mrs');

Route::get('/getps4mrs' , 'MasterController@getps4mrs');

Route::get('/editmrs/recnum/{recnum}' , ['as' => 'mrs_edit' , 'uses'=>'MasterController@editmrs']);

Route::post('/submit_mrsedit', ['as' => 'submit_editmrs' , 'uses'=>'MasterController@submit_mrsedit']);

Route::get('/copymrs/recnum/{recnum}' , ['as' => 'mrs_copy' , 'uses'=>'MasterController@copymrs']);

Route::get('/printmrs/recnum/{recnum}' , ['as' => 'mrs_print' , 'uses'=>'MasterController@printmrs']);

Route::get('/stdmaster_summary' , 'MasterController@std_summary');

Route::post('/stdmaster_summary' , 'MasterController@std_summary');

Route::get('/stdmaster_summary/data' , 'MasterController@std_summary');

Route::get('/edit_std/recnum/{recnum}' , ['as' => 'std_edit' , 'uses'=>'MasterController@edit_stdmaster']);

Route::get('/newstd' , 'MasterController@newstd');

Route::post('/submit_stdnew', ['as' => 'submit_newstd' , 'uses'=>'MasterController@submit_addstd']);

Route::post('/edit_stdmaster', array('uses' => 'MasterController@submit_editstd'));

Route::get('/pinsummary' , 'PinMasterController@pinsummary');

Route::get('/pinsummary/data' , 'MasterController@pinsummary');

Route::post('/pinsummary' , 'PinMasterController@pinsummary');

Route::get('/newpinmaster' , 'PinMasterController@newpinmaster');

Route::post('/submit_masternew', ['as' => 'submit_newmaster' , 'uses'=>'PinMasterController@submit_addmaster']);

Route::get('/getmr' , 'PinMasterController@getmr');

Route::post('/getmr_li4master' , 'PinMasterController@getmr_li4master');

Route::post('/copypin/recnum/getmr_li4master' , 'PinMasterController@getmr_li4master');

Route::get('/pindetails/recnum/{recnum}' , ['as' => 'pin_details' , 'uses'=>'PinMasterController@pindetails']);

Route::get('/editpin/recnum/{recnum}' , ['as' => 'pin_edit' , 'uses'=>'PinMasterController@editpin']);

Route::get('/copypin/recnum/{recnum}' , ['as' => 'pin_copy' , 'uses'=>'PinMasterController@copypin']);

Route::get('/cons_grn' , 'ConsGrnController@consgrn_summary');

Route::get('/cons_grn/data' , 'ConsGrnController@consgrn_summary');

Route::post('/cons_grn' , 'ConsGrnController@consgrn_summary');

Route::get('/custgrn' , 'CustGrnController@custgrn_summary');

Route::get('/custgrn/data' , 'CustGrnController@custgrn_summary');

Route::post('/custgrn' , 'CustGrnController@custgrn_summary');

Route::get('/testmatrix' , 'TM_MasterController@tm_summary');

Route::get('/testmatrix/data' , 'TM_MasterController@tm_summary');

Route::post('/testmatrix' , 'TM_MasterController@tm_summary');

Route::get('/periodic' , 'TM_MasterController@periodic_summary');

Route::get('/periodic/data' , 'TM_MasterController@periodic_summary');

Route::post('/periodic' , 'TM_MasterController@periodic_summary');

Route::get('/requisition' , 'RequisitionController@requisition_summary');

Route::get('/requisition/data' , 'RequisitionController@requisition_summary');

Route::post('/requisition' , 'RequisitionController@requisition_summary');

Route::get('/mfg' , 'MfgController@mfg_summary');

Route::get('/mfg/data' , 'MfgController@mfg_summary');

Route::post('/mfg' , 'MfgController@mfg_summary');

Route::get('/spmfr' , 'QsplController@spmfr_summary');

Route::get('/spmfr/data' , 'QsplController@spmfr_summary');

Route::post('/spmfr' , 'QsplController@spmfr_summary');

Route::get('/spmfrb' , 'QsplController@spmfrb_summary');

Route::get('/spmfrb/data' , 'QsplController@spmfrb_summary');

Route::post('/spmfrb' , 'QsplController@spmfrb_summary');

Route::get('/spmfro' , 'QsplController@spmfro_summary');

Route::get('/spmfro/data' , 'QsplController@spmfro_summary');

Route::post('/spmfro' , 'QsplController@spmfro_summary');

Route::get('/fair' , 'FairController@fair_summary');

Route::get('/fair/data' , 'FairController@fair_summary');

Route::post('/fair' , 'FairController@fair_summary');

Route::get('/nc' , 'NcController@nc_summary');

Route::get('/nc/data' , 'NcController@nc_summary');

Route::post('/nc' , 'NcController@nc_summary');

Route::get('/dispatch' , 'DispatchController@dispatch_summary');

Route::get('/dispatch/data' , 'DispatchController@dispatch_summary');

Route::post('/dispatch' , 'DispatchController@dispatch_summary');

Route::get('/form' , 'FormController@form_summary');

Route::get('/form/data' , 'FormController@form_summary');

Route::post('/form' , 'FormController@form_summary');

Route::get('/accounts' , 'AccountsController@accounts_summary');

Route::get('/accounts/data' , 'AccountsController@accounts_summary');

Route::post('/accounts' , 'AccountsController@accounts_summary');

Route::get('/contacts' , 'AccountsController@contacts_summary');

Route::get('/contacts/data' , 'AccountsController@contacts_summary');

Route::post('/contacts' , 'AccountsController@contacts_summary');

Route::get('/invoice' , 'InvoiceController@invoice_summary');