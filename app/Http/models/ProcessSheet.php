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

	public function getPS_LiDetails($recnum)
	{
		$result = DB::table('bom_line_items as li')
					->leftjoin('test_matrix as tm','li.li_tanknum' ,'=', 'tm.recnum')
					->select('li.line_num', 'li.item_name', 'li.item_desc', 'li.item_value',
		                       'li.supplied_by', 'li.mfr', 'li.mfr_pn', 'li.qty', 'li.rate', 'li.amount',
		                       'li.comments', 'li.recnum','li.item_name','li.link2vendor',
          					   'li.link2parts','li.workcenter', 'li.optemp_min', 'li.immtime_min', 
		                       li.optemp_max, li.immtime_max,li.qty_check,li.paint_check,
		                       li.time_check,li.hour,li.min,li.ps_cr_date,li.ps_cr_time,tm.tank_num,
		                       li.form1,li.form2)
	}

}
