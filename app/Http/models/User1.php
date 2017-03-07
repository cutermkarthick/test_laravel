<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class User1 extends Model
{
	public function insertuser($value)
	{

       	$date = date("Y-m-d");
       	$id = DB::table('user')->insertGetId(
			    ['username' => $value['username'], 
			    'email' => $value['email'],
			    'address' => $value['Address'],
			    'phone' => $value['phone'],
			    'status' => 'Active' ,
			    'created_date' => $date ]
			);

       	return $id;
	}
	public function get_user_summary()
	{
		$result = DB::table('user')
					->select('recnum','username','email','address','phone')
					->get();
		return $result;
	}

	public function get_user($recnum)
	{
		$result = DB::table('user')
					->select('recnum','username','email','address','phone')
					->where('recnum', '=', $recnum)
					->get();
		return $result;
	}

	public function update_user($value)
	{
		$result = DB::table('user')
					->where('recnum', $value['recnum'])
					->update(['username' => $value['username'],
							'email' => $value['email'],
							'address' => $value['Address'],
							'phone' => $value['phone'] ]
					);
		return $result;
	}

	public function remove_user($recnum)
	{
		$result = DB::table('user')
					->where('recnum', '=', $recnum)
					->delete();
		return $result;
	}

}

?>