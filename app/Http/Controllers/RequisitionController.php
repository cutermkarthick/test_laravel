<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Requisition;
use View;

class RequisitionController extends Controller
{

	public function requisition_summary(Request $request)
	{
		$newrequisition = new Requisition();
		$rowsPerPage =15;

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
		    $cond0 = "recnum " . $oper1 . " " . $recnum;


			$partnum_match = $request->Input('partnum');
			$oper2 = $request->Input('partnum_oper');

			if ($oper1 == 'like') {
		        $partnum = "'" . $partnum_match . "%" . "'";
		    }
		    else {
		        $partnum = "'" . $partnum_match . "'";
		    }
		    $cond1 = "partnum_req " . $oper2 . " " . $partnum;


			$batchnum_match = $request->Input('batchnum');
			$oper3 = $request->Input('batchnum_oper');

			if ($oper1 == 'like') {
		        $batchnum = "'" . $batchnum_match . "%" . "'";
		    }
		    else {
		        $batchnum = "'" . $batchnum_match . "'";
		    }
		    $cond2 = "batchnum " . $oper3 . " " . $batchnum;


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
			$cond0 = "recnum like '%'";
			$cond1 = "partnum_req like '%'";
			$cond2 = "batchnum like '%'";

			$recnum_match = '';
			$partnum_match = '';
			$batchnum_match = '';

			$oper1 = "like";
			$oper2 = "like";
			$oper3 = "like";

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;
			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;

		}

		$data['results'] = $newrequisition->getrequisition_summary($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newrequisition->getrequisition_count($cond);

		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);
        $data['rec_oper'] = $oper1;
		$data['partnum_oper'] = $oper2;
		$data['batchnum_oper'] = $oper3;
		$data['recnum_match'] = $recnum_match;
		$data['partnum_match'] = $partnum_match;
		$data['batchnum_match'] = $batchnum_match;
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
		    $data['prev'] = " <a href=\"test_laravel/requisition/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&partnum=$partnum_match&partnum_oper=$oper2&batchnum=$batchnum_match&batchnum_oper=$oper3\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/requisition/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&partnum=$partnum_match&partnum_oper=$oper2&batchnum=$batchnum_match&batchnum_oper=$oper3\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/requisition/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&partnum=$partnum_match&partnum_oper=$oper2&batchnum=$batchnum_match&batchnum_oper=$oper3\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/requisition/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&partnum=$partnum_match&partnum_oper=$oper2&batchnum=$batchnum_match&batchnum_oper=$oper3\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('requisition.requisition')->with($data);

		echo "<pre>";
   		print_r($data); exit;

	}

}