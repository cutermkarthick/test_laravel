<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Accounts;
use View;

class AccountsController extends Controller
{

	public function accounts_summary(Request $request)
	{	
		$newaccount = new Accounts();
		$rowsPerPage =5;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();

			$id_match = $request->Input('id');
			$oper1 = $request->Input('id_oper');
			if ($oper1 == 'like') {
		        $id = "'" . $id_match . "%" . "'";
		    }
		    else {
		        $id = "'" . $id_match . "'";
		    }
		    $cond0 = "id " . $oper1 . " " . $id;

		    $name_match = $request->Input('name');
			$oper2 = $request->Input('name_oper');
			if ($oper2 == 'like') {
		        $name = "'" . $name_match . "%" . "'";
		    }
		    else {
		        $name = "'" . $name_match . "'";
		    }
		    $cond1 = "name " . $oper2 . " " . $name;

		    $sval = $request->Input('type');
			if ($sval == 'All' || $sval == '')
		    {
		        $cond2 = " type IN('VEND' ,'HOST', 'CUST') || (type is NULL) || (type ='')" ;
		    }else{
		    	 $cond2 = "type = '" . $sval . "'" ;
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
			$cond0 = "id like '%'";
			$cond1 = "name like '%'";
			$cond2 = "type IN('Host' ,'CUST', 'VEND')" ;

			$id_match = '';
			$name_match = '';
			$sval = 'All';

			$oper1 = "like";
			$oper2 = "like";

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;
			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;


			
		}

		$data['results'] = $newaccount->getAccounts($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newaccount->getAccountscount($cond);

		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);

        $data['id_oper'] = $oper1;
		$data['name_oper'] = $oper2;
		$data['id_match'] = $id_match;
		$data['name_match'] = $name_match;
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
		    $data['prev'] = " <a href=\"test_laravel/accounts/?page=$page&totpages=$totpages&id=$id_match&id_oper=$oper1&name=$name_match&name_oper=$oper2&sval=$sval\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/accounts/?page=1&totpages=$totpages&id=$id_match&id_oper=$oper1&name=$name_match&name_oper=$oper2&sval=$sval\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/accounts/?page=$page&totpages=$totpages&id=$id_match&id_oper=$oper1&name=$name_match&name_oper=$oper2&sval=$sval\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/accounts/?page=$totpages&totpages=$totpages&id=$id_match&id_oper=$oper1&name=$name_match&name_oper=$oper2&sval=$sval\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('accounts.accounts')->with($data);
		// echo "<pre>";
		// print_r($data); exit;

	}



	public function contacts_summary(Request $request)
	{
		$newaccount = new Accounts();
		$rowsPerPage =5;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();

			$id_match = $request->Input('id');
			$oper1 = $request->Input('id_oper');
			if ($oper1 == 'like') {
		        $id = "'" . $id_match . "%" . "'";
		    }
		    else {
		        $id = "'" . $id_match . "'";
		    }
		    $cond0 = "c1.contactid " . $oper1 . " " . $id;

		    $fname_match = $request->Input('fname');
			$oper2 = $request->Input('fname_oper');
			if ($oper2 == 'like') {
		        $fname = "'" . $fname_match . "%" . "'";
		    }
		    else {
		        $fname = "'" . $fname_match . "'";
		    }
		    $cond1 = "c1.fname " . $oper2 . " " . $fname;

		    $lname_match = $request->Input('lname');
			$oper3 = $request->Input('lname_oper');
			if ($oper3 == 'like') {
		        $lname = "'" . $lname_match . "%" . "'";
		    }
		    else {
		        $lname = "'" . $lname_match . "'";
		    }
		    $cond2 = "c1.lname " . $oper3 . " " . $lname;

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
			$cond0 = "c1.contactid like '%'";
			$cond1 = "c1.fname like '%'";
			$cond2 = "c1.lname like '%'";	

			$id_match = '';
			$fname_match = '';
			$lname_match = '';

			$oper1 = "like";
			$oper2 = "like";
			$oper3 = "like";

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;
			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;

		}

		$data['results'] = $newaccount->getContacts4sa($cond,$offset,$rowsPerPage);
		$data['numrows'] = $newaccount->getContactscount($cond);

		$numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);

        $data['id_oper'] = $oper1;
		$data['fname_oper'] = $oper2;
		$data['lname_oper'] = $oper3;
		$data['id_match'] = $id_match;
		$data['fname_match'] = $fname_match;
		$data['lname_match'] = $lname_match;

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
		    $data['prev'] = " <a href=\"test_laravel/accounts/?page=$page&totpages=$totpages&id=$id_match&id_oper=$oper1&fname=$fname_match&fname_oper=$oper2&lname=$lname_match&lname_oper=$oper3\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/accounts/?page=1&totpages=$totpages&id=$id_match&id_oper=$oper1&fname=$fname_match&fname_oper=$oper2&lname=$lname_match&lname_oper=$oper3\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/accounts/?page=$page&totpages=$totpages&id=$id_match&id_oper=$oper1&fname=$fname_match&fname_oper=$oper2&lname=$lname_match&lname_oper=$oper3\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/accounts/?page=$totpages&totpages=$totpages&id=$id_match&id_oper=$oper1&fname=$fname_match&fname_oper=$oper2&lname=$lname_match&lname_oper=$oper3\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('contacts.contacts')->with($data);

		// echo "<pre>";
		// print_r($data); exit;

	}






}



?>