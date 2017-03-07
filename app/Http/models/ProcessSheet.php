<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProcessSheet extends Model
{
	public function getps_summary($cond)
	{
		
		$result = DB::table('bom as b')
					->join('employee as e', 'e.recnum', '=', 'b.bom2seowner')
					->select('b.bomnum', 'b.bomdate', 'b.bomdescr',
		                      'b.bomamount', 'b.status', 'b.recnum','b.bomamount',
							  'b.status','b.makebuy','b.workcenter',
							  'e.fname', 'b.issue')
					->orderBy('b.bomnum', 'desc')
					->offset(0)
            		->limit(10)
					->get();

		return $result;
	}

	public function getPSDetails($recnum)
	{
	
		$result = DB::table('bom as b')
					->leftjoin('employee as e','b.bom2seowner', '=', 'e.recnum')
					->leftjoin('quote as q','b.link2quote', '=', 'q.recnum')
					->leftjoin('work_order as w','b.link2wo', '=', 'w.recnum')
					->select('b.bomnum', 'b.type', 'b.bomdescr','b.bomdate', 'b.bomamount',
							'b.status','b.recnum','b.bom2seowner','b.link2wo','w.wonum',
							'b.link2quote','q.id','b.workcenter', 'b.issue', 'e.fname','e.lname',
							'b.approved_by','b.approved','b.app_date', 'b.qa_approved_by','b.qa_approved',
							'b.qa_app_date','b.formatnum','b.formatrev')
					->where('b.recnum','=',$recnum)
					->get();

		return $result;
	}

	public function getPS_LiDetails($link2bom)
	{
		$result = DB::table('bom_line_items as li')
					->leftjoin('test_matrix as tm','li.li_tanknum' ,'=', 'tm.recnum')
					->select('li.line_num', 'li.item_name', 'li.item_desc', 'li.item_value',
		                       'li.supplied_by', 'li.mfr', 'li.mfr_pn', 'li.qty', 'li.rate', 'li.amount',
		                       'li.comments', 'li.recnum','li.item_name','li.link2vendor',
          					   'li.link2parts','li.workcenter', 'li.optemp_min', 'li.immtime_min', 
		                       'li.optemp_max', 'li.immtime_max','li.qty_check','li.paint_check',
		                       'li.time_check','li.hour','li.min','li.ps_cr_date','li.ps_cr_time','tm.tank_num',
		                       'li.form1','li.form2')
					->where('li.link2bom','=',$link2bom)
					->get();

		return $result;
	}

	public function getNotes4ps($recnum) 
	{

      	$result = DB::table('process_sheet_notes as ps')
      				->join('bom as b','ps.link2ps','=','b.recnum')
      				->join('user as u','ps.link2user','=','u.recnum')
      				->select('ps.create_date', 'ps.psnotes', 'u.userid')
      				->where('b.recnum','=',$recnum)
      				->orderBy('ps.recnum','desc')
      				->get();
     
     	return $result;
  	}

  	public function gettanknum4ps($value='')
  	{
  		$result = DB::table('test_matrix')
  					->select([DB::RAW('Distinct(tank_num)'),'recnum'])
  					->get();
  		return $result;
  	}

  	public function updateBom($value)
  	{

  		$app_date = (isset($value['app_date']) ? $value['app_date'] : NULL);
  		$qa_app_date = (isset($value['qa_app_date']) ? $value['qa_app_date'] : NULL);
  		$value['approved'] = (isset($value['approved']) ? $value['approved'] : '');
  		$value['qa_approved'] = (isset($value['qa_approved']) ? $value['qa_approved'] : '');

  		$result = DB::table('bom')
            		->where('recnum', $value['bomrecnum'])
	            	->update(['bomnum' => $value['bomnum'],
							'bomdate' =>  $value['bomdate'],
							'bomdescr' =>  $value['desc'],
							'bom2seowner' => $value['serecnum'], 
							'status' =>  $value['status'], 
							'type' =>  $value['type'], 
							'link2quote' =>  $value['quoterecnum'], 
							'issue' =>  $value['issue'], 
							'approved' =>  $value['approved'], 
							'approved_by' =>  $value['approved_by'], 
							'app_date' =>  $app_date, 
							'qa_approved' =>  $value['qa_approved'], 
							'qa_approved_by' =>  $value['qa_approved_by'], 
							'qa_app_date' => $qa_app_date, 
							]);
	    return $result;
	}

	public function updateLI($value)
	{

		$result = DB::table('bom_line_items')
            		->where('recnum', $value['bomrecnum'])
	            	->update(['line_num' => $value['linenumber'],
							'item_name' => $value['itemname'],
							'item_desc' => $value['itemdesc'],
							'item_value' => $value['value'], 
							'comments' => $value['comments'], 
							'workcenter' => $value['workcenter'], 
							'optemp_min' => $value['optemp_min'], 
							'optemp_max' => $value['optemp_max'], 
							'qty_check' => $value['qty_check'], 
							'paint_check' => $value['paint_check'], 
							'time_check' => $value['time_check'], 
							'li_tanknum' => $value['ps_tanknum'], 
							'form2' => $value['form2'], 
							]);
	    return $result;
	}

	public function addNotes4ps($recnum, $notes)
	{
		
	}

}
