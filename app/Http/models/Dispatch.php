<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Dispatch extends Model
{
	public function getcofc_summary($cond,$offset,$limit)
	{


		try {
			$result = DB::table('cofc as c')
						->join('company as co','co.recnum', '=', 'c.cofc2customer')
						->select('c.recnum','co.name','c.cust_cofc_no','c.wo_no','c.po_no',
                        		 'c.pin_no','c.qty')
						->whereRaw($cond)
						->orderBy('c.recnum', 'desc')
						->offset($offset)
	            		->limit($limit)
						->get();

		} catch(QueryException $e){
			die("Get Cofc Summary didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getcofc_count($cond)
	{
		try {
			$result = DB::table('cofc as c')
						->join('company as co','co.recnum', '=', 'c.cofc2customer')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Cofc Count didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

}