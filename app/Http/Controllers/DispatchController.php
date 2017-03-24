<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Dispatch;
use View;

class DispatchController extends Controller
{

	public function dispatch_summary(Request $request)
	{	
		
		$newcofc = new Dispatch();
		$rowsPerPage =50;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();

			$recnum_match = $request->Input('recnum');
			$oper1 = $request->Input('rec_oper');
			if ($oper1 == 'like') {
		        $recnum = "'" . $recnum_match . "%" . "'";
		    }
		    else {
		        $recnum = "'" . $recnum_match . "'";
		    }
		    $cond0 = "c.recnum " . $oper1 . " " . $recnum;

		    $cofc_match = $request->Input('cust_cofc_no');
			$oper2 = $request->Input('cofc_oper');
			if ($oper2 == 'like') {
		        $cofc = "'" . $cofc_match . "%" . "'";
		    }
		    else {
		        $cofc = "'" . $cofc_match . "'";
		    }
		    $cond1 = "c.cust_cofc_no " . $oper2 . " " . $cofc;

		    $pinnum_match = $request->Input('pinnum');
			$oper3 = $request->Input('cofc_oper');
			if ($oper3 == 'like') {
		        $pinnum = "'" . $pinnum_match . "%" . "'";
		    }
		    else {
		        $pinnum = "'" . $pinnum_match . "'";
		    }
		    $cond2 = "c.pin_no " . $oper3 . " " . $pinnum;

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
			$cond0 = "c.recnum like '%'";
			$cond1 = "c.cust_cofc_no like '%'";
			$cond2 = "c.pin_no like '%'";

			$oper1='like';
			$oper2='like';
			$oper3='like';

			$recnum_match = '';
			$cofc_match = '';
			$pinnum_match = '';

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 ;
			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;

		}

		$data['results'] = $newcofc->getcofc_summary($cond, $offset,$rowsPerPage);
		$data['numrows'] = $newcofc->getcofc_count($cond);
		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);

        $data['rec_oper'] = $oper1;
		$data['cofc_oper'] = $oper2;
		$data['pinum_oper'] = $oper3;

		$data['recnum'] = $recnum_match;
		$data['cust_cofc_no'] = $cofc_match;
		$data['pinnum'] = $pinnum_match;
		$data['userid'] = session('user');
		$data['dept'] = session('department');

		if (isset($_GET['page']))
		{
		    $pageNum = $request->Input('page');
		}
		else
		{
			$totpages = $maxPage;
		}
		if (isset($_GET['totpages']))
		{
		    $totpages = $request->Input('totpages');
		}
		if ($pageNum > 1)
		{
		    $data['page'] = $pageNum - 1;
		    $page = $pageNum - 1;
		    $data['prev'] = " <a href=\"test_laravel/dispatch/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&cust_cofc_no=$cofc_match&cofc_oper=$oper2&pinnum=$pinnum_match&pinum_oper=$oper3\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/dispatch/?page=1&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&cust_cofc_no=$cofc_match&cofc_oper=$oper2&pinnum=$pinnum_match&pinum_oper=$oper3\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/dispatch/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&cust_cofc_no=$cofc_match&cofc_oper=$oper2&pinnum=$pinnum_match&pinum_oper=$oper3\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/dispatch/?page=$totpages&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&cust_cofc_no=$cofc_match&cofc_oper=$oper2&pinnum=$pinnum_match&pinum_oper=$oper3\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('dispatch.dispatch')->with($data);

		echo "<pre>";
		print_r($data); exit;

	}

}



?>