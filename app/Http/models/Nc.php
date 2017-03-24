<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Nc extends Model
{

	public function getnc4qa($cond,$offset,$limit)
	{
		try {
			$result = DB::table('nc4qa')
						->select('recnum','refnum','customer','partname','bachnum','partnum','wonum',
								 'cofcnum','create_date','status','mc_name')
						->whereRaw($cond)
						->orderBy('recnum', 'asc')
						->offset($offset)
	            		->limit($limit)
						->get();

		} catch(QueryException $e){
			die("Get Nc Summary didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getncCount($cond)
	{
		try {
			$result = DB::table('nc4qa')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Nc Count didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}


}


?>