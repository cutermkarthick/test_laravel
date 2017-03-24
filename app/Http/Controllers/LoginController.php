<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Login;
use Illuminate\Support\Facades\Session;
use View;

class LoginController extends Controller
{
	public function index()
	{
		return View::make('login.login');
	}

	public function processlogin(Request $request)
	{
		$newlogin = new Login();

		$data['userid'] = $request->input('userid');
		$data['password'] = $request->input('password');
		$data['siteid'] = $request->input('siteid');

		$user_details = $newlogin->verifyPassword($data);

		if (!empty($user_details)) 
		{
			
			if ($user_details['response'] == "Incorrect Password") 
			{

				\Session::flash('validate', 'Incorrect User Name or Password.');
				return \Redirect::to('/');
			}	
		}
		else
		{
			\Session::flash('validate', 'Incorrect User Name or Password.');
			return \Redirect::to('/');
		}

		session(['user' => $user_details['username']]);
		session(['userrole' => $user_details['role']]);
		session(['usertype' => $user_details['usertype']]);
		session(['userrecnum' => $user_details['userrecnum']]);
		session(['department' => $user_details['department']]);


		$usertype = $user_details['usertype'];
		$department = $user_details['department'];

		if ($usertype == "EMPL") 
		{
			if ($department == "Stores") 
			{
				
			}
			else
			{
				return \Redirect::to('/bom');
			}
		}

		echo "<pre>";
		print_r($user_details); exit;
	}

	public function logout()
	{
		Session::flush();
		return redirect('/');
	}
	
}





?>