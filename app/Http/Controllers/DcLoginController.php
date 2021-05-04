<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\DcAdmin;
use Illuminate\Support\Facades\Hash;


class DcLoginController extends Controller
{
	// public function __construct(){
	// 	$this->middleware('dc');
	// }

	public function login_page() 
	{
		return view('admin.DcLogin');
	}

	public function login(Request $request)
	{
		$dc = DcAdmin::where('email', $request->email)->first();

		if(empty($dc)) {
			return redirect()->route('dc.login_page')->with('message', 'Credentials not match');
		}

		if(Hash::check($request->password, $dc->password)) {
			Session::put('dc', $dc);
			return redirect()->route('dc.dashboard');
		} else {
			return redirect()->route('dc.login_page')->with('message', 'Credentials not match');
		}
	}
}
