<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Fair;
use View;

class FairController extends Controller
{
	public function fair_summary(Request $request)
	{
		$newfair = new Fair();
		$rowsPerPage =20;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();

			$finalpin_match = $request->Input('pin');
			$cond0 = "fa.crn like '". $finalpin_match . "%' ";

			$wdate1 = $request->Input('wdate1');
			$wdate2 = $request->Input('wdate2');

			if ($wdate1 != "") 
			{
				$cond11 = "(to_days(fa.wo_date) " . ">= to_days('" . $wdate1 . "'))";
			}
			else{
				$cond11 = "((to_days(fa.wo_date)-to_days('1582-01-01') >= 0 || fa.wo_date is NULL || fa.wo_date = '0000-00-00'))";
			}
			if ($wdate2 != "") 
			{
				$cond12 = "(to_days(fa.wo_date) " . "<= to_days('" . $wdate2 . "'))";
			}else{
				$cond12 = "((to_days(fa.wo_date)-to_days('2050-12-31') <= 0 || fa.wo_date is NULL || fa.wo_date = '0000-00-00'))";
			}
			$cond1 = $cond11 . ' and ' . $cond12;

			$final_typematch = $request->Input('final_type');
			$cond2 = "fa.type like '". $final_typematch . "%' ";

			$sval = $request->Input('status');
			if ($sval == 'All')
		    {
		        $cond3 = " fa.status IN('NC' ,'APPROVED', 'CUST APPROVED', 'RE FAIR', 'DELTA FAIR') || (fa.status is NULL) || (fa.status ='')" ;
		    }else{
		    	 $cond3 = "fa.status = '" . $sval . "'" ;
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
			
			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;
			$offset = ($pageNum - 1) * $rowsPerPage;

		}
		else
		{
			$cond0 = "fa.crn like '%'";
			$cond1 = "(to_days(fa.wo_date)-to_days('1582-01-01') >= 0 || fa.wo_date = '0000-00-00' || fa.wo_date is NULL) and
			          (to_days(fa.wo_date)-to_days('2050-12-31') <= 0 || fa.wo_date = '0000-00-00' || fa.wo_date is NULL)";
			$cond2 = "(fa.status like '%' || fa.status is NULL)";
			$cond3 = "fa.type like '%'";

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3;

			$finalpin_match='';
			$wdate1 = '';
     		$wdate2 = '';
     		$final_typematch='';
     		$sval = 'All';

     		$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;
		}



		$data['results'] = $newfair->getFairs($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newfair->getFairscount($cond);
		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);
        $data['pin'] = $finalpin_match;
        $data['final_type'] = $final_typematch;
        $data['wdate1'] = $wdate1;
        $data['wdate2'] = $wdate2;
        $data['sval'] = $sval;
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
		    $data['prev'] = " <a href=\"test_laravel/fair/?page=$page&totpages=$totpages&pin=$finalpin_match&final_type=$final_typematch&wdate1=$wdate1&wdate2=$wdate2&status=$sval\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/fair/?page=1&totpages=$totpages&pin=$finalpin_match&final_type=$final_typematch&wdate1=$wdate1&wdate2=$wdate2&status=$sval\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/fair/?page=$page&totpages=$totpages&pin=$finalpin_match&final_type=$final_typematch&wdate1=$wdate1&wdate2=$wdate2&status=$sval\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/fair/?page=$totpages&totpages=$totpages&pin=$finalpin_match&final_type=$final_typematch&wdate1=$wdate1&wdate2=$wdate2&status=$sval\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('fair.fair')->with($data);

	}

}


?>