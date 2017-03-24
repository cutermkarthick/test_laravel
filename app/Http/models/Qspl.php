<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Qspl extends Model
{

	public function getspmfrmasterdata($cond,$offset,$limit)
	{

        try {

        	$result = DB::table('spmfrmaster as sp')
					->select('sp.recnum','sp.arp_id','sp.company_name','sp.city','sp.country','sp.ref_no','sp.title','sp.ref_no_pi','sp.title_pi','sp.special_process','sp.status','sp.limitation','sp.from_date','sp.to_date')
					->whereRaw($cond)
					->orderBy('sp.recnum', 'asc')
					->offset($offset)
            		->limit($limit)
					->get();

       	} catch(QueryException $e){
			die("Get Qspl for Airbus didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

		return $result;
	}

	public function getspmfrcount($cond)
	{
		try {

			$result = DB::table('spmfrmaster as sp')
        			->select(DB::raw('count(*) as numrows'))
        			->whereRaw($cond)
        			->get();

        return $result;
		} catch(QueryException $e){
			die("Get Qspl for Airbus count didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

        return $result;
	}
}


?>