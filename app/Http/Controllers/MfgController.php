<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Mfg;
use View;

class MfgController extends Controller
{

	public function mfg_summary(Request $request)
	{
		$newmfg = new Mfg();
		$rowsPerPage =50;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();



			$mfg_match = $request->Input('mfg_id');
			$mfg_oper = $request->Input('mfg_oper');
			if ($mfg_oper == 'like') {
		        $mfg = "'" . $mfg_match . "%" . "'";
		    }
		    else {
		        $mfg = "'" . $mfg_match . "'";
		    }
		    $cond0 = "mfg_id " . $mfg_oper . " " . $mfg;


			$ps_match = $request->Input('ps');
			$ps_oper = $request->Input('ps_oper');

			if ($ps_oper == 'like') {
		        $ps = "'" . $ps_match . "%" . "'";
		    }
		    else {
		        $ps = "'" . $ps_match . "'";
		    }
		    $cond1 = "tanknum " . $ps_oper . " " . $ps;


			$seq_match = $request->Input('recnum');
			$seq_oper = $request->Input('seq_oper');

			if ($seq_oper == 'like') {
		        $seq = "'" . $seq_match . "%" . "'";
		    }
		    else {
		        $seq = "'" . $seq_match . "'";
		    }
		    $cond2 = "recnum " . $seq_oper . " " . $seq;


		    $condition1 = $request->Input('condition');
		   	$sval = $condition1;
		   	if($condition1 == 'All')
		   	{
		      	$cond3 = " m.status IN('Active' ,'Pending', 'Inactive', 'Cancelled')" ;
		  	}
		  	else 
		  	{
		    	$cond3 = " m.status ='$condition1'" ;
		  	}

		  	if (Input::has("page")) 
		  	{
		  		$pageNum = $request->Input('page');
				$totpages = $request->Input('totpages');
		  	}
		  	else
		  	{
		  		$pageNum = 1;
		  	}
			

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;
			$offset = ($pageNum - 1) * $rowsPerPage;
		}
		else
		{
			$cond0 = "mfg_id like '%'";
			$cond1 = "tanknum like '%'";
			$cond2 = " status IN('Open' ,'Issued', 'Closed', 'Cancelled')" ;
			$cond3 = "recnum like '%'";

			$mfg_match = '';
			$ps_match = '';
			$seq_match = '';

			$mfg_oper = "like";
			$ps_oper = "like";
			$seq_oper = "like";
			$sval = "All";

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2. ' and ' . $cond3;
			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;

		}

		$data['results'] = $newmfg->getmfgs($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newmfg->getmfgcount($cond);
		$numrows = $data['numrows'][0]->numrows;
		$maxPage = ceil($numrows/$rowsPerPage);
		$data['mfg_oper'] = $mfg_oper;
		$data['ps_oper'] = $ps_oper;
		$data['seq_oper'] = $seq_oper;
		$data['sval'] = $sval;

		$data['mfg_match'] = $mfg_match;
		$data['ps_match'] = $ps_match;
		$data['seq_match'] = $seq_match;
		$data['userid'] = session('user');
		$data['dept'] = session('department');

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
		    $data['prev'] = " <a href=\"test_laravel/mfg/?page=$page&totpages=$totpages&mfg=$mfg_match&mfg_oper=$mfg_oper&ps=$ps_match&ps_oper=$ps_oper&condition=$sval&seq_num=$seq_match&seq_oper=$seq_oper\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/mfg/?page=1&totpages=$totpages&mfg=$mfg_match&mfg_oper=$mfg_oper&ps=$ps_match&ps_oper=$ps_oper&condition=$sval&seq_num=$seq_match&seq_oper=$seq_oper\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/mfg/?page=$page&totpages=$totpages&mfg=$mfg_match&mfg_oper=$mfg_oper&ps=$ps_match&ps_oper=$ps_oper&condition=$sval&seq_num=$seq_match&seq_oper=$seq_oper\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/mfg/?page=$totpages&totpages=$totpages&mfg=$mfg_match&mfg_oper=$mfg_oper&ps=$ps_match&ps_oper=$ps_oper&condition=$sval&seq_num=$seq_match&seq_oper=$seq_oper\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('mfg.mfg')->with($data);

		echo "<pre>";
		print_r($data); exit;

	}

}