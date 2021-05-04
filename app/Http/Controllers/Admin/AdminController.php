<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Zilla;
use App\Models\Upazilla;
use App\Models\Union;
use App\Models\Pouroshava;
// use App\LogActivity;
// use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('admin.superadmin.dashboard');
    }

    public function profile()
    {
    	$user = User::find(Auth::user()->id);
      $zillas = Zilla::all();
      $upazillas = Upazilla::all();
      $unions = Union::all();
      $pouroshavas = Pouroshava::all();
    	return view('admin.profile.index', compact('user', 'zillas', 'upazillas', 'pouroshavas', 'unions'));
    }

    public function edit_profile($id)
    {
      $user = User::find($id);
      return view('admin.profile.edit', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->designation = $request->designation;
    	$user->phone = $request->phone;
    	$user->email = $request->email;

      if($request->hasFile('user_picture')) {
      	$userImage = $request->file( 'user_picture' );
        $filename    = $userImage->getClientOriginalName();
        $image_resize = Images::make( $userImage->getRealPath() );
        $image_resize->resize( 400, 300 );
        $image_resize->save( public_path( 'images/' .$filename ) );
        $user->user_picture = 'images/' .$filename; 
      }

      $user->save();

      return redirect()->route('profile')->with('message', 'Profile updated successfully');

    }

    public function update_password(Request $request, $id)
    {
    	$request->validate( [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'Password is required',
        ] );

    	$user = User::find($id);
    	$user->password = Hash::make($request->password);
    	$user->update();
    	return back()->with('pass_message', 'Password updated successfully');

    }
}
