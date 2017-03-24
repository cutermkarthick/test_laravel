<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Fair extends Model
{

	public function getFairs($cond,$offset,$limit)
	{	

		try{
				$result = DB::table('fair as fa')
						->select('fa.recnum','fa.crn','fa.wonum','fa.cofc','fa.wo_date',
                        		 'fa.type','fa.nc','fa.status')
						->whereRaw($cond)
						->orderBy('fa.recnum', 'asc')
						->offset($offset)
	            		->limit($limit)
						->get();

		} catch(QueryException $e){
			die("Get Fair Work orders didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getFairscount($cond)
	{
		try {
			$result = DB::table('fair as fa')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Fair conut didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

}


?>