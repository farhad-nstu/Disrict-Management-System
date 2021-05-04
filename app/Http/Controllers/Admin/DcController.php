<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class DcController extends Controller
{
    public function index(){
        return view('admin.dc.index');
    }

    public function logout(Request $request) {
    	Session::forget('dc');
    	return redirect()->route('dc.login_page');
    }
}
