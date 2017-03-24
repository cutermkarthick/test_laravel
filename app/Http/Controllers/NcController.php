<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Nc;
use View;

class NcController extends Controller
{

	public function nc_summary(Request $request)
	{	
		$newnc = new Nc();
		$rowsPerPage = 10;
		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();
			// echo "<pre>";
			// print_r($input);


			$final_refno = $request->Input('final_refno');
			$oper1 = $request->Input('refno_oper');
			if ($oper1 == 'like') {
			$refno = "'" . $final_refno . "%" . "'";
			}
			else {
			$refno = "'" . $final_refno . "'";
			}
			$cond0 = "refnum " . $oper1 . " " . $refno;


			$final_wono = $request->Input('final_wono');
			$oper2 = $request->Input('wono_oper');
			if ($oper2 == 'like') {
			$wono = "'" . $final_wono . "%" . "'";
			}
			else {
			$wono = "'" . $final_wono . "'";
			}
			$cond1 = "wonum " . $oper2 . " " . $wono;


			$final_cofc = $request->Input('final_cofc');
			$oper3 = $request->Input('cofc_oper');
			if ($oper3 == 'like') {
			$cofc = "'" . $final_cofc . "%" . "'";
			}
			else {
			$cofc = "'" . $final_cofc . "'";
			}
			$cond2 = "cofcnum " . $oper3 . " " . $cofc;


			$final_idno = $request->Input('final_idno');
			$oper4 = $request->Input('idno_oper');
			if ($oper4 == 'like') {
			$idno = "'" . $final_idno . "%" . "'";
			}
			else {
			$idno = "'" . $final_idno . "'";
			}
			$cond7 = "recnum " . $oper4 . " " . $idno;


			$final_part = $request->Input('final_part');
			$oper5 = $request->Input('part_oper');
			if ($oper5 == 'like') {
			$part = "'" . $final_part . "%" . "'";
			}
			else {
			$part = "'" . $final_part . "'";
			}
			$cond3 = "partnum " . $oper5 . " " . $part;


			$final_cust = $request->Input('final_cust');
			$oper6 = $request->Input('cust_oper');
			if ($oper6 == 'like') {
			$cust = "'" . $final_cust . "%" . "'";
			}
			else {
			$cust = "'" . $final_cust . "'";
			}
			$cond4 = "customer " . $oper6 . " " . $cust;


			$sval = $request->Input('sval');
			if ($sval == 'All')
		    {
		        $cond5 = " status IN('Open' ,'Closed', 'Pending', 'Cancelled') || (status is NULL) || (status ='')" ;
		    }else{
		    	 $cond5 = "status = '" . $sval . "'" ;
		    }


			$final_date1 = $request->Input('final_date1');
			$final_date2 = $request->Input('final_date2');

			if ($final_date1 != "") 
			{
				$cond11 = "(to_days(create_date) " . ">= to_days('" . $final_date1 . "'))";
			}
			else{
				$cond11 = "((to_days(create_date)-to_days('1582-01-01') >= 0 || create_date is NULL || create_date = '0000-00-00'))";
			}
			if ($final_date2 != "") 
			{
				$cond12 = "(to_days(create_date) " . "<= to_days('" . $final_date2 . "'))";
			}else{
				$cond12 = "((to_days(create_date)-to_days('2050-12-31') <= 0 || create_date is NULL || create_date = '0000-00-00'))";
			}
			$cond6 = $cond11 . ' and ' . $cond12;

			if (Input::has("page")) 
		  	{
		  		$pageNum = $request->Input('page');
				$totpages = $request->Input('totpages');
		  	}
		  	else
		  	{
		  		$pageNum = 1;
		  	}

			$cond = $cond0 . ' and ' . $cond1  . ' and ' . $cond4 . ' and ' . $cond5 . ' and ' . $cond6 . ' and ' . $cond7;
			$offset = ($pageNum - 1) * $rowsPerPage;

		}
		else
		{
			$cond0 = "refnum like '%'";
			$cond1 = "wonum like '%'";
			$cond2 = "customer like '%'";
			$cond4 = "(to_days(create_date)-to_days('1582-01-01') >= 0 ||
						create_date = '0000-00-00' ||
						create_date is NULL) and
						(to_days(create_date)-to_days('2050-12-31') <= 0 ||
						create_date = '0000-00-00' ||
						create_date is NULL)";
			$cond5 = "partnum like '%'";
			$cond6 = "(status = 'Open' || status = '' || status is NULL)";
			$cond7 = "recnum like '%'";

			$oper1='like';
			$oper2='like';
			$oper3='like';
			$oper4='like';
			$oper5='like';
			$oper6='like';


			$final_refno = "";
			$final_wono = "";
			$final_cofc = "";
			$final_idno = "";
			$final_part = "";
			$final_cust = "";
			$sval = "All";
			$final_date1 = "";
			$final_date2 = "";

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2  . ' and ' . $cond4 . ' and ' . $cond5 . ' and ' . $cond6. ' and ' . $cond7;

			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;

		}

		$data['results'] = $newnc->getnc4qa($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newnc->getncCount($cond);
		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);
        $data['userid'] = session('user');
		$data['dept'] = session('department');

		$data['refno_oper'] = $oper1;
		$data['wono_oper'] = $oper2;
		$data['cofc_oper'] = $oper3;
		$data['idno_oper'] = $oper4;
		$data['part_oper'] = $oper5;
		$data['cust_oper'] = $oper6;


		$data['final_refno'] = $final_refno;
		$data['final_wono'] = $final_wono;
		$data['final_cofc'] = $final_cofc;
		$data['final_idno'] = $final_idno;
		$data['final_part'] = $final_part;
		$data['final_cust'] = $final_cust;
		$data['sval'] = $sval;
		$data['final_date1'] = $final_date1;
		$data['final_date2'] = $final_date2;

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
		    $data['prev'] = " <a href=\"test_laravel/nc/?page=$page&totpages=$totpages&final_refno=$final_refno&refno_oper=$oper1&final_wono=$final_wono&wono_oper=$oper2&final_cofc=$final_cofc&cofc_oper=$oper3&final_idno=$final_idno&idno_oper=$oper4&final_part=$final_part&part_oper=$oper5&final_cust=$final_cust&cust_oper=$oper6&sval=$sval&final_date1=$final_date1&final_date2=$final_date2\">[Prev]</a>  ";

			$data['first'] = " <a href=\"test_laravel/nc/?page=1&totpages=$totpages&final_refno=$final_refno&refno_oper=$oper1&final_wono=$final_wono&wono_oper=$oper2&final_cofc=$final_cofc&cofc_oper=$oper3&final_idno=$final_idno&idno_oper=$oper4&final_part=$final_part&part_oper=$oper5&final_cust=$final_cust&cust_oper=$oper6&sval=$sval&final_date1=$final_date1&final_date2=$final_date2\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/nc/?page=$page&totpages=$totpages&final_refno=$final_refno&refno_oper=$oper1&final_wono=$final_wono&wono_oper=$oper2&final_cofc=$final_cofc&cofc_oper=$oper3&final_idno=$final_idno&idno_oper=$oper4&final_part=$final_part&part_oper=$oper5&final_cust=$final_cust&cust_oper=$oper6&sval=$sval&final_date1=$final_date1&final_date2=$final_date2\">[Next]</a> ";

    		$data['last'] = " <a href=\"test_laravel/nc/?page=$page&totpages=$totpages&final_refno=$final_refno&refno_oper=$oper1&final_wono=$final_wono&wono_oper=$oper2&final_cofc=$final_cofc&cofc_oper=$oper3&final_idno=$final_idno&idno_oper=$oper4&final_part=$final_part&part_oper=$oper5&final_cust=$final_cust&cust_oper=$oper6&sval=$sval&final_date1=$final_date1&final_date2=$final_date2\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('nc.nc')->with($data);

		echo "<pre>";
		print_r($data); exit;
	}

}



?>