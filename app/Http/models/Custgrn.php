<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Custgrn extends Model
{

	public function getgrns($cond,$offset,$limit)
	{

		try {
			$result = DB::table('customer_grn as cg')
						->join('company as c','cg.link2customer', '=', 'c.recnum')
						->select('cg.recnum','cg.grnnum','c.name','cg.cust_part_no','cg.cust_po_num',
                      			 'cg.book_date','cg.status','cg.qty','cg.qty_corr','cg.qty_disp',
                      			 'cg.pin_no','cg.approved','cg.qty_used')
						->whereRaw($cond)
						->orderBy('cg.grnnum', 'asc')
						->offset($offset)
	            		->limit($limit)
						->get();
		} catch(QueryException $e){
			die("Get Cust Grn didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getgrncount($cond)
	{
		try{
			$result = DB::table('customer_grn as cg')
						->join('company as c','cg.link2customer', '=', 'c.recnum')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
       	} catch(QueryException $e){
			die("Get Cust Grn Count didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
        return $result;
	}

}


?>