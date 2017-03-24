<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\PinMaster;
use View;

class PinMasterController extends Controller
{

	public function pinsummary($value='')
	{
		

		$newpin = new PinMaster();
		$rowsPerPage =10;
		if (Input::has("page")) 
		{

			$cim_match = $_GET['cim'];
		    $pin_oper = $_GET['pin_oper'];
		    if ($pin_oper == 'like') {
		        $cim = "'" . $_GET['cim'] . "%" . "'";
		    }
		    else {
		        $cim = "'" . $_GET['cim'] . "'";
		    }
		    $cond0 = "m.CIM_refnum " . $pin_oper . " " . $cim;


		    $cust_match = $_GET['customer'];
		    $cust_oper = $_GET['cust_oper'];
		    if ($cust_oper == 'like') {
		        $customer = "'" . $_GET['customer'] . "%" . "'";
		    }
		    else {
		        $customer = "'" . $_GET['customer'] . "'";
		    }
		    $cond1 = "m.customer " . $cust_oper . " " . $customer;

		    $condition1 = $_GET['condition'];
		   	$sval = $condition1;
		   	if($condition1 == 'All')
		   	{
		      	$cond2 = " m.status IN('Active' ,'Pending', 'Inactive', 'Cancelled')" ;
		  	}
		  	else 
		  	{
		    	$cond2 = " m.status ='$condition1'" ;
		  	}

		  	$mrs_match = $_GET['mrs_num'];
          	$mrs_oper = $_GET['mrs_oper'];
		    if ($mrs_oper == 'like') {
		        $mrs_num = "'" . $_GET['mrs_num'] . "%" . "'";
		    }
		    else {
		        $mrs_num = "'" . $_GET['mrs_num'] . "'";
		    }
		    $cond3 = "m.bomnum " . $mrs_oper . " " . $mrs_num;

		    $cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2. ' and ' . $cond3;


		    $pageNum = $_GET['page'];
			$offset = ($pageNum - 1) * $rowsPerPage;
		}
		else
		{
			if (!empty($_POST)) 
        	{
        		$cim_match = $_POST['cim'];
			    $pin_oper = $_POST['pin_oper'];
			    if ($pin_oper == 'like') {
			        $cim = "'" . $_POST['cim'] . "%" . "'";
			    }
			    else {
			        $cim = "'" . $_POST['cim'] . "'";
			    }
			    $cond0 = "m.CIM_refnum " . $pin_oper . " " . $cim;


			    $cust_match = $_POST['customer'];
			    $cust_oper = $_POST['cust_oper'];
			    if ($cust_oper == 'like') {
			        $customer = "'" . $_POST['customer'] . "%" . "'";
			    }
			    else {
			        $customer = "'" . $_POST['customer'] . "'";
			    }
			    $cond1 = "m.customer " . $cust_oper . " " . $customer;

			    $condition1 = $_POST['condition'];
			   	$sval = $condition1;
			   	if($condition1 == 'All')
			   	{
			      	$cond2 = " m.status IN('Active' ,'Pending', 'Inactive', 'Cancelled')" ;
			  	}
			  	else 
			  	{
			    	$cond2 = " m.status ='$condition1'" ;
			  	}

			  	$mrs_match = $_POST['mrs_num'];
	          	$mrs_oper = $_POST['mrs_oper'];
			    if ($mrs_oper == 'like') {
			        $mrs_num = "'" . $_POST['mrs_num'] . "%" . "'";
			    }
			    else {
			        $mrs_num = "'" . $_POST['mrs_num'] . "'";
			    }
			    $cond3 = "m.bomnum " . $mrs_oper . " " . $mrs_num;

			    $cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2. ' and ' . $cond3;
			    $pageNum = 1;
				$offset = ($pageNum - 1) * $rowsPerPage;
        	}
        	else
        	{
        		$cond0 = "m.CIM_refnum like '%'";
				$cond1 = "m.customer like '%'";
				$cond2 = "m.status IN('Active' ,'Pending', 'Inactive', 'Cancelled')" ;
				$cond3 = "m.bomnum like '%'";

				$cim_match = '';
				$cust_match = '';
				$sval = 'All';
				$mrs_match = '';

				$mrs_oper = "like";
				$pin_oper = "like";
				$cust_oper = "like";

				$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2. ' and ' . $cond3;
				$pageNum = 1;
				$offset = ($pageNum - 1) * $rowsPerPage;
				
        	}
        }
        	
        	$data['results'] = $newpin->getmasterdatas($cond,$offset,$rowsPerPage);
			$data['numrows'] = $newpin->getcrncount($cond);
			$numrows = $data['numrows'][0]->numrows;
			$maxPage = ceil($numrows/$rowsPerPage);
			$data['mrs_oper'] = $mrs_oper;
			$data['pin_oper'] = $pin_oper;
			$data['cust_oper'] = $cust_oper;
			$data['sval'] = $sval;
			$data['cim_match'] = $cim_match;
			$data['cust_match'] = $cust_match;
			$data['mrs_match'] = $mrs_match;



        	if (isset($_GET['page']))
			{
			    $pageNum = $_REQUEST['page'];
			}
			else
			{
				$totpages = $maxPage;
			}
			if (isset($_GET['totpages']))
			{
			    $totpages = $_GET['totpages'];
			}

			if ($pageNum > 1)
			{
			    $data['page'] = $pageNum - 1;
			    $page = $pageNum - 1;
			    $data['prev'] = " <a href=\"test_laravel/pinsummary/?page=$page&totpages=$totpages&cim=$cim_match&pin_oper=$pin_oper&customer=$cust_match&cust_oper=$cust_oper&condition=$sval&mrs_num=$mrs_match&mrs_oper=$mrs_oper\">[Prev]</a>  ";
				$data['first'] = " <a href=\"test_laravel/pinsummary/?page=1&totpages=$totpages&cim=$cim_match&pin_oper=$pin_oper&customer=$cust_match&cust_oper=$cust_oper&condition=$sval&mrs_num=$mrs_match&mrs_oper=$mrs_oper\">[First Page]</a> ";
			}
			else
			{
			    $data['prev']  = ' [Prev] ';      
			    $data['first'] = ' [First Page] ';
			}
			if ($pageNum < $totpages)
			{
			    $page = $pageNum + 1;
			    $data['page'] = $pageNum + 1;
			    $data['next'] = " <a href=\"test_laravel/pinsummary/?page=$page&totpages=$totpages&cim=$cim_match&pin_oper=$pin_oper&customer=$cust_match&cust_oper=$cust_oper&condition=$sval&mrs_num=$mrs_match&mrs_oper=$mrs_oper\">[Next]</a> ";
	    		$data['last'] = " <a href=\"test_laravel/pinsummary/?page=$totpages&totpages=$totpages&cim=$cim_match&pin_oper=$pin_oper&customer=$cust_match&cust_oper=$cust_oper&condition=$sval&mrs_num=$mrs_match&mrs_oper=$mrs_oper\">[Last Page]</a> ";
			}
			else
			{
			    $data['next'] = ' [Next] ';      
			    $data['last'] = ' [Last Page] '; 
			}
			
			$data['pageNum'] = $pageNum;
			$data['totpages'] = $totpages;

			return View::make('pin.pinsummary')->with($data);
	}


	public function newpinmaster($value='')
	{
		$newpin = new PinMaster();
		$data['title'] = "New PS";
		return View::make('pin/new_pinmaster')->with($data);
	}


	public function submit_addmaster(Request $request)
	{
		// $input = $request->all();
		// echo "<pre>";
		// print_r($input); exit;

		$data['userid'] = session('user');
		$data['dept'] = session('department');

		$newpin = new PinMaster();
		$data['CIM_refnum'] = $request->input('CIM_refnum');
		$data['pin_type'] = $request->input('pin_type');
		$data['mrnum'] = $request->input('mrnum');
		$data['mrissue'] = $request->input('mrissue');
		$data['partname'] = $request->input('partname');
		$data['partnum'] = $request->input('partnum');
		$data['project'] = $request->input('project');
		$data['customer'] = $request->input('customer');
		$data['RM_by_CIM'] = $request->input('RM_by_CIM');
		$data['RM_by_customer'] = $request->input('RM_by_customer');
		$data['part_issue'] = $request->input('part_issue');
		$data['attachments'] = $request->input('attachment');
		$data['drawing_num'] = $request->input('drawing_num');
		$data['drg_issue'] = $request->input('drg_issue');
		$data['rm_type'] = $request->input('rm_type');
		$data['rm_spec'] = $request->input('rm_spec');
		$data['cos'] = $request->input('cos');
		$data['part_list'] = $request->input('part_list');
		$data['tech_sheet_no'] = $request->input('tech_sheet_no');
		$data['tech_sheet_issue'] = $request->input('tech_sheet_issue');
		$data['mrrecnum'] = $request->input('mrrecnum');
		$data['model_issue'] = $request->input('model_issue');
		$data['pagename'] = $request->input('pagename');

		if ($data['pagename'] == "newmaster_data") 
		{
			$masterdatarecnum = $newpin->addmaster_data($data);
			// $masterdatarecnum = 2999;
			$results = $newpin->get_tanknxtdue_mrli($data['mrrecnum']);

			if (!empty($results)) 
			{
				$data1['pin_nxtdue'] = $results[0]->earlist_nxtdue;
				$data1['pin_tank_lud'] = $results[0]->tank_lud;
				$data1['pin_tank_freq'] = $results[0]->earlist_analysis_freq;
				$data1['tank_num'] = $results[0]->tank_num;
				$data1['mrrecnum'] = $masterdatarecnum;

				if ($data1['pin_nxtdue'] != "0000-00-00" && $data1['pin_nxtdue'] != "" && $data1['pin_nxtdue'] == NULL) 
				{
					$newpin->update_tanknxtdue_master($data1);
				}
				
			}

			return \Redirect::to('/pinsummary');
		}
		else if($data['pagename'] == "edit_master_data")
		{
			$data['masterdatarecnum'] = $request->input('masterdatarecnum');
			$data['prevstatus'] = $request->input('prevstatus');
			$data['status'] = $request->input('status');
			$data['approved'] = $request->input('approved');
			$data['approved_by'] = $request->input('approved_by');
			$data['ppc_app_date'] = $request->input('ppc_app_date');
			$data['tod_date'] = $request->input('tod_date');
			$data['qa_approved'] = $request->input('qa_approved');
			$data['qa_approved_by'] = $request->input('qa_approved_by');
			$data['qa_app_date'] = $request->input('qa_app_date');
			$data['tod_date1'] = $request->input('tod_date1');
			$data['notes'] = $request->input('notes');

			// echo "<pre>";
			// print_r($data);  exit;
			$newpin->updatemaster_data($data);
			if ($data['notes'] != "") 
			{
				$newpin->addNotes4pin($data);
			}
			
			return redirect()->route('pin_details', ['recnum' => $data['masterdatarecnum']]);
		}
	}

	public function getmr($value='')
	{
		$newpin = new PinMaster();
		$data['mrs'] = $newpin->getrouter_master_number();
		return View::make('pin.getallmrs')->with($data);
	}

	public function getmr_li4master(Request $request)
	{	
		
		$mrrecnum = $request->input('mrnum');
		$newpin = new PinMaster();
		$data['results'] = $newpin->getmaster_routeLI4pin($mrrecnum);
		return View::make('pin.ajax_pinmaster')->with($data);
		

	}

	public function pindetails($recnum)
	{	
		$newpin = new PinMaster();
		$results = $newpin->getmasterdata_details($recnum);
		$data['myrow'] = $results[0];
		$data['userid'] = session('user');
		$data['dept'] = session('department');
		$data['notes'] = $newpin->getNotes4pin($recnum);
		$data['lidetails'] = $newpin->getmaster_routeLI4pin($data['myrow']->link2mr);

		return View::make('pin.pinmaster_details')->with($data);
	}

	public function editpin($recnum)
	{
		$newpin = new PinMaster();
		$results = $newpin->getmasterdata_details($recnum);
		$data['myrow'] = $results[0];
		$data['userid'] = session('user');
		$data['dept'] = session('department');
		$data['linotes'] = $newpin->getNotes4pin($recnum);
		$data['lidetails'] = $newpin->getmaster_routeLI4pin($data['myrow']->link2mr);
		$data['today'] = date('Y-m-d');
		$data['masterdatarecnum'] = $recnum;

		if ($data['myrow']->ppc_app_date != "" && $data['myrow']->ppc_app_date != 'NULL' && $data['myrow']->ppc_app_date != "0000-00-00") 
		{
            $data['date1'] = $data['myrow']->ppc_app_date;

     	}
     	else
      	{
        	$data['date1'] = '';
      	}

     	if ($data['myrow']->qa_app_date  != "" && $data['myrow']->qa_app_date != 'NULL' && $data['myrow']->qa_app_date != "0000-00-00") 
     	{
          	$data['date2'] = $data['myrow']->qa_app_date;
      	}
      	else
      	{
        	$data['date2'] = '';
      	}

		return View::make('pin.editpinmaster')->with($data);
	}

	public function copypin($recnum)
	{
		$newpin = new PinMaster();
		$data['title'] = "New PS";
		$results = $newpin->getmasterdata_details($recnum);
		$data['myrow'] = $results[0];
		$data['userid'] = session('user');
		$data['dept'] = session('department');

		return View::make('pin/copy_pinmaster')->with($data);
	}


}




?>