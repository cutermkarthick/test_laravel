<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Custgrn;
use View;

class CustGrnController extends Controller
{

	public function custgrn_summary(Request $request)
	{
		$newgrn = new Custgrn();
		$rowsPerPage =100;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$grn_match = $request->Input('grnnum');
			$cond0 = "cg.grnnum like '". $grn_match . "%' ";

			$supp_match = $request->Input('supplier');
			$cond1 = "c.name like '". $supp_match . "%' ";

			$pin_match = $request->Input('pinnum');
			$cond2 = "cg.pin_no like '". $pin_match . "%' ";

			$condition = $request->Input('status');
			$sval = $condition;
		   	if($condition == 'All')
		   	{
		      	$cond3 = " cg.status IN('Open' ,'Pending', 'Closed', 'Cancelled')" ;
		  	}
		  	else 
		  	{
		    	$cond3 = " cg.status ='$condition'" ;
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
			

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2. ' and ' . $cond3;
			$offset = ($pageNum - 1) * $rowsPerPage;

		}
		else
		{
    		$cond0 = "cg.grnnum like '%' ";
			$cond1 = "c.name like '%'";
			$cond2 = "cg.pin_no like '%'";
			$cond3 = "cg.status IN('Open' ,'Pending', 'Closed', 'Cancelled')" ;


			$grn_match = '';
			$supp_match = '';
			$pin_match = '';
			$sval = 'All';

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2. ' and ' . $cond3;
			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;

        }

        $data['results'] = $newgrn->getgrns($cond,$offset,$rowsPerPage);
        $data['numrows'] = $newgrn->getgrncount($cond);
        $numrows = $data['numrows'][0]->numrows;
		$maxPage = ceil($numrows/$rowsPerPage);
		$data['sval'] = $sval;
		$data['grn_match'] = $grn_match;
		$data['supp_match'] = $supp_match;
		$data['pin_match'] = $pin_match;
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
		    $data['prev'] = " <a href=\"test_laravel/custgrn/?page=$page&totpages=$totpages&grnnum=$grn_match&supplier=$supp_match&status=$sval&pinnum=$pin_match\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/custgrn/?page=$page&totpages=$totpages&grnnum=$grn_match&supplier=$supp_match&status=$sval&pinnum=$pin_match\">[First Page]</a> ";
		}
		else
		{
		    $data['prev'] = " [Prev]  ";
			$data['first'] = " [First Page] ";
		}
		if ($pageNum < $totpages)
		{
		    $page = $pageNum + 1;
		    $data['page'] = $pageNum + 1;
		    $data['next'] = " <a href=\"test_laravel/custgrn/?page=$page&totpages=$totpages&grnnum=$grn_match&supplier=$supp_match&status=$sval&pinnum=$pin_match\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/custgrn/?page=$page&totpages=$totpages&grnnum=$grn_match&supplier=$supp_match&status=$sval&pinnum=$pin_match\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = " [Next] ";
    		$data['last'] = " [Last Page] ";
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('custgrn.custgrn')->with($data);

        

	}

}


?>