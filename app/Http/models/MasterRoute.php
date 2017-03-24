<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class MasterRoute extends Model
{

	public function getroutemaster_summary($cond, $argoffset,$arglimit)
	{
		$offset = $argoffset;
        $limit = $arglimit;

       	$result = DB::table('master_route_process')
       				->select('recnum','doc_id','customer','issue', 'status',
        			   		'date as mrs_date','check_spec_std')
       				->whereRaw($cond)
       				->orderBy('recnum', 'asc')
       				->offset($offset)
            		->limit($limit)
					->get();
		return $result;

	}

	public function getroutemaster_count($cond)
	{

        $result = DB::table('master_route_process')
        			->select(DB::raw('count(*) as numrows'))
        			->whereRaw($cond)
        			->get();
        return $result;
	}

	public function getmasterroute_details($recnum)
	{	
		try {
	       	$result = DB::table('master_route_process')
	       				->select('recnum','doc_id', 'customer','issue','status',
								'date','scope','reference','response','approved', 'approved_by',
								'approved_date','qa_approved','qa_approved_by','qa_app_date',
								'formatnum','formatrev')
	       				->where('recnum','=', $recnum)
	       				->get();
		
       	} catch(QueryException $e){
		  die("Get MRS Failed..Please report to Sysadmin. " . $e->getMessage());
		}
       	return $result;
	}

	public function getmaster_routeLI($recnum)
	{
		try {
	        $result = DB::table('master_route_process as mr')
	        			->join('master_route_process_li as mrli','mr.recnum','=','mrli.link2routemaster')
	       				->select('mrli.recnum','mrli.linenum','mrli.op_num','mrli.desc','mrli.ps_no',
	          					 'mrli.spec','mrli.dept', 'mrli.std_iss_ref','mrli.check_std_iss',
	                       		 'mrli.display','mrli.link2ps','mrli.ps_issue')
	       				->where('mrli.link2routemaster','=', $recnum)
	       				->orderBy('mrli.linenum','asc')
	       				->get();
       	} catch(QueryException $e){
		  die("Get MRS LI Failed..Please report to Sysadmin. " . $e->getMessage());
		}
       	return $result;

	}

	public function getNotes4mrs($mrrecnum)
	{
		$result = DB::table('master_route_notes as n')
      				->join('master_route_process as mrs','n.link2mrs','=','mrs.recnum')
      				->join('user as u','n.link2user','=','u.recnum')
      				->select('n.create_date', 'n.mrsnotes', 'u.userid')
      				->where('mrs.recnum','=',$mrrecnum)
      				->orderBy('mrs.recnum','desc')
      				->get();
     	return $result;
	}

	public function getmr_rev_history($mrrecnum)
	{


        $result = DB::table('revision_history')
        			->select('recnum', 'rev_num','rev_date','desc','owner',
		                     'link2doc','doc','doc_id','approved_by','approved',
		                     'approved_date')
        			->where('doc', '=', 'MR')
        			->where('link2doc', '=', $mrrecnum)
        			->get();
       	return $result;
	}

	public function addmaster_routing($value)
	{
		$userid = session('user');
		$doc_id = $value['doc_id'];        
		$count = DB::table('master_route_process')
					->select('*')
					->whereRaw("doc_id = '$doc_id' and (status = 'Active' || status = 'Pending') ")
					->count();

		if ($count == 0) 
		{
			try {
			   $insertid = DB::table('master_route_process')->insertGetId(
							    ['doc_id' => $value['doc_id'],
							    'issue' => $value['issue'],
							    'customer' => $value['customer'],
							    'date' => $value['date'],
							    'scope' => $value['scope'] ,
							    'response' => $value['response'],
							    'reference' => $value['reference'],
							    'status' => 'Pending',
							    'created_date' => DB::raw('curdate()'),
							    'modified_date' => DB::raw('curdate()'),
							    'created_by' => $userid,
							    'modified_by' => $userid,
							    'formatnum' => $value['issue'],
							    'formatnum' => 'F3003', 
							    'formatrev' => 'Rev 1 dt Mar 17,2016']);
			} catch(QueryException $e){
			  die("Insert to Master Routing didn't work..Please report to Sysadmin. " . $e->getMessage());
			}
		}
		else
        {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Doc Id  " . $doc_id . " already exists. ");
            echo "</td></tr></table>";
        }

        return $insertid;
	}

	public function addNotes4mrs($recnum, $notes)
	{	
		 
		$link2user = session('userrecnum');
		$result = DB::table('master_route_notes')->insert([
					    'mrsnotes' => $notes,
					    'link2mrs' => $recnum,
					    'link2user' => $link2user,
					    'create_date' => DB::raw('curdate()')
					]);
		return $result;
	}

	public function addmaster_routing_li($value)
	{
		try {
		   $insertid = DB::table('master_route_process_li')->insertGetId(
						    ['link2routemaster' => $value['mrp_recnum'],
						    'linenum' => $value['linenum'],
						    'op_num' => $value['op_no'],
						    'desc' => $value['desc'],
						    'ps_no' => $value['ps_no'] ,
						    'spec' => $value['spec'],
						    'dept' => $value['dept'],
						    'std_iss_ref' => $value['std_iss'],
						    'created_date' => DB::raw('curdate()'),
						    'display' => $value['display'],
						    'link2ps' => $value['ps_recnum'], 
						    'ps_issue' => $value['ps_issue'] ]);
		} catch(QueryException $e){
		  die("Insert to Master Routing LI didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

		return $insertid;
	}

	public function getspec4mrs($value='')
	{
		

		$result = DB::table('stdmaster as s')
					->join('stdmaster_li as sli','sli.link2std','=', 's.recnum')
					->join('spmfrmaster as qspl','s.std_no','=', 'qspl.ref_no')
        			->select('s.recnum','s.std_no', 's.create_date','sli.line_num','sli.status',
							 'sli.iss_of_ref','sli.iss_date')
        			->where('sli.status', '=', 'Active')
        			->whereRaw("(curdate() >= qspl.from_date and curdate() <= qspl.to_date) ")
        			->orderBy('s.std_no', 'asc')
        			->get();
       	return $result;
	}

	public function getAll_ProcessSheetno($value='')
	{
        $result = DB::table('bom')
        			->select('recnum','bomnum','issue')
        			->where('status', '=', 'Active')
        			->orderBy('recnum', 'asc')
        			->get();
       	return $result;
	}

	public function get_psnextdue4tank($psrecnum)
	{
		try {
	        $result = DB::table('bom_line_items as bli')
						->select('bli.recnum','bli.item_value','bli.earlist_nxtdue','bli.tank_lud',
	                      		 'bli.earlist_analysis_freq')
						->where('bli.link2bom','=',$psrecnum)
						->whereRaw("bli.earlist_nxtdue != '' or bli.earlist_nxtdue IS NOT NULL or bli.earlist_nxtdue != '0000-00-00'")
						->orderBy('bli.earlist_nxtdue', 'asc')
						->limit(1)
						->get();

		} catch(QueryException $e){
		  die("Get PS next Due4tank Failed..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function update_nxtdue4mrs($value)
	{
		
		try {
        	$result = DB::table('master_route_process_li as mrli')
	            		->where('mrli.recnum', $value['recnum'])
		            	->update(['mrli.earlist_nxtdue' => $value['tank_reminder'],
		            			 'mrli.tank_lud' => $value['last_update_date'],
		            			 'mrli.earlist_analysis_freq' => $value['tank_freq'],
		            			 'mrli.tank_num' => $value['tanknum'] ]);
		} catch(QueryException $e){
		  die("Update Nxt Due MRS LI Failed..Please report to Sysadmin. " . $e->getMessage());
		}
	    return $result;
	}

	public function update_nxtdue4master_route($value='')
	{
		try {
        	$result = DB::table('master_route_process as mr')
	            		->where('mr.recnum', $value['mrprecnum'])
		            	->update(['mr.earlist_nxtdue' => $value['tank_reminder'],
		            			 'mr.tank_lud' => $value['last_update_date'],
		            			 'mr.earlist_analysis_freq' => $value['tank_freq'],
		            			 'mr.tank_num' => $value['tanknum'] ]);
		} catch(QueryException $e){
		  die("Update Nxt Due MRS Failed..Please report to Sysadmin. " . $e->getMessage());
		}
	    return $result;
	}

	public function getmr_rev_num($link2mr)
	{	
		$result = DB::table('revision_history')
					->select('rev_num')
					->where('doc', '=', 'MR')
					->where('link2doc', '=', $link2mr)
					->orderBy('recnum', 'desc')
					->limit(1)
					->get();

		if (isset($result[0])) 
      	{	
          	$rev_num = (int)$result[0]->rev_num + 1;
     	}
      	else
      	{	
        	$rev_num = "00";
      	}
		return $rev_num;
	}

	public function getmr_last_rev($link2mr)
	{
		
		$result = DB::table('revision_history')
					->select('*')
					->where('doc', '=', 'MR')
					->where('link2doc', '=', $link2mr)
					->orderBy('recnum', 'desc')
					->limit(1)
					->get();

		return $result;
	}

	public function updatemaster_routing($value='')
	{	


		$result = DB::table('master_route_process')
					->where('recnum','=', $value['masterdatarecnum'])
					->update([ 
							'issue' => $value['issue'],
							'customer' => $value['customer'],
							'date' => $value['date'],
							'scope' => $value['scope'],
							'response' => $value['response'],
							'reference' => $value['reference'],
							'status' => $value['status'],
							'modified_date' => DB::raw('curdate()'),
							'approved' => $value['approved'],
							'approved_by' => $value['approved_by'],
							'approved_date' => $value['app_date'],
						]);
		return $result;
	}

	public function updatemaster_routing_li($value)
	{
		$result = DB::table('master_route_process_li')
					->where('recnum','=', $value['recnum'])
					->where('link2routemaster','=', $value['masterdatarecnum'])
					->update([ 
							'linenum' => $value['linenum'],
							'op_num' => $value['op_no'],
							'desc' => $value['desc'],
							'ps_no' => $value['ps_no'],
							'spec' => $value['spec'],
							'dept' => $value['dept'],
							'modified_date' => DB::raw('curdate()'),
							'std_iss_ref' => $value['std_iss'],
							'display' => $value['display'],
							'link2ps' => $value['ps_recnum'],
							'ps_issue' => $value['ps_issue'],
						]);
		return $result;
	}

	public function delete_master_routingLI($value)
	{

		$result = DB::table('master_route_process_li')
					->where('recnum', '=', $value['recnum'])
					->where('link2routemaster', '=', $value['masterdatarecnum'])
					->delete();
		return $result;

	}

	public function update_revstatus_mr($value)
	{

		$result = DB::table('master_route_process')
					->where('recnum', '=', $value['mrp_recnum'])
					->update([ 
							'rev_num' => $value['rev_num'],
							'rev_status' => $value['rev_status'],
							]);
		return $result;

	}

	public function add_rev_history($value)
	{
		$result = DB::table('revision_history')->insert([
					    'rev_num' => $value['rev_num'],
					    'rev_date' => $value['rev_date'],
					    'desc' => $value['rev_desc'],
					    'owner' => $value['rev_owner'],
					    'link2doc' => $value['mrp_recnum'],
					    'doc' => $value['rev_doc'],
					    'doc_id' => $value['doc_id'],
					    'approved' => $value['rev_approved'],
					    'approved_by' => $value['rev_approved_by'],
					    'approved_date' => $value['rev_app_date']
					]);
		return $result;
	}

	public function update_rev_history($value)
	{
		try {
			$result = DB::table('revision_history')
						->where('link2doc', '=', $value['mrp_recnum'])
						->where('rev_num', '=', $value['rev_num'])
						->where('recnum', '=', $value['rev_recnum'])
						->update([ 
								'desc' => $value['rev_desc'],
								'owner' => $value['rev_owner'],
								'approved_by' => $value['rev_approved_by'],
								'approved' => $value['rev_approved'],
								'approved_date' => $value['rev_app_date']
								]);
		} catch(QueryException $e){
		  die("Update MRS Rev History Failed..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

}

?>