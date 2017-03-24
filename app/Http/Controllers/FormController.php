<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Form;
use View;

class FormController extends Controller
{

	public function form_summary(Request $request)
	{


		$newform = new Form();
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
		    $cond0 = "c.recnum " . $oper1 . " " . $recnum;

		    $partnum_match = $request->Input('partnum');
			$oper2 = $request->Input('partnum_oper');
			if ($oper2 == 'like') {
		        $partnum = "'" . $partnum_match . "%" . "'";
		    }
		    else {
		        $partnum = "'" . $partnum_match . "'";
		    }
		    $cond1 = "c.partnum " . $oper2 . " " . $partnum;

		    $partname_match = $request->Input('partname');
			$oper3 = $request->Input('partname_oper');
			if ($oper3 == 'like') {
		        $partname = "'" . $partname_match . "%" . "'";
		    }
		    else {
		        $partname = "'" . $partname_match . "'";
		    }
		    $cond2 = "c.partname " . $oper3 . " " . $partname;


		    $fairnum_match = $request->Input('fairnum');
			$oper4 = $request->Input('fairnum_oper');
			if ($oper4 == 'like') {
		        $fairnum = "'" . $fairnum_match . "%" . "'";
		    }
		    else {
		        $fairnum = "'" . $fairnum_match . "'";
		    }
		    $cond3 = "c.fairno " . $oper4 . " " . $fairnum;

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
			$cond0 = "c.recnum like '%'";
		  	$cond1 = "c.partnum like '%'";
		  	$cond2 = "c.partname like '%'";
		  	$cond3 = "c.fairno like '%'";

		  	$oper1='like';
			$oper2='like';
			$oper3='like';
			$oper4='like';

			$recnum_match = '';
			$partnum_match = '';
			$partname_match = '';
			$fairnum_match = '';

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2 . ' and ' . $cond3 ;
			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;
		}

		$data['results'] = $newform->getcofcform1_summary($cond, $offset,$rowsPerPage);
		$data['numrows'] = $newform->getcofcform1_count($cond);
		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);

        $data['rec_oper'] = $oper1;
		$data['partnum_oper'] = $oper2;
		$data['partname_oper'] = $oper3;
		$data['fairnum_oper'] = $oper4;

		$data['recnum'] = $recnum_match;
		$data['partnum'] = $partnum_match;
		$data['partname'] = $partname_match;
		$data['fairnum'] = $fairnum_match;

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
		    $data['prev'] = " <a href=\"test_laravel/form/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&partnum=$partnum_match&partnum_oper=$oper2&partname=$partname_match&partname_oper=$oper3&fairnum=$fairnum_match&fairnum_oper=$oper4\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/form/?page=1&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&partnum=$partnum_match&partnum_oper=$oper2&partname=$partname_match&partname_oper=$oper3&fairnum=$fairnum_match&fairnum_oper=$oper4\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/form/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&partnum=$partnum_match&partnum_oper=$oper2&partname=$partname_match&partname_oper=$oper3&fairnum=$fairnum_match&fairnum_oper=$oper4\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/form/?page=$totpages&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&partnum=$partnum_match&partnum_oper=$oper2&partname=$partname_match&partname_oper=$oper3&fairnum=$fairnum_match&fairnum_oper=$oper4\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;


		return View::make('form.form')->with($data);
		echo "<pre>";
		print_r($data); exit;
	}
}


?>