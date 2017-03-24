<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Mfg extends Model
{
	public function getmfgs($cond,$offset,$limit)
	{	

		try{
			$result = DB::table('mfg_order')
	        			->select('recnum','mfg_id','orderdate','mfg_desc',
					    		 'status','tanknum','ps_issue')
	        			->whereRaw($cond)
						->orderBy('recnum', 'desc')
						->offset($offset)
	            		->limit($limit)
						->get();

		}catch(QueryException $e){
			die("Get Mfg didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

		return $result;
	}

	public function getmfgcount($cond)
	{
		try {
			$result = DB::table('mfg_order')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Mfg count didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

}