<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Qspl;
use View;

class QsplController extends Controller
{

	public function spmfr_summary(Request $request)
	{	
		$newqspl = new Qspl();
		$rowsPerPage =15;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();

			$refno_match = $request->Input('refno');
			$oper1 = $request->Input('refno_oper');
			if ($oper1 == 'like') {
		        $refno = "'" . $refno_match . "%" . "'";
		    }
		    else {
		        $refno = "'" . $refno_match . "'";
		    }
		    $cond1 = "sp.ref_no " . $oper1 . " " . $refno;



			$arpid_match = $request->Input('arpid');
			$oper2 = $request->Input('arpid_oper');
			if ($oper2 == 'like') {
		        $arpid = "'" . $arpid_match . "%" . "'";
		    }
		    else {
		        $arpid = "'" . $arpid_match . "'";
		    }
		    $cond2 = "sp.arp_id " . $oper2 . " " . $arpid;


			$cmpname_match = $request->Input('cmpname');
			$oper3 = $request->Input('cmp_oper');
			if ($oper3 == 'like') {
		        $cmpname = "'" . $cmpname_match . "%" . "'";
		    }
		    else {
		        $cmpname = "'" . $cmpname_match . "'";
		    }
		    $cond3 = "sp.company_name " . $oper3 . " " . $cmpname;

			$city_match = $request->Input('city');
			$oper4 = $request->Input('city_oper');
			if ($oper4 == 'like') {
		        $city = "'" . $city_match . "%" . "'";
		    }
		    else {
		        $city = "'" . $city_match . "'";
		    }
		    $cond4 = "sp.city " . $oper4 . " " . $city;


			$country_match = $request->Input('country');
			$oper5 = $request->Input('country_oper');
			if ($oper5 == 'like') {
		        $country = "'" . $country_match . "%" . "'";
		    }
		    else {
		        $country = "'" . $country_match . "'";
		    }
		    $cond5 = "sp.country " . $oper5 . " " . $country;

		    $cond6 = "sp.oem like 'Airbus%'";

		    $cond = $cond1 . ' and ' . $cond2. ' and ' . $cond3. ' and ' . $cond4. ' and ' . $cond5. ' and ' . $cond6 . ' ';

		    if (Input::has("page")) 
		  	{
		  		$pageNum = $request->Input('page');
				$totpages = $request->Input('totpages');
		  	}
		  	else
		  	{
		  		$pageNum = 1;
		  	}
		  	$offset = ($pageNum - 1) * $rowsPerPage;

		}
		else
		{
			$cond1 = "sp.arp_id like '%'";
			$cond2 = "sp.company_name like '%'";
			$cond3 = "sp.city like '%'";
			$cond4 = "sp.country like '%'";
			$cond5 = "sp.ref_no like '%'";
		    $cond6 = "sp.oem like 'Airbus%'";
			$cond = $cond1 . ' and ' . $cond2. ' and ' . $cond3. ' and ' . $cond4. ' and ' . $cond5. ' and ' . $cond6 . ' ';

			$oper1='like';	
			$oper2='like';
			$oper3='like';
			$oper4='like';
			$oper5='like';

			$refno_match = "";
			$arpid_match = "";
			$cmpname_match = "";
			$city_match = "";
			$country_match = "";


			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;
			
		}

		$data['results'] = $newqspl->getspmfrmasterdata($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newqspl->getspmfrcount($cond);
		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);

        $data['refno_oper'] = $oper1;
		$data['arpid_oper'] = $oper2;
		$data['cmp_oper'] = $oper3;
		$data['city_oper'] = $oper4;
		$data['country_oper'] = $oper5;

		$data['refno_match'] = $refno_match;
		$data['arpid_match'] = $arpid_match;
		$data['cmpname_match'] = $cmpname_match;
		$data['city_match'] = $city_match;
		$data['country_match'] = $country_match;

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
		    $data['prev'] = " <a href=\"test_laravel/spmfr/?page=$page&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/spmfr/?page=1&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/spmfr/?page=$page&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/spmfr/?page=$totpages&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('qspl/airbus.spmfr')->with($data);

		// echo "<pre>";
		// print_r($data); exit;
	}

	public function spmfrb_summary(Request $request)
	{	
		$newqspl = new Qspl();
		$rowsPerPage =15;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();

			$refno_match = $request->Input('refno');
			$oper1 = $request->Input('refno_oper');
			if ($oper1 == 'like') {
		        $refno = "'" . $refno_match . "%" . "'";
		    }
		    else {
		        $refno = "'" . $refno_match . "'";
		    }
		    $cond1 = "sp.ref_no " . $oper1 . " " . $refno;



			$arpid_match = $request->Input('arpid');
			$oper2 = $request->Input('arpid_oper');
			if ($oper2 == 'like') {
		        $arpid = "'" . $arpid_match . "%" . "'";
		    }
		    else {
		        $arpid = "'" . $arpid_match . "'";
		    }
		    $cond2 = "sp.arp_id " . $oper2 . " " . $arpid;


			$cmpname_match = $request->Input('cmpname');
			$oper3 = $request->Input('cmp_oper');
			if ($oper3 == 'like') {
		        $cmpname = "'" . $cmpname_match . "%" . "'";
		    }
		    else {
		        $cmpname = "'" . $cmpname_match . "'";
		    }
		    $cond3 = "sp.company_name " . $oper3 . " " . $cmpname;

			$city_match = $request->Input('city');
			$oper4 = $request->Input('city_oper');
			if ($oper4 == 'like') {
		        $city = "'" . $city_match . "%" . "'";
		    }
		    else {
		        $city = "'" . $city_match . "'";
		    }
		    $cond4 = "sp.city " . $oper4 . " " . $city;


			$country_match = $request->Input('country');
			$oper5 = $request->Input('country_oper');
			if ($oper5 == 'like') {
		        $country = "'" . $country_match . "%" . "'";
		    }
		    else {
		        $country = "'" . $country_match . "'";
		    }
		    $cond5 = "sp.country " . $oper5 . " " . $country;

		    $cond6 = "sp.oem like 'Boeing%'";

		    $cond = $cond1 . ' and ' . $cond2. ' and ' . $cond3. ' and ' . $cond4. ' and ' . $cond5. ' and ' . $cond6 . ' ';

		    if (Input::has("page")) 
		  	{
		  		$pageNum = $request->Input('page');
				$totpages = $request->Input('totpages');
		  	}
		  	else
		  	{
		  		$pageNum = 1;
		  	}
		  	$offset = ($pageNum - 1) * $rowsPerPage;

		}
		else
		{
			$cond1 = "sp.arp_id like '%'";
			$cond2 = "sp.company_name like '%'";
			$cond3 = "sp.city like '%'";
			$cond4 = "sp.country like '%'";
			$cond5 = "sp.ref_no like '%'";
		    $cond6 = "sp.oem like 'Boeing%'";
			$cond = $cond1 . ' and ' . $cond2. ' and ' . $cond3. ' and ' . $cond4. ' and ' . $cond5. ' and ' . $cond6 . ' ';

			$oper1='like';	
			$oper2='like';
			$oper3='like';
			$oper4='like';
			$oper5='like';

			$refno_match = "";
			$arpid_match = "";
			$cmpname_match = "";
			$city_match = "";
			$country_match = "";


			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;
			
		}

		$data['results'] = $newqspl->getspmfrmasterdata($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newqspl->getspmfrcount($cond);
		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);

        $data['refno_oper'] = $oper1;
		$data['arpid_oper'] = $oper2;
		$data['cmp_oper'] = $oper3;
		$data['city_oper'] = $oper4;
		$data['country_oper'] = $oper5;

		$data['refno_match'] = $refno_match;
		$data['arpid_match'] = $arpid_match;
		$data['cmpname_match'] = $cmpname_match;
		$data['city_match'] = $city_match;
		$data['country_match'] = $country_match;

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
		    $data['prev'] = " <a href=\"test_laravel/spmfrb/?page=$page&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/spmfrb/?page=1&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/spmfrb/?page=$page&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/spmfrb/?page=$totpages&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('qspl/boeing.spmfrb')->with($data);

		// echo "<pre>";
		// print_r($data); exit;
	}

	public function spmfro_summary(Request $request)
	{	
		$newqspl = new Qspl();
		$rowsPerPage =15;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();

			$refno_match = $request->Input('refno');
			$oper1 = $request->Input('refno_oper');
			if ($oper1 == 'like') {
		        $refno = "'" . $refno_match . "%" . "'";
		    }
		    else {
		        $refno = "'" . $refno_match . "'";
		    }
		    $cond1 = "sp.ref_no " . $oper1 . " " . $refno;



			$arpid_match = $request->Input('arpid');
			$oper2 = $request->Input('arpid_oper');
			if ($oper2 == 'like') {
		        $arpid = "'" . $arpid_match . "%" . "'";
		    }
		    else {
		        $arpid = "'" . $arpid_match . "'";
		    }
		    $cond2 = "sp.arp_id " . $oper2 . " " . $arpid;


			$cmpname_match = $request->Input('cmpname');
			$oper3 = $request->Input('cmp_oper');
			if ($oper3 == 'like') {
		        $cmpname = "'" . $cmpname_match . "%" . "'";
		    }
		    else {
		        $cmpname = "'" . $cmpname_match . "'";
		    }
		    $cond3 = "sp.company_name " . $oper3 . " " . $cmpname;

			$city_match = $request->Input('city');
			$oper4 = $request->Input('city_oper');
			if ($oper4 == 'like') {
		        $city = "'" . $city_match . "%" . "'";
		    }
		    else {
		        $city = "'" . $city_match . "'";
		    }
		    $cond4 = "sp.city " . $oper4 . " " . $city;


			$country_match = $request->Input('country');
			$oper5 = $request->Input('country_oper');
			if ($oper5 == 'like') {
		        $country = "'" . $country_match . "%" . "'";
		    }
		    else {
		        $country = "'" . $country_match . "'";
		    }
		    $cond5 = "sp.country " . $oper5 . " " . $country;

		    $cond6 = "sp.oem like 'Others%'";

		    $cond = $cond1 . ' and ' . $cond2. ' and ' . $cond3. ' and ' . $cond4. ' and ' . $cond5. ' and ' . $cond6 . ' ';

		    if (Input::has("page")) 
		  	{
		  		$pageNum = $request->Input('page');
				$totpages = $request->Input('totpages');
		  	}
		  	else
		  	{
		  		$pageNum = 1;
		  	}
		  	$offset = ($pageNum - 1) * $rowsPerPage;

		}
		else
		{
			$cond1 = "sp.arp_id like '%'";
			$cond2 = "sp.company_name like '%'";
			$cond3 = "sp.city like '%'";
			$cond4 = "sp.country like '%'";
			$cond5 = "sp.ref_no like '%'";
		    $cond6 = "sp.oem like 'Others%'";
			$cond = $cond1 . ' and ' . $cond2. ' and ' . $cond3. ' and ' . $cond4. ' and ' . $cond5. ' and ' . $cond6 . ' ';

			$oper1='like';	
			$oper2='like';
			$oper3='like';
			$oper4='like';
			$oper5='like';

			$refno_match = "";
			$arpid_match = "";
			$cmpname_match = "";
			$city_match = "";
			$country_match = "";


			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;
			
		}

		$data['results'] = $newqspl->getspmfrmasterdata($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newqspl->getspmfrcount($cond);
		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);

        $data['refno_oper'] = $oper1;
		$data['arpid_oper'] = $oper2;
		$data['cmp_oper'] = $oper3;
		$data['city_oper'] = $oper4;
		$data['country_oper'] = $oper5;

		$data['refno_match'] = $refno_match;
		$data['arpid_match'] = $arpid_match;
		$data['cmpname_match'] = $cmpname_match;
		$data['city_match'] = $city_match;
		$data['country_match'] = $country_match;

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
		    $data['prev'] = " <a href=\"test_laravel/spmfrb/?page=$page&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/spmfrb/?page=1&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/spmfrb/?page=$page&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/spmfrb/?page=$totpages&totpages=$totpages&refno=$refno_match&refno_oper=$oper1&arpid=$arpid_match&arpid_oper=$oper2&cmpname=$cmpname_match&cmp_oper=$oper3&city=$city_match&city_oper=$oper4&country=$country_match&country_oper=$oper5\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('qspl/others.others')->with($data);

		// echo "<pre>";
		// print_r($data); exit;
	}


}



?>