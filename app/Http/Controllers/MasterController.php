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
		$data['linotes'] = $newps->getNotes4ps($recnum);   
		return View::make('process_sheet.psDetails')->with($data);
	}

	public function editps($recnum)
	{	
		$newps = new ProcessSheet();
		$data['details'] = $newps->getPSDetails($recnum);
		$data['lidetails'] = $newps->getPS_LiDetails($recnum);
		// $data['linotes'] = $newps->getNotes4ps($recnum);
		$data['list_tanks'] = $newps->gettanknum4ps();
		return View::make('process_sheet.edit_ps')->with($data);
		
	}

	public function copyps($recnum)
	{
		$newps = new ProcessSheet();
		$data['details'] = $newps->getPSDetails($recnum);
		$data['lidetails'] = $newps->getPS_LiDetails($recnum);
		$data['list_tanks'] = $newps->gettanknum4ps();
		return View::make('process_sheet.copy_ps')->with($data);
	}

	public function submit_psedit(Request $request)
	{
		$newps = new ProcessSheet();
		
		$data['bomnum'] = $request->input('bomnum');
		$data['type'] = $request->input('type');
		$data['desc'] = $request->input('desc');
		$data['bomdate'] = $request->input('bomdate');
		$data['status'] = $request->input('status');
		$data['quoterecnum'] = $request->input('quoterecnum');
		$data['companyrecnum'] = $request->input('companyrecnum');
		$data['serecnum'] = $request->input('serecnum');
		$data['issue'] = $request->input('issue');

		$data['approved'] = $request->input('approved');
		$data['approved_by'] = $request->input('approved_by');
		$data['app_date'] = $request->input('app_date');
		$data['qa_approved'] = $request->input('qa_approved');
		$data['qa_approved_by'] = $request->input('qa_approved_by');
		$data['qa_app_date'] = $request->input('qa_app_date');
		$data['bomrecnum'] = $request->input('bomrecnum');

		$newps->updateBom($data);

		$notes = $request->input('notes');
		// $newps->addNotes4ps($data['bomrecnum'], $notes);

        $i = 1;
        $max = $request->input('index');

        while ($i < $max) {
        	$linenumber="linenum" . $i;
	        $prevlinenumber="prevlinenum" . $i;
	        $itemname="itemname" . $i;
	      	$lirecnum="lirecnum" . $i;
	        $itemdesc="itemdesc" . $i;
	        $value="value" . $i;
	        $comments="comments" . $i;
	        $vendrecnum="vendrecnum" . $i;
	        $partrecnum="partrecnum" . $i;
	        $workcenter="workcenter" . $i;
	        $optemp_min="optemp_min" . $i;
	        $optemp_max="optemp_max" . $i;               
	        $qty_check="qty_check" . $i;                
	        $paint_check="paint_check" . $i;                
	        $time_check="time_check" . $i;  
	        $form2="form2" . $i;
	        $ps_tanknum="ps_tanknum" . $i;

	        $data1['linenumber'] = $request->input($linenumber);
	        $data1['prevlinenum'] = $request->input($prevlinenumber);
	        $data1['itemname'] = $request->input($itemname);
	        $data1['lirecnum'] = $request->input($lirecnum);
	        $data1['itemdesc'] = $request->input($itemdesc);
	        $data1['value'] = $request->input($value);
	        $data1['comments'] = $request->input($comments);
	        $data1['vendrecnum'] = $request->input($vendrecnum);
	        $data1['partrecnum'] = $request->input($partrecnum);
	        $data1['workcenter'] = $request->input($workcenter);
	        $data1['optemp_min'] = $request->input($optemp_min);
	        $data1['optemp_max'] = $request->input($optemp_max);
	        $data1['qty_check'] = $request->input($qty_check);
	        $data1['paint_check'] = $request->input($paint_check);
	        $data1['time_check'] = $request->input($time_check);
	        $data1['form2'] = $request->input($form2);
	        $data1['ps_tanknum'] = $request->input($ps_tanknum);
	        $data1['bomrecnum'] = $request->input('bomrecnum');

	        if($data1['prevlinenum'] !='')
			{
				
				if ($data1['linenumber'] != '')
				{

			  		$newps->updateLI($data1);
			  
			  	}
			  	else
			  	{	
			  		
			  		$newps->deleteLI($data1);
			  	}
			}
			else
			{
				$newps->addLI();
			}

        	$i++;
        }

		return redirect()->route('ps_details', ['recnum' => $data['bomrecnum']]);
	}

	public function submit_pscopy(Request $request)
	{	
		$input = $request->all();
		echo "<pre>";
		print_r($input); exit;
	}

}