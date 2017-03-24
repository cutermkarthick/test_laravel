<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;

class Accounts extends Model
{

	public function getAccounts($cond,$offset,$limit)
	{	
		try {
			$result = DB::table('company')
						->select('id', 'name','type','industry', 'phone', 'city', 'state', 'zipcode', 'country','recnum')
						->whereRaw($cond)
						->orderBy('recnum', 'asc')
						->offset($offset)
	            		->limit($limit)
						->get();

		} catch(QueryException $e){
			die("Get Accounts Summary didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getAccountscount($cond)
	{
		try {
			$result = DB::table('company')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Soln Matrix didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getContacts4sa($cond,$offset,$limit)
	{

		try {
			$result = DB::table('contact as c1')
						->join('company as c2', 'c1.contact2company', '=', 'c2.recnum')
						->select('c1.fname', 'c1.lname', 'c1.recnum', 'c1.role',
                      			 'c1.contactid', 'c1.title', 'c1.phone', 'c1.email',
                      			 'c1.address1', 'c1.address2', 'c1.city', 'c1.state',
                      			 'c1.zipcode','c1.status', 'c2.name','c2.type')
						->whereRaw($cond)
						->orderBy('c1.recnum', 'asc')
						->offset($offset)
	            		->limit($limit)
						->get();

		} catch(QueryException $e){
			die("Get Contacts Summary didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}

	public function getContactscount($cond)
	{
		try {
			$result = DB::table('contact as c1')
	        			->join('company as c2', 'c1.contact2company', '=', 'c2.recnum')
	        			->select(DB::raw('count(*) as numrows'))
	        			->whereRaw($cond)
	        			->get();
		} catch(QueryException $e){
			die("Get Contacts count didn't work..Please report to Sysadmin. " . $e->getMessage());
		}
		return $result;
	}
}


?>