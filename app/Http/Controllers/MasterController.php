<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\ProcessSheet;
use View;

class MasterController extends Controller
{
	public function pssummary($value='')
	{
		$newps = new ProcessSheet();

		if (!empty($_POST)) {
			
		}else{
			$bom_match = '';
			$oper = "like";
			$cond0 = "b.bomnum like'%'";
			$cond1 = " b.status IN('Active' ,'Pending', 'Inactive')" ;
			$sval = "All";

			$cond = $cond0 . ' and ' . $cond1 ;
		}

		$data['results'] = $newps->getps_summary($cond);

		foreach ($data['results'] as $key => $value) {
			$d=substr($value->bomdate,8,2);
            $m=substr($value->bomdate,5,2);
            $y=substr($value->bomdate,0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $psdate=date("M j, Y",$x);
			$data['results'][$key]->psdate = $psdate;
		}
		
		return View::make('process_sheet.ps')->with($data);
	}

	public function psdetails($recnum)
	{
		$newps = new ProcessSheet();
		$data['details'] = $newps->getPSDetails($recnum);
		$data['lidetails'] = $newps->getPS_LiDetails($recnum);
		return View::make('process_sheet.psDetails')->with($data);
		// echo "<pre>";
		// print_r($data['details']);
		// exit;

		
	}
}