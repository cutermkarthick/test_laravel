<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
	public function insertuser($value)
	{
		echo "<pre>";
       	print_r($value); exit;
	}

}

?>