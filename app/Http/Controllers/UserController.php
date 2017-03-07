<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\User1;
use View;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function add()
    {
        return view('user.addnew');
    }

    public function addnew1(Request $request)
    {
      
       // $name = $request->input('username');
       
       $data = $request->all();
       $user = new User1();
       $id = $user->insertuser($data);
       return \Redirect::to('/');
    }

    public function summary()
    {
        $user = new User1();
        $u_data = $user->get_user_summary();
        return View::make('user.usersummary')->with('udata', $u_data);
    }

    public function edit($recnum)
    {
        $user = new User1();
        $data['user_dt'] = $user->get_user($recnum);
        return View::make('user.edituser')->with($data);
    }

    public function userupdate(Request $request)
    {
        $user = new User1();
        $data = $request->all();
        $user->update_user($data);
        return \Redirect::to('/user');
    }

    public function removeuser($recnum)
    {
        $user = new User1();
        $user->remove_user($recnum);
        return \Redirect::to('/user');
    }
}

?>