<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Tmmaster;
use View;

class InvoiceController extends Controller
{

	public function invoice_summary(Request $request)
	{
		$newtm = new Tmmaster();
		$rowsPerPage =15;

		if (Input::has("page") || (!empty($_POST))) 
		{
			$input = $request->all();


		}
		else
		{
			echo "invoice"; exit;
		}
	}
}


?>