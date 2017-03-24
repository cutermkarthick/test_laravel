<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Tmmaster;
use View;

class TM_MasterController extends Controller
{

	public function tm_summary(Request $request)
	{	
		$newtm = new Tmmaster();
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
		    $cond0 = "tm.recnum " . $oper1 . " " . $recnum;


			$tank_match = $request->Input('tank_num');
			$oper2 = $request->Input('tank_oper');

			if ($oper1 == 'like') {
		        $tank = "'" . $tank_match . "%" . "'";
		    }
		    else {
		        $tank = "'" . $tank_match . "'";
		    }
		    $cond1 = "tm.tank_num " . $oper2 . " " . $tank;


			$tankname_match = $request->Input('tank_name');
			$oper3 = $request->Input('tname_oper');

			if ($oper1 == 'like') {
		        $tankname = "'" . $tankname_match . "%" . "'";
		    }
		    else {
		        $tankname = "'" . $tankname_match . "'";
		    }
		    $cond2 = "tm.tank_name " . $oper3 . " " . $tankname;




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
    		$cond0 = "tm.recnum like '%'";
			$cond1 = "tm.tank_num like '%'";
			$cond2 = "tm.tank_name like '%'";


			$recnum_match = '';
			$tank_match = '';
			$tankname_match = '';
			$oper1 = "like";
			$oper2 = "like";
			$oper3 = "like";

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;
			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;

        }

        $data['results'] = $newtm->gettest_matrix_summary($cond,$offset,$rowsPerPage);
        $data['numrows'] = $newtm->gettmcount($cond);

        $numrows = $data['numrows'][0]->numrows;
        $maxPage = ceil($numrows/$rowsPerPage);
        $data['rec_oper'] = $oper1;
		$data['tank_oper'] = $oper2;
		$data['tname_oper'] = $oper3;
		$data['recnum_match'] = $recnum_match;
		$data['tank_match'] = $tank_match;
		$data['tankname_match'] = $tankname_match;
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
		    $data['prev'] = " <a href=\"test_laravel/testmatrix/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&tank=$tank_match&tank_oper=$oper2&tankname=$tankname_match&tname_oper=$oper3\">[Prev]</a>  ";
			$data['first'] = " <a href=\"test_laravel/testmatrix/?page=1&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&tank=$tank_match&tank_oper=$oper2&tankname=$tankname_match&tname_oper=$oper3\">[First Page]</a> ";
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
		    $data['next'] = " <a href=\"test_laravel/testmatrix/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&tank=$tank_match&tank_oper=$oper2&tankname=$tankname_match&tname_oper=$oper3\">[Next]</a> ";
    		$data['last'] = " <a href=\"test_laravel/testmatrix/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&tank=$tank_match&tank_oper=$oper2&tankname=$tankname_match&tname_oper=$oper3\">[Last Page]</a> ";
		}
		else
		{
		    $data['next'] = ' [Next] ';      
		    $data['last'] = ' [Last Page] '; 
		}
		
		$data['pageNum'] = $pageNum;
		$data['totpages'] = $totpages;

		return View::make('tm_master.tmmaster')->with($data);

        
	}

	public function periodic_summary(Request $request)
	{
		$newtm = new Tmmaster();
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
		    $cond0 = "p.recnum " . $oper1 . " " . $recnum;


			$proc_match = $request->Input('procname');
			$oper2 = $request->Input('proc_oper');

			if ($oper1 == 'like') {
		        $proc = "'" . $proc_match . "%" . "'";
		    }
		    else {
		        $proc = "'" . $proc_match . "'";
		    }
		    $cond1 = "p.procname " . $oper2 . " " . $proc;


			$subproc_match = $request->Input('sub_procname');
			$oper3 = $request->Input('subproc_oper');

			if ($oper1 == 'like') {
		        $subproc = "'" . $subproc_match . "%" . "'";
		    }
		    else {
		        $subproc = "'" . $subproc_match . "'";
		    }
		    $cond2 = "p.sub_procname " . $oper3 . " " . $subproc;


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

			$cond0 = "p.recnum like '%'";
			$cond1 = "p.procname like '%'";
			$cond2 = "p.sub_procname like '%'";

			$recnum_match = '';
			$proc_match = '';
			$subproc_match = '';
			$oper1 = "like";
			$oper2 = "like";
			$oper3 = "like";

			$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond2;
			$pageNum = 1;
			$offset = ($pageNum - 1) * $rowsPerPage;
		}
			$data['results'] = $newtm->getperiodic_summary($cond,$offset,$rowsPerPage);
        	$data['numrows'] = $newtm->getperiodiccount($cond);

        	$numrows = $data['numrows'][0]->numrows;
	        $maxPage = ceil($numrows/$rowsPerPage);
	        $data['rec_oper'] = $oper1;
			$data['proc_oper'] = $oper2;
			$data['subproc_oper'] = $oper3;
			$data['recnum_match'] = $recnum_match;
			$data['proc_match'] = $proc_match;
			$data['subproc_match'] = $subproc_match;
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
			    $data['prev'] = " <a href=\"test_laravel/periodic/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&proc=$proc_match&proc_oper=$oper2&subproc=$subproc_match&subproc_oper=$oper3\">[Prev]</a>  ";
				$data['first'] = " <a href=\"test_laravel/periodic/?page=1&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&proc=$proc_match&proc_oper=$oper2&subproc=$subproc_match&subproc_oper=$oper3\">[First Page]</a> ";
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
			    $data['next'] = " <a href=\"test_laravel/periodic/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&proc=$proc_match&proc_oper=$oper2&subproc=$subproc_match&subproc_oper=$oper3\">[Next]</a> ";
	    		$data['last'] = " <a href=\"test_laravel/periodic/?page=$page&totpages=$totpages&recnum=$recnum_match&rec_oper=$oper1&proc=$proc_match&proc_oper=$oper2&subproc=$subproc_match&subproc_oper=$oper3\">[Last Page]</a> ";
			}
			else
			{
			    $data['next'] = ' [Next] ';      
			    $data['last'] = ' [Last Page] '; 
			}
			
			$data['pageNum'] = $pageNum;
			$data['totpages'] = $totpages;

			return View::make('periodic.periodic')->with($data);

			
        
	}

}


?>