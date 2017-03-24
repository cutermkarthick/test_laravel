<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Tmmaster extends Model
{
	public function gettest_matrix_summary($cond,$offset,$limit)
	{	


		try {
			$result = DB::table('test_matrix as tm')
						->join('test_matrix_li as tli','tm.recnum', '=', 'tli.link2testmatrix')
						->select('tm.recnum','tm.tank_num','tm.tank_name','tli.line_num','tli.link2testmatrix', 
                       			 'tli.constituent','tli.spec_low','tli.target_low','tli.target_high','tli.spec_high',
                       			 'tli.unit','tli.analysis_freq','tli.atpl_proc_ref','tm.procname','tli.reminder')
						->whereRaw($cond)
						->orderBy('tm.recnum', 'asc')
						->offset($offset)
	            		->limit($limit)
						->get();

		} catch(QueryException $e){
			die("Get Soln Matrix didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function gettmcount($cond)
	{
		try {
			$result = DB::table('test_matrix as tm')
						->join('test_matrix_li as tli','tm.recnum', '=', 'tli.link2testmatrix')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Soln Matrix didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getperiodic_summary($cond,$offset,$limit)
	{

        try {
			$result = DB::table('periodic as p')
						->join('periodic_li as pli','p.recnum', '=', 'pli.link2periodic')
						->select('p.recnum','p.procname','pli.line_num','pli.link2periodic', 'pli.method',
                       			 'pli.procedure','pli.frequency','pli.material','pli.periodic_test',
                   				 'pli.customer_ref','pli.procedure_ref','p.sub_procname','p.part_num')
						->whereRaw($cond)
						->orderBy('p.recnum', 'asc')
						->offset($offset)
	            		->limit($limit)
						->get();

		} catch(QueryException $e){
			die("Get Periodic Matrix didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getperiodiccount($cond)
	{
		try {
			$result = DB::table('periodic as p')
						->join('periodic_li as pli','p.recnum', '=', 'pli.link2periodic')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Periodic count Matrix didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}	

}


?>