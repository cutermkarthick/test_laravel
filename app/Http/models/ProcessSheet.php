<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class ProcessSheet extends Model
{
	public function getps_summary($cond,$argoffset,$arglimit)
	{
		$offset = $argoffset;
        $limit = $arglimit;

		$result = DB::table('bom as b')
					->join('employee as e', 'e.recnum', '=', 'b.bom2seowner')
					->select('b.bomnum', 'b.bomdate', 'b.bomdescr',
		                      'b.bomamount', 'b.status', 'b.recnum','b.bomamount',
							  'b.status','b.makebuy','b.workcenter',
							  'e.fname', 'b.issue')
					->whereRaw($cond)
					->orderBy('b.bomnum', 'desc')
					->offset($offset)
            		->limit($limit)
					->get();

		return $result;
	}

	public function getPScount($cond, $argoffset,$arglimit)
	{
		$offset = $argoffset;
        $limit = $arglimit;

        $result = DB::table('bom as b')
        			->join('employee as e','b.bom2seowner','=','e.recnum')
        			->select(DB::raw('count(*) as numrows'))
        			->whereRaw($cond)
        			->get();
        return $result;
		
	}

	public function getPSDetails($recnum)
	{
	
		$result = DB::table('bom as b')
					->leftjoin('employee as e','b.bom2seowner', '=', 'e.recnum')
					->leftjoin('quote as q','b.link2quote', '=', 'q.recnum')
					->leftjoin('work_order as w','b.link2wo', '=', 'w.recnum')
					->select('b.bomnum', 'b.type', 'b.bomdescr','b.bomdate', 'b.bomamount',
							'b.status','b.recnum','b.bom2seowner','b.link2wo','w.wonum',
							'b.link2quote','q.id','b.workcenter', 'b.issue', 'e.fname','e.lname',
							'b.approved_by','b.approved','b.app_date', 'b.qa_approved_by','b.qa_approved',
							'b.qa_app_date','b.formatnum','b.formatrev')
					->where('b.recnum','=',$recnum)
					->get();

		return $result;
	}

	public function getPS_LiDetails($link2bom)
	{
		$result = DB::table('bom_line_items as li')
					->leftjoin('test_matrix as tm','li.li_tanknum' ,'=', 'tm.recnum')
					->select('li.line_num', 'li.item_name', 'li.item_desc', 'li.item_value',
		                       'li.supplied_by', 'li.mfr', 'li.mfr_pn', 'li.qty', 'li.rate', 'li.amount',
		                       'li.comments', 'li.recnum','li.item_name','li.link2vendor',
          					   'li.link2parts','li.workcenter', 'li.optemp_min', 'li.immtime_min', 
		                       'li.optemp_max', 'li.immtime_max','li.qty_check','li.paint_check',
		                       'li.time_check','li.hour','li.min','li.ps_cr_date','li.ps_cr_time','tm.tank_num',
		                       'li.form1','li.form2')
					->where('li.link2bom','=',$link2bom)
					->get();

		return $result;
	}

	public function getNotes4ps($recnum) 
	{

      	$result = DB::table('process_sheet_notes as ps')
      				->join('bom as b','ps.link2ps','=','b.recnum')
      				->join('user as u','ps.link2user','=','u.recnum')
      				->select('ps.create_date', 'ps.psnotes', 'u.userid')
      				->where('b.recnum','=',$recnum)
      				->orderBy('ps.recnum','desc')
      				->get();
     
     	return $result;
  	}

  	public function gettanknum4ps($value='')
  	{
  		$result = DB::table('test_matrix')
  					->select([DB::RAW('Distinct(tank_num)'),'recnum'])
  					->get();
  		return $result;
  	}

  	public function updateBom($value)
  	{

  		$app_date = (isset($value['app_date']) ? $value['app_date'] : NULL);
  		$qa_app_date = (isset($value['qa_app_date']) ? $value['qa_app_date'] : NULL);
  		$value['approved'] = (isset($value['approved']) ? $value['approved'] : '');
  		$value['qa_approved'] = (isset($value['qa_approved']) ? $value['qa_approved'] : '');

  		$result = DB::table('bom')
            		->where('recnum', $value['bomrecnum'])
	            	->update(['bomnum' => $value['bomnum'],
							'bomdate' =>  $value['bomdate'],
							'bomdescr' =>  $value['desc'],
							'bom2seowner' => $value['serecnum'], 
							'status' =>  $value['status'], 
							'type' =>  $value['type'], 
							'link2quote' =>  $value['quoterecnum'], 
							'issue' =>  $value['issue'], 
							'approved' =>  $value['approved'], 
							'approved_by' =>  $value['approved_by'], 
							'app_date' =>  $app_date, 
							'qa_approved' =>  $value['qa_approved'], 
							'qa_approved_by' =>  $value['qa_approved_by'], 
							'qa_app_date' => $qa_app_date, 
							]);
	    return $result;
	}

	public function updateLI($value)
	{

		$result = DB::table('bom_line_items')
            		->where('recnum', $value['lirecnum'])
	            	->update(['line_num' => $value['linenumber'],
							'item_name' => $value['itemname'],
							'item_desc' => $value['itemdesc'],
							'item_value' => $value['value'], 
							'comments' => $value['comments'], 
							'workcenter' => $value['workcenter'], 
							'optemp_min' => $value['optemp_min'], 
							'optemp_max' => $value['optemp_max'], 
							'qty_check' => $value['qty_check'], 
							'paint_check' => $value['paint_check'], 
							'time_check' => $value['time_check'], 
							'li_tanknum' => $value['ps_tanknum'], 
							'form2' => $value['form2'], 
							]);
	    return $result;
	}

	public function addNotes4ps($recnum, $notes)
	{	
		$link2user = session('userrecnum');
		$result = DB::table('process_sheet_notes')->insert([
					    'psnotes' => $notes,
					    'link2ps' => $recnum,
					    'link2user' => $link2user,
					    'create_date' => DB::raw('curdate()')
					]);
		return $result;
	}

	public function getAllEmps($value='')
	{
		$result = DB::table('employee')
				->select('fname', 'lname', 'recnum', 'role',
              			 'empid', 'title', 'phone', 'email','address1', 
              			 'address2', 'city', 'state', 'zipcode','status') 
              	->where('status','=','Active')
              	->where('fname','!=','sa')
              	->where('lname','!=','sa')
              	->get();
       return $result;
	}


	public function addBOM($value)
	{
		
		$bomnum = $value['bomnum'];
		$result = DB::table('seqnum')
				->select('nxtnum')
				->where('tablename','=','bom')
				->get();
		$seqnum = $result[0]->nxtnum;
		$objid = $seqnum + 1;



		$count = DB::table('bom')
					->select('*')
					->whereRaw("bomnum = '$bomnum' and (status = 'Active' || status = 'Pending') ")
					->count();

		if ($count == 0) 
		{
			try {
			   $insertid = DB::table('bom')->insertGetId(
							    ['recnum' => $objid,
							    'bomnum' => $bomnum,
							    'type' => $value['type'],
							    'bomdescr' => $value['desc'],
							    'bomdate' => $value['bomdate'] ,
							    'status' => 'Pending',
							    'bom2seowner' => $value['serecnum'],
							    'creation_date' => DB::raw('curdate()'),
							    'last_modified' => DB::raw('curdate()'),
							    'issue' => $value['issue'],
							    'formatnum' => 'F3004', 
							    'formatrev' => 'Rev 1 dt Mar 17,2016']);
			} catch(QueryException $e){
			  die("Insert to Process Sheet didn't work..Please report to Sysadmin. " . $e->getMessage());
			}
		}
		else
        {
            echo "<table border=1><tr><td><font color=#FF0000>";
           die("Process Sheet " . $bomnum . " already exists. ");
           echo "</td></tr></table>";
        }


        try{
        	$result2 = DB::table('seqnum')
        				 ->where('tablename', '=','bom')
        				 ->update(['nxtnum' => $objid]);


        }catch(QueryException $e){
        	die("Seqnum insert query didn't work for BOM..Please report to Sysadmin. " . $e->getMessage());
        }

        // echo "objid $objid <br>"; exit;

        return $objid;

	}

	public function addLI($value)
	{
		
		$result = DB::table('seqnum')
				->select('nxtnum')
				->where('tablename','=','bom_line_items')
				->get();
		$seqnum = $result[0]->nxtnum;
		$objid = $seqnum + 1;

		try {
			   $bomrecnum = DB::table('bom_line_items')->insertGetId(
							    ['recnum' => $objid,
							    'line_num' => $value['linenumber'],
							    'item_name' => $value['itemname'],
							    'item_desc' => $value['itemdesc'],
							    'item_value' => $value['value'] ,
							    'link2bom' => $value['bomrecnum'],
							    'comments' => $value['comments'],
							    'creation_date' => DB::raw('curdate()'),
							    'workcenter' =>$value['workcenter'],
							    'optemp_min' => $value['optemp_min'],
							    'optemp_max' => $value['optemp_max'], 
							    'qty_check' => $value['qty_check'],
							    'paint_check' => $value['paint_check'],
							    'time_check' => $value['time_check'],
							    'li_tanknum' => $value['ps_tanknum'],
							    'form2' => $value['form2']
							    ]);
		} catch(QueryException $e){
		  die("Insert to Process Sheet LI didn't work..Please report to Sysadmin. " . $e->getMessage());
		}

		try{
        	$result2 = DB::table('seqnum')
        				 ->where('tablename', '=','bom_line_items')
        				 ->update(['nxtnum' => $objid]);

        }catch(QueryException $e){
        	die("Seqnum insert query didn't work for BOM..Please report to Sysadmin. " . $e->getMessage());
        }

        return $objid;
	}

	public function deleteLI($lirecnum)
	{
		$result = DB::table('bom_line_items')
					->where('recnum', '=', $lirecnum)
					->delete();
		return $result;
	}

	public function check_activemrs_ps($value)
	{

        $result = DB::table('master_route_process as mr')
        			->join('master_route_process_li as mrli','mr.recnum','=','mrli.link2routemaster')
					->select('mr.recnum as mrrecnum', 'mr.doc_id','mrli.recnum', 'mrli.op_num',
                   			 'mrli.ps_no','mr.issue')
					->where('mrli.ps_no','=',$value['psnum'])
					->where('mrli.ps_issue','=',$value['issue'])
					->where('mr.status','=','Active')
					->get();
		return $result;
	}

}
