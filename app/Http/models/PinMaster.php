<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class PinMaster extends Model
{


	public function getmasterdatas($cond,$argoffset,$arglimit)
	{
		$offset = $argoffset;
        $limit = $arglimit;

		$result = DB::table('master_data as m')
					->select('m.recnum','m.CIM_refnum','m.partname','m.wonum','m.customer',
                        	 'm.rm_type','m.partnum', 'm.pin_type', 'm.status','m.bomnum','m.mrissue')
					->whereRaw($cond)
					->orderBy('m.recnum', 'desc')
					->offset($offset)
            		->limit($limit)
					->get();

		return $result;
	}

	public function getcrncount($cond)
	{
		$result = DB::table('master_data as m')
        			->select(DB::raw('count(*) as numrows'))
        			->whereRaw($cond)
        			->get();
        return $result;
	}

	public function getrouter_master_number($value='')
	{
		try {
			$result = DB::table('master_route_process')
	        			->select('recnum', 'doc_id','issue')
	        			->where('status', '=', 'Active')
	        			->where('approved', '=', 'yes')
	        			->get();

        } catch(QueryException $e){
			die("Get Master routing didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

        return $result;
	}

	public function getmaster_routeLI4pin($mrrecnum)
	{

		try {
			$result = DB::table('master_route_process as mr')
						->join('master_route_process_li as mrli','mr.recnum', '=', 'mrli.link2routemaster')
	        			->select('mrli.recnum', 'mrli.linenum','mrli.op_num','mrli.desc','mrli.ps_no',
                     			 'mrli.spec','mrli.dept','mrli.std_iss_ref','mrli.check_std_iss',
                        		 'mrli.display')
	        			->where('mrli.link2routemaster', '=', $mrrecnum)
	        			->orderBy('mrli.op_num','asc')
	        			->get();

        } catch(QueryException $e){
			die("Get Master routing didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

        return $result;
	}

	public function addmaster_data($value)
	{
		$CIM_refnum = $value['CIM_refnum'];
		$mrissue = $value['mrissue'];
		$result = DB::table('seqnum')
				->select('nxtnum')
				->where('tablename','=','master_data')
				->get();
		$seqnum = $result[0]->nxtnum;
		$objid = $seqnum + 1;

		$count = DB::table('master_data')
					->select('*')
					->whereRaw("CIM_refnum = '$CIM_refnum' and mrissue = '$mrissue' and (status = 'Active' || status = 'Pending') ")
					->count();

		if ($count == 0) 
		{
			try {
				$recnum = DB::table('master_data')->insertGetId([
								'recnum' => $objid,
								'partname' => $value['partname'],
								'customer' => $value['customer'],
								'partnum' => $value['partnum'],
								'RM_by_CIM' => $value['RM_by_CIM'],
								'project' => $value['project'],
								'attachments' => $value['attachments'],
								'RM_by_customer' => $value['RM_by_customer'],
								'CIM_refnum' => $value['CIM_refnum'],
								'bomnum' => $value['mrnum'],
								'drg_issue' => $value['drg_issue'],
								'rm_type' => $value['rm_type'],
								'rm_spec' => $value['rm_spec'],
								'drawing_num' => $value['drawing_num'],
								'cos' => $value['cos'],
								'status' => 'Pending',
								'model_iss' => $value['model_issue'],
								'part_issue' => $value['part_issue'],
								'part_list' => $value['part_list'],
								'mrissue' => $value['mrissue'],
								'tech_sheet_no' => $value['tech_sheet_no'],
								'tech_sheet_issue' => $value['tech_sheet_issue'],
								'pin_type' => $value['pin_type'],
								'link2mr' => $value['mrrecnum']
								]);

			} catch(QueryException $e){
			  die("Insert to Pin Master data didn't work..Please report to Sysadmin. " . $e->getMessage());
			}
		}
		else
		{
			echo "<table border=1><tr><td><font color=#FF0000>";
           	die("CIM Ref Num " . $CIM_refnum . " and MR issue ". $mrissue . " already exists. ");
           	echo "</td></tr></table>";
		}

		try{
        	$result2 = DB::table('seqnum')
        				 ->where('tablename', '=','master_data')
        				 ->update(['nxtnum' => $objid]);

        }catch(QueryException $e){
        	die("Seqnum insert query didn't work ..Please report to Sysadmin. " . $e->getMessage());
        }

		return $objid;

	}

	public function get_tanknxtdue_mrli($link2routemaster)
	{
		try {

                $result = DB::table('master_route_process as mr')
                			->join('master_route_process_li as mrli','mr.recnum', '=', 'mrli.link2routemaster' )
                			->select('mrli.link2ps','mrli.ps_issue','mrli.earlist_nxtdue','mrli.tank_lud',
                        			 'mrli.earlist_analysis_freq','mrli.link2routemaster','mrli.tank_num')
                			->where('mrli.link2routemaster', '=', $link2routemaster)
                			->where('mr.status', '=', 'Active')
                			->whereRaw("(mrli.earlist_nxtdue != '' or mrli.earlist_nxtdue != '0000-00-00' or mrli.earlist_nxtdue IS NOT NULL)")
                			->orderBy('mrli.earlist_nxtdue', 'asc')
                			->limit(1)
                			->get();

		}catch(QueryException $e){
			die("Get Tm master li didn't work ..Please report to Sysadmin. " . $e->getMessage());
		}

		return $result;
	}

	public function update_tanknxtdue_master($value)
	{

        try {

        	$result = DB::table('master_data')
        				->where('recnum', '=', $value['mrrecnum'])
        				->update([
        						'earlist_nxtdue' => $value['pin_nxtdue'],
        						'tank_lud' => $value['pin_tank_lud'],
        						'earlist_analysis_freq' => $value['pin_tank_freq'],
        						'tank_num' => $value['tank_num']
        					]);

    	}catch(QueryException $e){
			die("Get Tm master li didn't work ..Please report to Sysadmin. " . $e->getMessage());
		}

		return $result;
	}

	public function getmasterdata_details($recnum)
	{
		

		try {	
			$result = DB::table('master_data')
						->where('recnum', '=', $recnum)
						->select('recnum','partname','wonum','customer','partnum','RM_by_CIM',
							     'project','attachments','RM_by_customer','CIM_refnum','drg_issue',
                      	 		 'rm_type','rm_spec','rm_dim1','rm_dim2','rm_dim3','mps_rev','mps_num',
                      	 		 'model_iss','cos','part_issue','part_list','ppc_approved', 'ppc_app_date', 
            					 'qa_approved','qa_app_date','mrissue','tech_sheet_no', 'tech_sheet_issue', 
                      			 'pin_type','ppc_approved_by','qa_approved_by','link2mr','status','bomnum','drawing_num')
						->get();
		}catch(QueryException $e){
			die("Get Pin master Details didn't work .Please report to Sysadmin. " . $e->getMessage());
		}

		return $result;
	}

	public function getNotes4pin($recnum)
	{	

		try{
			$result = DB::table('pin_master_notes as pmn')
						->join('master_data as md','md.recnum', '=', 'pmn.link2pin')
						->join('user as u','u.recnum', '=', 'pmn.link2user')
						->where('md.recnum', '=', $recnum)
						->select('pmn.create_date', 'pmn.pin_notes', 'u.userid')
						->get();
		}catch(QueryException $e){
			die("Get Pin master Notes didn't work ..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function updatemaster_data($value)
	{
		try{
			$result = DB::table('master_data')
						->where('recnum','=', $value['masterdatarecnum'])
						->update([
						   'partname' => $value['partname'],
	                       'customer' => $value['customer'],
	                       'partnum' => $value['partnum'],
	                       'project' => $value['project'],
	                       'attachments' => $value['attachments'],
	                       'CIM_refnum' => $value['CIM_refnum'],
	                       'drg_issue' => $value['drg_issue'],
	                       'rm_type' => $value['rm_type'],
	                       'rm_spec' => $value['rm_spec'],
	                       'drawing_num' => $value['drawing_num'],
	                       'cos' => $value['cos'],
	                       'bomnum' => $value['mrnum'],
	                       'status' => $value['status'],
	                       'model_iss' => $value['model_issue'],
	                       'part_issue' => $value['part_issue'],
	                       'part_list' => $value['part_list'],
	                       'ppc_approved_by' => $value['approved_by'],
	                       'ppc_approved' => $value['approved'],
	                       'ppc_app_date' => $value['ppc_app_date'],
	                       'qa_approved' => $value['qa_approved'],
	                       'qa_approved_by' => $value['qa_approved_by'],
	                       'qa_app_date' => $value['qa_app_date'],
				            'mrissue' => $value['mrissue'],
	                       'tech_sheet_no' => $value['tech_sheet_no'],
	                       'tech_sheet_issue' => $value['tech_sheet_issue'],
	                       'pin_type'=> $value['pin_type']
							]);

		}catch(QueryException $e){
			die("Update Pin master  didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

	}

	public function addNotes4pin($value)
	{
		try {
			$link2user = session('userrecnum');
			$result = DB::table('pin_master_notes')->insert([
						    'pin_notes' => $value['notes'],
						    'link2pin' => $value['masterdatarecnum'],
						    'link2user' => $link2user,
						    'create_date' => DB::raw('curdate()')
						]);

		}catch(QueryException $e){
			die("Add notes for PIN  Failed..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}	


}



?>