<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\ProcessSheet;
use App\Http\Models\TestMatrix;
use App\Http\Models\MasterRoute;
use App\Http\Models\StdMaster;
use View;

class MasterController extends Controller
{
	public function pssummary($value='')
	{
		$newps = new ProcessSheet();

		$rowsPerPage =10;

		if (Input::has("page")) 
		{
            $data = Input::all();
            $bom_match = $_GET['bom'];
	        if ( isset ( $_GET['oper'] ) ) 
	        {
	          $oper = $_GET['oper'];
	        }
	        if ($oper == 'like') 
	        {
	          $bom = "'" . $_GET['bom'] . "%" . "'";
	        }
	        else 
	        {
	          $bom = "'" . $_GET['bom'] . "'";
	        }

	       	$cond0 = "b.bomnum" . " " . $oper . " " . $bom;  

	        $condition1 = $_GET['condition'];
		  	$sval = $condition1;
			if($condition1 == 'All')
			{
			   $cond1 = " b.status IN('Active' ,'Pending', 'Inactive', 'Cancelled')" ;
			}
			else 
			{
				$cond1 = " b.status ='$condition1'" ;
		  	}
	      	
	      	$oper = $_GET['oper'];
	      	$cond = $cond0 . ' and ' . $cond1 ;
	      	$pageNum = $_REQUEST['page'];
			$offset = ($pageNum - 1) * $rowsPerPage;

        }
        else
        {
        	
        	if (!empty($_POST)) 
        	{
				$bom_match = $_POST['bom'];
		        if ( isset ( $_POST['oper'] ) ) 
		        {
		          $oper = $_POST['oper'];
		        }
		        if ($oper == 'like') 
		        {
		          $bom = "'" . $_POST['bom'] . "%" . "'";
		        }
		        else 
		        {
		          $bom = "'" . $_POST['bom'] . "'";
		        }

		       	$cond0 = "b.bomnum" . " " . $oper . " " . $bom;  

		        $condition1 = $_POST['condition'];
			  	$sval = $condition1;

				if($condition1 == 'All')
				{
				   $cond1 = " b.status IN('Active' ,'Pending', 'Inactive', 'Cancelled')" ;
				}
				else 
				{
					$cond1 = " b.status ='$condition1'" ;
			  	}
		      	
		      	$oper = $_POST['oper'];
		      	$cond = $cond0 . ' and ' . $cond1 ;

		      	$pageNum = 1;
				$offset = ($pageNum - 1) * $rowsPerPage;
			}
			else
			{
				$bom_match = '';
				$oper = "like";
				$cond0 = "b.bomnum like'%'";
				$cond1 = " b.status IN('Active' ,'Pending', 'Inactive')" ;
				$sval = "All";

				$cond = $cond0 . ' and ' . $cond1 ;
				$pageNum = 1;
				$offset = ($pageNum - 1) * $rowsPerPage;
			}
        }

		


		$data['results'] = $newps->getps_summary($cond,$offset,$rowsPerPage);
		foreach ($data['results'] as $key => $value) {
			$d=substr($value->bomdate,8,2);
            $m=substr($value->bomdate,5,2);
            $y=substr($value->bomdate,0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $psdate=date("M j, Y",$x);
			$data['results'][$key]->psdate = $psdate;
		}

		$data['numrows'] = $newps->getPScount($cond,$offset,$rowsPerPage);
		$numrows = $data['numrows'][0]->numrows;
		$maxPage = ceil($numrows/$rowsPerPage);
		$data['oper'] = $oper;
		$data['sval'] = $sval;
		$data['bom'] = $bom_match;
		
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
		    $data['prev'] = " <a href=\"test_laravel/bom/?page=$page&totpages=$totpages&bom=$bom_match&oper=$oper&condition=$sval\">[Prev]</a> ";
			$data['first'] = " <a href=\"test_laravel/bom/?page=1&totpages=$totpages&bom=$bom_match&oper=$oper&condition=$sval\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/bom/?page=$page&totpages=$totpages&bom=$bom_match&oper=$oper&condition=$sval\">[Next]</a> ";
    		$data['last'] = "<a href=\"test_laravel/bom/?page=$totpages&totpages=$totpages&bom=$bom_match&oper=$oper&condition=$sval\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;
		
		return View::make('process_sheet.ps')->with($data);
	}

	public function psdetails($recnum)
	{
		$newps = new ProcessSheet();
		$data['details'] = $newps->getPSDetails($recnum);
		$data['lidetails'] = $newps->getPS_LiDetails($recnum);
		$data['linotes'] = $newps->getNotes4ps($recnum);   
		return View::make('process_sheet.psDetails')->with($data);
	}

	public function editps($recnum)
	{	
		$newps = new ProcessSheet();
		$data['details'] = $newps->getPSDetails($recnum);
		$data['lidetails'] = $newps->getPS_LiDetails($recnum);
		$data['linotes'] = $newps->getNotes4ps($recnum);
		$data['list_tanks'] = $newps->gettanknum4ps();

		return View::make('process_sheet.edit_ps')->with($data);
		
	}

	public function copyps($recnum)
	{
		$newps = new ProcessSheet();
		$data['details'] = $newps->getPSDetails($recnum);
		$data['lidetails'] = $newps->getPS_LiDetails($recnum);
		$data['list_tanks'] = $newps->gettanknum4ps();

		return View::make('process_sheet.copy_ps')->with($data);
	}

	public function submit_psedit(Request $request)
	{
		$input = $request->all();
		$newps = new ProcessSheet();
		
		$data['bomnum'] = $request->input('bomnum');
		$data['type'] = $request->input('type');
		$data['desc'] = $request->input('desc');
		$data['bomdate'] = $request->input('bomdate');
		$data['status'] = $request->input('status');
		$data['quoterecnum'] = $request->input('quoterecnum');
		$data['companyrecnum'] = $request->input('companyrecnum');
		$data['serecnum'] = $request->input('serecnum');
		$data['issue'] = $request->input('issue');

		$data['approved'] = $request->input('approved');
		$data['approved_by'] = $request->input('approved_by');
		$data['app_date'] = $request->input('app_date');
		$data['qa_approved'] = $request->input('qa_approved');
		$data['qa_approved_by'] = $request->input('qa_approved_by');
		$data['qa_app_date'] = $request->input('qa_app_date');
		$data['bomrecnum'] = $request->input('bomrecnum');

		$newps->updateBom($data);

		$notes = $request->input('notes');
		if ($notes != "") 
		{
			$newps->addNotes4ps($data['bomrecnum'], $notes);
		}
		
        $i = 1;
        $max = $request->input('index');

        $input = $request->all();
        while ($i < $max) {
        	$linenumber="linenum" . $i;
	        $prevlinenumber="prevlinenum" . $i;
	        $itemname="itemname" . $i;
	      	$lirecnum="lirecnum" . $i;
	        $itemdesc="itemdesc" . $i;
	        $value="value" . $i;
	        $comments="comments" . $i;
	        $vendrecnum="vendrecnum" . $i;
	        $partrecnum="partrecnum" . $i;
	        $workcenter="workcenter" . $i;
	        $optemp_min="optemp_min" . $i;
	        $optemp_max="optemp_max" . $i;               
	        $qty_check="qty_check" . $i;                
	        $paint_check="paint_check" . $i;                
	        $time_check="time_check" . $i;  
	        $form2="form2" . $i;
	        $ps_tanknum="ps_tanknum" . $i;

	        $data1['linenumber'] = $request->input($linenumber);
	        $data1['prevlinenum'] = $request->input($prevlinenumber);
	        $data1['itemname'] = $request->input($itemname);
	        $data1['lirecnum'] = $request->input($lirecnum);
	        $data1['itemdesc'] = $request->input($itemdesc);
	        $data1['value'] = $request->input($value);
	        $data1['comments'] = $request->input($comments);
	        $data1['vendrecnum'] = $request->input($vendrecnum);
	        $data1['partrecnum'] = $request->input($partrecnum);
	        $data1['workcenter'] = $request->input($workcenter);
	        $data1['optemp_min'] = $request->input($optemp_min);
	        $data1['optemp_max'] = $request->input($optemp_max);
	        $data1['qty_check'] = $request->input($qty_check);
	        $data1['paint_check'] = $request->input($paint_check);
	        $data1['time_check'] = $request->input($time_check);
	        $data1['form2'] = $request->input($form2);
	        $data1['ps_tanknum'] = $request->input($ps_tanknum);
	        $data1['bomrecnum'] = $request->input('bomrecnum');

	        if($data1['prevlinenum'] !='')
			{
				if ($data1['linenumber'] != '')
				{
			  		$newps->updateLI($data1);
			  	}
			  	else
			  	{	
			  		$newps->deleteLI($data1['lirecnum']);
			  	}
			}
			else
			{
				$newps->addLI($data1);
			}

        	$i++;
        }

		return redirect()->route('ps_details', ['recnum' => $data['bomrecnum']]);
	}

	public function submit_pscopy(Request $request)
	{	
		$input = $request->all();
		echo "<pre>";
		print_r($input); exit;
	}

	public function getallemps()
	{
		
		$newps = new ProcessSheet();
		$data['emps'] = $newps->getAllEmps();
		return View::make('process_sheet.getallemps')->with($data);
	}

	public function newps()
	{	
		$newps = new ProcessSheet();
		$data['title'] = "New PS";
		$data['list_tanks'] = $newps->gettanknum4ps();
		return View::make('process_sheet/new_ps')->with($data);
	}

	public function submit_addps(Request $request)
	{
		$input = $request->all();
		$newps = new ProcessSheet();
		$newtm = new TestMatrix();

		$data['bomnum'] = $request->input('bomnum');
		$data['type'] = $request->input('type');
		$data['desc'] = $request->input('desc');
		$data['bomdate'] = $request->input('bomdate');
		$data['serecnum'] = $request->input('serecnum');
		$data['issue'] = $request->input('issue');
		$data['pagename'] = $request->input('pagename');
		$max = $request->input('index');

		$bomrecnum = $newps->addBOM($data);
		
		$notes = $request->input('notes');
		if ($notes != "") 
		{
			$newps->addNotes4ps($bomrecnum, $notes);
		}
		
		$least_nxtdue = "0000-00-00";

		$i = 1;
		while ( $i < $max) {
			$linenumber="linenum" . $i;
	        $itemdesc="itemdesc" . $i;
	        $itemname="itemname" . $i;
	        $value="value" . $i;
	        $ps_tanknum="ps_tanknum" . $i;
	        $comments="comments" . $i;
	        $optemp_min="optemp_min" . $i;
	        $optemp_max="optemp_max" . $i;
	        $workcenter="workcenter" . $i;
	        $qty_check = "qty_check" . $i;
	        $paint_check = "paint_check" . $i;
	        $time_check = "time_check" . $i;
	        $form2 = "form2_" . $i;

	        $data1['linenumber'] = $request->input($linenumber);
	        $data1['itemname'] = $request->input($itemname);
	        $data1['itemdesc'] = $request->input($itemdesc);
	        $data1['value'] = $request->input($value);
	        $data1['comments'] = $request->input($comments);
	        $data1['workcenter'] = $request->input($workcenter);
	        $data1['optemp_min'] = $request->input($optemp_min);
	        $data1['optemp_max'] = $request->input($optemp_max);
	        $data1['qty_check'] = $request->input($qty_check);
	        $data1['paint_check'] = $request->input($paint_check);
	        $data1['time_check'] = $request->input($time_check);
	        $data1['form2'] = $request->input($form2);
	        $data1['ps_tanknum'] = $request->input($ps_tanknum);
	        $data1['bomrecnum'] = $bomrecnum;

	        if ($data1['linenumber'] != "") 
	        {
	        	$bomli_recnum = $newps->addLI($data1);
	        	
	        	if ($data1['value'] != "") {
	        		
	        		$tank_val = preg_replace("/[^0-9]/", '', $data1['value']);

	        		if (!empty($tank_val)) {


		        		$tanknxtdueli = $newtm->get_earlist_nxtdue4bom($tank_val);

		        		if (!empty($tanknxtdueli)) 
		   				{
		   					$l2tmatrix = $tanknxtdueli[0]->link2testmatrix;
		   					$tank_lud = $newtm->get_tankdatalud($l2tmatrix);


		   					$tk['tank_freq'] = $tanknxtdueli[0]->analysis_freq;
					    	$tk['tank_reminder'] = $tanknxtdueli[0]->reminder;
					    	$tk['last_update_date'] = $tank_lud[0]->created_date;

					    	if($tank_lud[0]->created_date != '' || $tank_lud[0]->created_date != NULL) {
					    		
					    		$newtm->update_nxtdue4bomli($bomli_recnum, $tk);
					    	}


					    	if ($least_nxtdue == "0000-00-00") 
			    		 	{

				    		 	$newtm->update_nxtdue4bom($bomrecnum, $tk, $tank_val);
				    		 	$least_nxtdue = $tk['tank_reminder'];
				    		 	
			    		 	}
			    		 	else
			    		 	{
			    		 		if ($tk['tank_reminder'] != "" || $tk['tank_reminder'] != "null" || $tk['tank_reminder'] != null) 
				    		 	{

				    		 		if ($least_nxtdue > $tk['tank_reminder']) 
					    		 	{
					    		 		$newtm->update_nxtdue4bom($bomrecnum, $tk, $tank_val);
					    		 		$least_nxtdue = $tk['tank_reminder'];
					    		 	}
					    		}
			    		 	}

		   				}
		   			}
	        	}
	        }

	        $i++;
		}
		return \Redirect::to('/bom');
	}

	public function check_activemrs4ps(Request $request)
	{
		

		$newps = new ProcessSheet();
		$data['psnum'] = $request->input('psnum');
		$data['issue'] = $request->input('issue');
		$mrsarr = array();

		$result = $newps->check_activemrs_ps($data);

		foreach ($result as $key => $value) {
			if (!empty($value)) 
			{
				$mrsarr[] = $value->doc_id.'('.$value->issue.')';
			}
		}

		if (!empty($mrsarr)) 
		{
			$active_mrs = implode(',', $mrsarr);

			echo "This ". $data['psnum'].'('.$data['issue'] .')' . " Using Below MRS. Inactive Below MRS.\n" .$active_mrs; exit;
		}
		else 
		{
			echo "success"; exit;
		}

	}

	public function printps($recnum)
	{
		$newps = new ProcessSheet();
		$data['details'] = $newps->getPSDetails($recnum);
		$data['lidetails'] = $newps->getPS_LiDetails($recnum);
		$data['linotes'] = $newps->getNotes4ps($recnum);   

		return View::make('process_sheet.psprint')->with($data);
	}

	public function mrs_summary($value='')
	{
		$rowsPerPage = 15;
		$newRoute = new MasterRoute();

		if (Input::has("page")) 
		{
			$data = Input::all();

			$oper1 = $_GET['oper'];
    		$doc_id = $_GET['doc_id'];
    		$docid_match = $_GET['doc_id'];
    		$oper2 = $_GET['cust_oper'];
    		$customer = $_GET['customer'];
    		$cust_match = $_GET['customer'];
    		$condition = $_GET['condition'];
    		$sval = $_GET['condition'];

    		if ($oper1 == 'like') 
    		{
		        $doc_id = "'" . $_GET['doc_id'] . "%" . "'";
		    }
		    else 
		    {
		        $doc_id = "'" . $_GET['doc_id'] . "'";
		    }
		    $cond0 = "doc_id " . $oper1 . " " . $doc_id;

		    if ($oper2 == 'like') 
		    {
		        $customer = "'" . $_GET['customer'] . "%" . "'";
		    }
		    else
		    {
		        $customer = "'" . $_GET['customer'] . "'";
		    }
		    $cond1 = "customer " . $oper2 . " " . $customer;

		    if($condition == 'All')
			{
			   $cond2 = " status IN('Active' ,'Pending', 'Inactive',  'Cancelled')" ;
			}
			else 
			{
			 	$cond2 = " status ='$condition'" ;
			}

			$pageNum = $_REQUEST['page'];
			$offset = ($pageNum - 1) * $rowsPerPage;
			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 ;
		}
		else
		{
			if (!empty($_POST)) 
        	{
        		$oper1 = $_POST['oper'];
        		$doc_id = $_POST['doc_id'];
        		$docid_match = $_POST['doc_id'];
        		$oper2 = $_POST['cust_oper'];
        		$customer = $_POST['customer'];
        		$cust_match = $_POST['customer'];
        		$condition = $_POST['condition'];
        		$sval = $_POST['condition'];

        		if ($oper1 == 'like') 
        		{
			        $doc_id = "'" . $_POST['doc_id'] . "%" . "'";
			    }
			    else 
			    {
			        $doc_id = "'" . $_POST['doc_id'] . "'";
			    }
			    $cond0 = "doc_id " . $oper1 . " " . $doc_id;

			    if ($oper2 == 'like') 
			    {
			        $customer = "'" . $_POST['customer'] . "%" . "'";
			    }
			    else
			    {
			        $customer = "'" . $_POST['customer'] . "'";
			    }
			    $cond1 = "customer " . $oper2 . " " . $customer;

			    if($condition == 'All')
				{
				   $cond2 = " status IN('Active' ,'Pending', 'Inactive',  'Cancelled')" ;
				}
				else 
				{
				 	$cond2 = " status ='$condition'" ;
				}

				$pageNum = 1;
				$offset = ($pageNum - 1) * $rowsPerPage;
				$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 ;
        	}
        	else
        	{
        		$pageNum = 1;
		   		$offset = ($pageNum - 1)  * $rowsPerPage;
				$docid_match = '';
				$cust_match = '';
				$sval = "All";
				$oper1 = "like";
				$oper2 = "like";
				$cond0 = "doc_id like '%'";
				$cond1 = "customer like '%'";
				$cond2 = " status IN('Active' ,'Pending', 'Inactive')" ;
		   		$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 ;
        	}
		}

		// echo "cond $cond  <br>"; exit;

   		$data['results'] = $newRoute->getroutemaster_summary($cond,$offset,$rowsPerPage);
   		$data['numrows'] = $newRoute->getroutemaster_count($cond);
   		$numrows = $data['numrows'][0]->numrows;
		$maxPage = ceil($numrows/$rowsPerPage);
		$data['oper'] = $oper1;
		$data['cust_oper'] = $oper2;
		$data['sval'] = $sval;
		$data['docid_match'] = $docid_match;
		$data['cust_match'] = $cust_match;
		
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
		    $data['prev'] = " <a href=\"test_laravel/mrs_summary/?page=$page&totpages=$totpages&doc_id=$docid_match&customer=$cust_match&oper=$oper1&cust_oper=$oper2&condition=$sval\">[Prev]</a> ";
			$data['first'] = " <a href=\"test_laravel/mrs_summary/?page=1&totpages=$totpages&doc_id=$docid_match&customer=$cust_match&oper=$oper1&cust_oper=$oper2&condition=$sval\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/mrs_summary/?page=$page&totpages=$totpages&doc_id=$docid_match&customer=$cust_match&oper=$oper1&cust_oper=$oper2&condition=$sval\">[Next]</a> ";
    		$data['last'] = "<a href=\"test_laravel/mrs_summary/?page=$totpages&totpages=$totpages&doc_id=$docid_match&customer=$cust_match&oper=$oper1&cust_oper=$oper2&condition=$sval\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

   		return View::make('mrs.mrs')->with($data);
	}

	public function mrsdetails($recnum)
	{
		$newRoute = new MasterRoute();
		$data['details'] = $newRoute->getmasterroute_details($recnum);
		$data['lidetails'] = $newRoute->getmaster_routeLI($recnum);
		$data['linotes'] = $newRoute->getNotes4mrs($recnum);   
		$data['rev_his'] = $newRoute->getmr_rev_history($recnum);   
		return View::make('mrs.mrsDetails')->with($data);
	}

	public function newmrs($value='')
	{
		$data['title'] = "New MRS";
		return View::make('mrs.new_mrs')->with($data);
	}

	public function submit_addmrs(Request $request)
	{
		$input = $request->all();

		$newRoute = new MasterRoute();
		$data['doc_id'] = $request->input('doc_id'); 
		$data['issue'] = $request->input('issue');
		$data['customer'] = $request->input('customer');
		$data['date'] = $request->input('date');
		$data['scope'] = $request->input('scope');
		$data['response'] = $request->input('response');
		$data['reference'] = $request->input('reference');
		$data['notes'] = $request->input('notes');

		$mrp_recnum = $newRoute->addmaster_routing($data);
		

		if($data['notes'] != "") 
		{
			$newRoute->addNotes4mrs($mrp_recnum, $data['notes']);
		}

		$i = 1;
		$max = $_REQUEST['index'];

		$earlist_nxtdue4mrs = "";
		while ($i < $max) 
		{
			$linenum = "line_num". $i;
			$op_no = "op_no". $i;
			$desc = "desc". $i;
			$ps_no = "ps_no". $i;
			$spec = "spec". $i;
			$dept = "dept". $i;
			$std_iss = "std_iss" .$i;
			$display = "display" .$i;
			$ps_recnum = "ps_recnum" .$i;
			$ps_issue = "ps_issue" .$i;


			$data1['linenum'] = $request->input($linenum); 
			$data1['op_no'] = $request->input($op_no);
			$data1['desc'] = $request->input($desc);
			$data1['ps_no'] = $request->input($ps_no);
			$data1['spec'] = $request->input($spec);
			$data1['dept'] = $request->input($dept);
			$data1['std_iss'] = $request->input($std_iss);
			$data1['display'] = $request->input($display);
			$data1['ps_recnum'] = $request->input($ps_recnum);
			$data1['ps_issue'] = $request->input($ps_issue);
			$data1['mrp_recnum'] = $mrp_recnum;


			if ($data1['linenum'] != "") 
			{
				$recnum = $newRoute->addmaster_routing_li($data1);
				
				if (!empty($data1['ps_recnum'])) 
				{
					$psli_details = $newRoute->get_psnextdue4tank($data1['ps_recnum']);

					if (!empty($psli_details)) 
					{
						$data2['tank_freq'] = $psli_details[0]->earlist_analysis_freq;
				    	$data2['tank_reminder'] = $psli_details[0]->earlist_nxtdue;
				    	$data2['last_update_date'] = $psli_details[0]->tank_lud;
				    	$data2['tanknum'] =  preg_replace("/[^0-9]/", '', $psli_details[0]->item_value);
				    	$data2['recnum'] = $recnum;
				    	$data2['mrprecnum'] = $mrp_recnum;



				    	if ($data2['tank_reminder'] != '' && $data2['tank_reminder'] != null && $data2['tank_reminder'] != '0000-00-00') 
				    	{	
				    		/* 
								Update Route Master Line Items Tank lud, Tank NxtDUe for corresponding Ps
							*/
				    		$newRoute->update_nxtdue4mrs($data2);

				    	}
				    	
				    	if ($earlist_nxtdue4mrs == "") 
				    	{	

				    		/* 
								Update Route Master Tank lud, Tank NxtDUe 
							*/
							if ($data2['tank_reminder'] == "0000-00-00") {
								$data2['tank_reminder'] = "";
							}
				    		$newRoute->update_nxtdue4master_route($data2);
			    		 	$earlist_nxtdue4mrs = $data2['tank_reminder'];
				    	}
				    	else
				    	{
				    		if ($data2['tank_reminder'] != '' && $data2['tank_reminder'] != null && $data2['tank_reminder'] != '0000-00-00' ) 
					    	{
					    		if ($earlist_nxtdue4mrs > $data2['tank_reminder']) 
				    		 	{
				    		 		/* 
										Update Route Master Tank lud, Tank NxtDUe 
									*/
									if ($data2['tank_reminder'] == "0000-00-00") {
										$data2['tank_reminder'] = "";
									}
					    			$newRoute->update_nxtdue4master_route($data);
					    			$earlist_nxtdue4mrs = $data2['tank_reminder'];
					    		}
					    	}
				    	}

					}

					
				}
				
			}

			$i++;
		}

		return \Redirect::to('/mrs_summary');

	}

	public function getspec4mrs()
	{
		
		$newRoute = new MasterRoute();
		$data['specs'] = $newRoute->getspec4mrs();
		return View::make('mrs.getallspecs')->with($data);
	}

	public function getps4mrs()
	{
		
		$newRoute = new MasterRoute();
		$data['process_sheets'] = $newRoute->getAll_ProcessSheetno();
		return View::make('mrs.getallps')->with($data);
	}

	public function editmrs($recnum)
	{
		$newRoute = new MasterRoute();
		$data['details'] = $newRoute->getmasterroute_details($recnum);
		$data['lidetails'] = $newRoute->getmaster_routeLI($recnum);
		$data['linotes'] = $newRoute->getNotes4mrs($recnum);   
		$data['rev_his'] = $newRoute->getmr_rev_history($recnum);
		$data['mr_rev_num'] = $newRoute->getmr_rev_num($recnum);
        $data['myrevrow'] = $newRoute->getmr_last_rev($recnum);
	
		return View::make('mrs.edit_mrs')->with($data);
	}

	public function submit_mrsedit(Request $request)
	{
		


	    $newRoute = new MasterRoute();
		$data['doc_id'] = $request->input('doc_id'); 
		$data['issue'] = $request->input('issue');
		$data['customer'] = $request->input('customer');
		$data['date'] = $request->input('date');
		$data['scope'] = $request->input('scope');
		$data['response'] = $request->input('response');
		$data['reference'] = $request->input('reference');
		$data['masterdatarecnum'] = $request->input('masterdatarecnum');
		$data['status'] = $request->input('status');
		$data['approved'] = $request->input('approved');
		$data['approved_by'] = $request->input('approved_by');
		$data['app_date'] = $request->input('app_date');

		$data['max'] = $request->input('index');


		$newRoute->updatemaster_routing($data);

		$data['notes'] = $request->input('notes');
		if ($data['notes'] != "") 
		{
			$newRoute->addNotes4mrs($data['masterdatarecnum'], $data['notes']);
		}

		$i = 1;
		while ($i < $data['max']) 
		{
			$linenum = "line_num". $i;
			$op_no = "op_no". $i;
			$desc = "desc". $i;
			$ps_no = "ps_no". $i;
			$spec = "spec". $i;
			$recnum = "recnum" .$i;
			$dept = "dept". $i;
			$std_iss = "std_iss". $i;
			$display = "display". $i;
			$ps_recnum = "ps_recnum" .$i;
			$ps_issue = "ps_issue" .$i;

			$data1['linenum'] = $request->input($linenum);
			$data1['op_no'] = $request->input($op_no);
			$data1['desc'] = $request->input($desc);
			$data1['ps_no'] = $request->input($ps_no);
			$data1['spec'] = $request->input($spec);
			$data1['recnum'] = $request->input($recnum);
			$data1['dept'] = $request->input($dept);
			$data1['std_iss'] = $request->input($std_iss);
			$data1['display'] = $request->input($display);
			$data1['ps_recnum'] = $request->input($ps_recnum);
			$data1['ps_issue'] = $request->input($ps_issue);
			$data1['masterdatarecnum'] = $data['masterdatarecnum'];
			$data1['mrp_recnum'] = $data['masterdatarecnum'];

			if ($data1['recnum'] != "") 
			{
				if ($data1['linenum'] != "") 
				{
					$newRoute->updatemaster_routing_li($data1);
				}
				else
				{
					$newRoute->delete_master_routingLI($data1);
				}
			}
			else
			{
				$recnum = $newRoute->addmaster_routing_li($data1);
			}


			$i++;
		}

		$data2['rev_num'] = $request->input('rev_num'); 
		$data2['rev_recnum'] = $request->input('rev_recnum'); 
		$data2['prev_revnum'] = $request->input('prev_revnum');
		$data2['rev_date'] = $request->input('rev_date');
		$data2['rev_desc'] = $request->input('rev_desc');
		$data2['rev_owner'] = $request->input('rev_owner');
		$data2['rev_approved'] = $request->input('rev_approved');
		$data2['rev_approved_by'] = $request->input('rev_approved_by');
		$data2['rev_app_date'] = $request->input('rev_app_date');
		$data2['rev_doc'] = "MR";
		$data2['doc_id'] = $data['doc_id'];
		$data2['mrp_recnum'] = $data['masterdatarecnum'];



		if ($data2['rev_approved'] == "yes") 
		{
			$data2['rev_status'] = "Active";
		}
		else
		{
			$data2['rev_status'] = "Pending";
		}

		$newRoute->update_revstatus_mr($data2);

		if (trim($data2['prev_revnum']) != trim($data2['rev_num'])) 
		{
			$newRoute->add_rev_history($data2);
		}
		else
		{	
			$data['rev_recnum'] = $data2['rev_recnum'];
			$newRoute->update_rev_history($data2);
		}

		return redirect()->route('mrs_details', ['recnum' => $data['masterdatarecnum']]);

	}

	public function copymrs($recnum)
	{
		$newRoute = new MasterRoute();
		$data['details'] = $newRoute->getmasterroute_details($recnum);
		$data['lidetails'] = $newRoute->getmaster_routeLI($recnum);
		$data['linotes'] = $newRoute->getNotes4mrs($recnum);   
		$data['rev_his'] = $newRoute->getmr_rev_history($recnum);
		$data['mr_rev_num'] = $newRoute->getmr_rev_num($recnum);
        $data['myrevrow'] = $newRoute->getmr_last_rev($recnum);

        return View::make('mrs.copy_mrs')->with($data);
	}

	public function printmrs($recnum)
	{
		$newRoute = new MasterRoute();
		$data['details'] = $newRoute->getmasterroute_details($recnum);
		$data['lidetails'] = $newRoute->getmaster_routeLI($recnum);
		$data['linotes'] = $newRoute->getNotes4mrs($recnum);

		return View::make('mrs.printmrs')->with($data);
	}
	
	public function std_summary($value='')
	{
		$newstd = new StdMaster();
		$rowsPerPage = 12;

		if (Input::has("page")) 
		{
			$data = Input::all();
			$oper = $_GET['refno_oper'];
    		$final_refno = $_GET['final_refno'];
    		$finalref_match = $_GET['final_refno'];
    		$condition = $_GET['status_val'];
    		$sval = $_GET['status_val'];

    		if ($oper == 'like') 
    		{
		        $final_refno = "'" . $final_refno . "%" . "'";
		    }
		    else 
		    {
		        $final_refno = "'" . $final_refno . "'";
		    }

		    $cond0 = "s.std_no " . $oper . " " . $final_refno;


		    if($condition == 'All')
			{
			   $cond1 = "(sli.status like '%' || sli.status is NULL || sli.status ='')";
			}
			if ($sval== 'Active')
		    {
				$cond1 = "(sli.status = '" . $sval . "' || sli.status is NULL || sli.status = '')";
			}
			else if ($sval == 'Inactive')
			{
				$cond1 = "sli.status = '" . $sval . "'" ;
			}

			$pageNum = $_REQUEST['page'];
			$offset = ($pageNum - 1) * $rowsPerPage;
			$cond = $cond0 . ' and ' . $cond1  ;
		}
		else
		{
			if (!empty($_POST)) 
        	{
        		$oper = $_POST['refno_oper'];
        		$final_refno = $_POST['final_refno'];
        		$finalref_match = $_POST['final_refno'];
	    		$condition = $_POST['status_val'];
	    		$sval = $_POST['status_val'];

        		if ($oper == 'like') 
        		{
			        $final_refno = "'" . $_POST['final_refno'] . "%" . "'";
			    }
			    else 
			    {
			        $final_refno = "'" . $_POST['final_refno'] . "'";
			    }
			    $cond0 = "s.std_no " . $oper . " " . $final_refno;


			    if($condition == 'All')
				{
				   $cond1 = "(sli.status like '%' || sli.status is NULL || sli.status ='')";
				}
				if ($sval== 'Active')
			    {
					$cond1 = "(sli.status = '" . $sval . "' || sli.status is NULL || sli.status = '')";
				}
				else if ($sval == 'Inactive')
				{
					$cond1 = "sli.status = '" . $sval . "'" ;
				}

				$pageNum = 1;
				$offset = ($pageNum - 1) * $rowsPerPage;
				$cond = $cond0 . ' and ' . $cond1  ;
        	}
        	else
        	{
        		$pageNum = 1;
		   		$offset = ($pageNum - 1)  * $rowsPerPage;
				$finalref_match = '';
				$sval = 'Active';
				$oper = "like";

				$cond0 = "s.std_no like'%'";	
				$cond1 = "(sli.status like '%' || sli.status is NULL  || sli.status = '')";
				$cond = $cond0 . ' and ' . $cond1  ;

        	}
		}

		
		
		$data['results'] = $newstd->getstdmasterSummary($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newstd->getstdmastercount($cond);
		$numrows = $data['numrows'][0]->numrows;
		$maxPage = ceil($numrows/$rowsPerPage);
		$data['refno_oper'] = $oper;
		$data['status_val'] = $sval;
		$data['final_refno'] = $finalref_match;

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
		    $data['prev'] = " <a href=\"test_laravel/stdmaster_summary/?page=$page&totpages=$totpages&final_refno=$finalref_match&refno_oper=$oper&status_val=$sval\">[Prev]</a> ";
			$data['first'] = " <a href=\"test_laravel/stdmaster_summary/?page=1&totpages=$totpages&final_refno=$finalref_match&refno_oper=$oper&status_val=$sval\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/stdmaster_summary/?page=$page&totpages=$totpages&final_refno=$finalref_match&refno_oper=$oper&status_val=$sval\">[Next]</a> ";
    		$data['last'] = "<a href=\"test_laravel/stdmaster_summary/?page=$totpages&totpages=$totpages&final_refno=$finalref_match&refno_oper=$oper&status_val=$sval\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;



		return View::make('stdmaster.stdmaster_summary')->with($data);
		
	}

	public function newstd($value='')
	{

		$data['title'] = 'New Stdmaster';
		return View::make('stdmaster.stdmasterEntry')->with($data);
	}	

	public function submit_addstd(Request $request)
	{

		$newstd = new StdMaster();
		$data['standard_num'] = $request->input('standard_num');
		$data['index'] = $request->input('index');

		$max = $data['index'];
		$i=1;
		$flag=0;

		while($i<11)
		{
			$line_num="line_num" . $i;
			$status="status" . $i;
			$iss_date="iss_date" . $i;
			$iss_of_std="iss_of_std" . $i;

			$data1['line_num'] = $request->input($line_num);
			$data1['status'] = $request->input($status);
			$data1['iss_date'] = $request->input($iss_date);
			$data1['iss_of_std'] = $request->input($iss_of_std);

			if ($data1['line_num'] != "") 
			{
				if($flag==0)
				{
					$recnum =$newstd->add_stdmaster($data);
					$flag = 1;
				}

				$data1['recnum'] = $recnum;
				$newstd->addstdmaster_li($data1);
			}


			$i++;

		}

		return \Redirect::to('/stdmaster_summary');

	}

	public function edit_stdmaster($recnum)
	{
		$newstd = new StdMaster();
		$data['details'] = $newstd->getstdmaster_details($recnum);
		$data['lidetails'] = $newstd->getstdmasterli_details($recnum);
		return View::make('stdmaster.stdmasterEdit')->with($data);
		
	}

	public function submit_editstd(Request $request)
	{	
		

		$newstd = new StdMaster();
		$data['standard_num'] = $request->input('standard_num');
		$data['recnum'] = $request->input('recnum');
		

		$newstd->update_stdmaster($data);

		$max = $request->input('index');
		$i=1;
		$flag=0;

		while($i< $max)
		{

			$line_num="line_num" . $i;
			$status="status" . $i;
			$iss_date="iss_date" . $i;
			$iss_of_std="iss_of_std" . $i;
			$prevlinenum="prev_line_num" . $i;
    		$lirecnum="lirecnum" . $i;
			$prev_iss_ref="prev_iss_ref" .$i;

			$data1['line_num'] = $request->input($line_num);
			$data1['status'] = $request->input($status);
			$data1['iss_date'] = $request->input($iss_date);
			$data1['iss_of_std'] = $request->input($iss_of_std);
			$data1['prevlinenum'] = $request->input($prevlinenum);
			$data1['lirecnum'] = $request->input($lirecnum);
			$data1['prev_iss_ref'] = $request->input($prev_iss_ref);
			$data1['recnum'] = $request->input('recnum');

			if ($data1['line_num'] != "") 
			{
				if($data1['prevlinenum'] != '')
				{
					$newstd->updatestdmaster_li($data1);
				}
				else
				{
					$newstd->addstdmaster_li($data1);
				}
			}
			else
			{
				$newstd->deletestdmaster_li($data1['lirecnum']);
			}

			$i++;
		}

		return \Redirect::to('/stdmaster_summary');


	}
}	