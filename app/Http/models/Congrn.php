<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Congrn extends Model
{

	public function getgrns($cond,$offset,$limit)
	{

		try {
			$result = DB::table('grn as g')
						->join('company as c','g.link2vendor', '=', 'c.recnum')
						->select('g.recnum','g.grnnum','c.name','g.raw_mat_spec','g.raw_mat_type',
	                    		 'g.num_of_pieces', 'g.invoice_num','g.invoice_date','g.status','g.qtm',
	                        	 'g.qty_used',DB::raw('(g.qtm - g.qty_used) as balance'),'g.pin_no',
	                        	 'g.cos','g.part_issue','g.drg_issue','g.remarks','g.partname',
	                    		 'g.partnum','g.raw_mat_code','g.master_type')
						->whereRaw($cond)
						->orderBy('g.grnnum', 'asc')
						->offset($offset)
	            		->limit($limit)
						->get();
		} catch(QueryException $e){
			die("Get Cons Grn didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getgrncount($cond)
	{
		try{
			$result = DB::table('grn as g')
						->join('company as c','g.link2vendor', '=', 'c.recnum')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
       	} catch(QueryException $e){
			die("Get Cons Grn Count didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
        return $result;
	}

}

?>