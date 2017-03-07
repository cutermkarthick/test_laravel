<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Login extends Model
{
	public function verifyPassword($value)
	{
		
		$userid = $value['userid'];
		$userPassword = $value['password'];

		$results = DB::table('user')
                  ->select('recnum','password','type', 'user2contact', 'user2employee','userid')
                  ->where('userid', '=', $userid)
                  ->where('password', '=', md5($userPassword) )
                  ->get();


    if (count($results) == 1) 
		{
			$userrecnum = $results[0]->recnum;
			$usertype = $results[0]->type;
			$usercompany = $results[0]->user2contact;
			$employee = $results[0]->user2employee;
			$username = $results[0]->userid;

			if ($usertype == 'EMPL') 
			{
				$results1 = DB::table('employee as e')
			  							->join('company as c', 'e.employee2company', '=', 'c.recnum')
			                ->select('c.id')
			                ->where('e.recnum', '=', $employee)
			                ->get();


			}
			else 
			{
				$results1 = DB::table('contact as cont')
				  						->join('company as c', 'cont.contact2company', '=', 'c.recnum')
			                ->select('c.id')
			                ->where('cont.recnum', '=', $usercompany)
			                ->get();
			}

			if (count($results1) > 0) 
			{
				if($results1[0]->id != $value['siteid'])
				{
					$data['response'] = "Incorrect Password";
					return $data;
				}
				else
				{
					$data['usertype'] = $usertype;
					$data['userrecnum'] = $userrecnum;
					$data['username'] = $username;
					$data['response'] = "success";
					if ($employee != '') 
					{
						$results2  = DB::table('employee')
					                ->select('role','dept')
					                ->where('recnum', '=', $employee)
					                ->get();

			        	$role = $results2[0]->role;
			        	$dept = $results2[0]->dept;
			        	$data['role'] = $role;
			        	$data['department'] = $dept;
					}
					if ($usercompany != '') 
					{
						$results2  = DB::table('contact')
					                ->select('role')
					                ->where('recnum', '=', $usercompany)
					                ->get();
			        	$data['role'] = $role;
					}
					
				}

				return $data;

			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}


	}
}

?>