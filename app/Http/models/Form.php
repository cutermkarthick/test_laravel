<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Form extends Model
{
	public function getcofcform1_summary($cond,$offset,$limit)
	{	

		try {
			$result = DB::table('cofc_form1 as c')
						->select('c.recnum','c.partnum','c.partname','c.fairno','c.serialnum',
         					 	 'c.ponum','c.po_linenum','c.sign_by','c.sign_date','c.created_date',
                   				 'c.created_by')
						->whereRaw($cond)
						->orderBy('c.recnum', 'asc')
						->offset($offset)
	            		->limit($limit)
						->get();

		} catch(QueryException $e){
			die("Get Cofc Summary didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getcofcform1_count($cond)
	{
		try {
			$result = DB::table('cofc_form1 as c')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Soln Matrix didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

}



?>