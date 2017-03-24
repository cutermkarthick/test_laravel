<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class StdMaster extends Model
{
	public function getstdmasterSummary($cond,$offset,$limit)
	{	
		try {
			$result = DB::table('stdmaster as s')
						->join('stdmaster_li as sli','s.recnum', '=', 'sli.link2std')
	       				->select('s.std_no', 's.create_date','sli.line_num','sli.status','sli.iss_of_ref',
								 'sli.iss_date','s.recnum')
	       				->whereRaw($cond)
	       				->orderBy('s.std_no', 'asc')
	       				->offset($offset)
	            		->limit($limit)
						->get();
			
		} catch(QueryException $e){
		  die("Get Std Master Failed..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getstdmastercount($cond)
	{

		 $result = DB::table('stdmaster as s')
		 			->join('stdmaster_li as sli','s.recnum', '=', 'sli.link2std')
        			->select(DB::raw('count(s.recnum) as numrows'))
        			->whereRaw($cond)
        			->get();
        return $result;
	}

	public function add_stdmaster($value)
	{	
		$count = DB::table('stdmaster')
					->select('*')
					->where('std_no', '', $value['standard_num'])
					->count();

		if($count == 0)
		{

			try {
				   $insertid = DB::table('stdmaster')->insertGetId(
								    ['std_no' => $value['standard_num'],
								    'create_date' => DB::raw('curdate()')
								    ]);
			} catch(QueryException $e){
			  die("Insert to Std Master didn't work..Please report to Sysadmin. " . $e->getMessage());
			}

			return $insertid;
		}

	}

	public function addstdmaster_li($value)
	{
		try {
			   	$insertid = DB::table('stdmaster_li')->insertGetId(
								    ['line_num' => $value['line_num'],
								     'iss_of_ref' => $value['iss_of_std'],
								     'iss_date' => $value['iss_date'],
								     'status' => $value['status'],
								     'link2std' => $value['recnum'] ]);
		} catch(QueryException $e){
		  die("Insert to Std Master LI didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
	}

	public function getstdmaster_details($recnum)
	{
		try {

			$result = DB::table('stdmaster')
						->select('std_no','create_date','recnum')
						->where('recnum','=',$recnum)
						->get();

		} catch(QueryException $e){
		  die("Get Std Master didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

		return $result;
	}

	public function getstdmasterli_details($link2std)
	{
		try {

			$result = DB::table('stdmaster_li')
						->select('recnum','line_num','status','iss_of_ref','iss_date','link2std')
						->where('link2std','=',$link2std)
						->get();

		} catch(QueryException $e){
		  die("Get Std Master LI didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

		return $result;

	}

	public function update_stdmaster($value)
	{
		try {

			$result = DB::table('stdmaster')
						->where('recnum','=',$value['recnum'])
						->update(
							['std_no'=> $value['standard_num'],
							'modified_date' => DB::raw('curdate()')
							]);

		} catch(QueryException $e){
		  die("Update Std Master didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

		return $result;
	}

	public function updatestdmaster_li($value)
	{
		try {

			$result = DB::table('stdmaster_li')
						->where('recnum','=',$value['lirecnum'])
						->update(
							['line_num'=> $value['line_num'],
							'status' => $value['status'],
							'iss_date'=> $value['iss_date'],
							'iss_of_ref'=> $value['iss_of_std']
							]);

		} catch(QueryException $e){
		  die("Update Std Master LI didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

		return $result;
	}

	public function deletestdmaster_li($lirecnum)
	{
		$result = DB::table('stdmaster_li')
					->where('recnum', '=', $lirecnum)
					->delete();
		return $result;
	}


}