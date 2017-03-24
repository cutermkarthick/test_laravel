<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class TestMatrix extends Model
{
	public function get_earlist_nxtdue4bom($tanknum)
	{
		try {
	        $result = DB::table('test_matrix as tm')
	        			->join('test_matrix_li as tli','tm.recnum','=','tli.link2testmatrix')
	        			->select('tm.recnum as tmrec','tli.recnum as tlirec',  'tm.tank_num','tli.link2testmatrix',
	        					 'tli.analysis_freq', 'tli.reminder')
	        			->where('tm.tank_num', '=', $tanknum)
	        			->orderBy('tli.reminder','asc')
        				->limit(1)
	        			->get();
	        return $result;
	    }catch(QueryException $e){
        	die("Get Tank master Li record Failed. " . $e->getMessage());
        }
	}

	public function get_tankdatalud($link2testmatrix)
	{

        try{
        	$result = DB::table('tm_xsaction as tms')
	        			->select('tms.recnum','tms.link2testmatrix','tms.created_date',  'tms.status')
	        			->where('tms.link2testmatrix', '=', $link2testmatrix)
	        			->orderBy('tms.recnum','desc')
        				->limit(1)
	        			->get();
	        return $result;
        }catch(QueryException $e){
        	die("Get Tank master Li record Failed. " . $e->getMessage());
        }
	}

	public function update_nxtdue4bomli($lirecnum, $value)
	{

        $result = DB::table('bom_line_items as bli')
        			->where('bli.recnum', '=', $lirecnum)
        			->update([
        				'bli.earlist_nxtdue' => $value['tank_reminder'],
        				'bli.tank_lud' => $value['last_update_date'],
        				'bli.earlist_analysis_freq' => $value['tank_freq']
        				]);
        return $result;
	}

	public function update_nxtdue4bom($recnum, $value, $tanknum)
	{	

		$result = DB::table('bom as b')
        			->where('b.recnum', '=', $recnum)
        			->update([
        				'b.earlist_nxtdue' => $value['tank_reminder'],
        				'b.tank_lud' => $value['last_update_date'],
        				'b.earlist_analysis_freq' => $value['tank_freq'],
        				'b.tank_num' => $tanknum
        				]);
        return $result;
	}

}

?>