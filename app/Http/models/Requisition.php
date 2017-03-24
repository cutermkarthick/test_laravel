<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Requisition extends Model
{

	public function getrequisition_summary($cond,$offset,$limit)
	{	

		try {
			$result = DB::table('requisition')
						->select('recnum','partnum_req','qty_req','units','grn',
        			   			 'batchnum','ponum','expiry_date','tanknum','status')
						->whereRaw($cond)
						->orderBy('recnum', 'desc')
						->offset($offset)
	            		->limit($limit)
						->get();

		} catch(QueryException $e){
			die("Get Requisition didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getrequisition_count($cond)
	{
		try {
			$result = DB::table('requisition')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Requisition count didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

}