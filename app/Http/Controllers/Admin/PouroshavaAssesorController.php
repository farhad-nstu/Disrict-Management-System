<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Pouroshava;
use App\Models\Ward;
use Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminMail;
use DB;
use App\User;

class PouroshavaAssesorController extends Controller
{
    public function index()
    {
        $pouroAssesors = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('pouroshavas', 'users.pouroshava_id', '=', 'pouroshavas.id')
                ->join('wards', 'users.ward_id', '=', 'wards.id')
                ->select('users.*', 'zillas.name as zilla', 'pouroshavas.name as pouroshava', 'wards.name as ward')
                ->orderBy('id', 'desc')
                ->get();

        return view('admin.registrations.pouroshavaAssesors.index', compact('pouroAssesors'));  
    }

    public function create()
    {
        $zillas = Zilla::all();
        $pouroshavas = Pouroshava::all();
        $wards = Ward::all();
        return view('admin.registrations.pouroshavaAssesors.create', compact('zillas', 'pouroshavas', 'wards'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'pouroshava_id' => ['required'],
                'ward_id' => ['required'],
                'name' => ['required', 'string'],
                'designation' => ['required', 'string'],
                'phone' => ['required', 'string', 'numeric', 'unique:users'],
                'email' => ['required', 'email', 'unique:users'],
                'nid' => ['required', 'string', 'min:10', 'unique:users'],
            ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $password = "pouroAssesor".rand(1000, 9999);

        $pouroAssesor = new User;
        $pouroAssesor->role = "pouro_assesor";
        $pouroAssesor->zilla_id = $request->zilla_id;
        $pouroAssesor->pouroshava_id = $request->pouroshava_id;
        $pouroAssesor->ward_id = $request->ward_id;
        $pouroAssesor->name = $request->name;
        $pouroAssesor->designation = $request->designation;
        $pouroAssesor->phone = $request->phone;
        $pouroAssesor->email = $request->email;
        $pouroAssesor->nid = $request->nid;
        $pouroAssesor->password = Hash::make($password);

        if($request->hasFile('user_picture')) {
            $userImage = $request->file( 'user_picture' );
            $filename = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $pouroAssesor->user_picture = 'images/' .$filename;
        }

        $pouroAssesor->save();

        $email = $request->email;
        $data = array(
            'user_name'  => $email,           
            'password' => $password,
            'role' => "Pouroshava Assesor Admin",
            'message' => "This above is your user name and password. Please login with this credentials.",
            'url' => url('/login')
        );

        \Mail::to($email)->send(new AdminMail($data));

        return redirect()->route('pouro_assesors.index')->with('message', 'Pouroshava Assesor Admin Created Successfully');
    }

    public function show($id)
    {
        $pouroAssesor = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('pouroshavas', 'users.pouroshava_id', '=', 'pouroshavas.id')
                ->join('wards', 'users.ward_id', '=', 'wards.id')
                ->select('users.*', 'zillas.name as zilla', 'pouroshavas.name as pouroshava', 'wards.name as ward')
                ->where('users.id', $id)
                ->first();

        return view('admin.registrations.pouroshavaAssesors.view', compact('pouroAssesor')); 
    }

    public function edit($id)
    {
        $zillas = Zilla::all();
        $pouroAssesor = User::find($id);
        $pouroshavas = Pouroshava::where('zilla_id', $pouroAssesor->zilla_id)->get();
        $wards = Ward::where('pouroshava_id', $pouroAssesor->pouroshava_id)->get();
        return view('admin.registrations.pouroshavaAssesors.edit', compact('zillas', 'pouroAssesor', 'pouroshavas', 'wards'));
    }

    public function update(Request $request, $id)
    {
    	// dd($request->all());
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'pouroshava_id' => ['required'],
                'ward_id' => ['required'],
                'name' => ['required', 'string'],
                'designation' => ['required', 'string'],
                'phone' => ['required', 'string', 'numeric'],
                'nid' => ['required', 'string', 'min:10'],
            ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $pouroAssesor = User::find($id);
        $pouroAssesor->zilla_id = $request->zilla_id;
        $pouroAssesor->pouroshava_id = $request->pouroshava_id;
        $pouroAssesor->ward_id = $request->ward_id;
        $pouroAssesor->name = $request->name;
        $pouroAssesor->designation = $request->designation;
        $pouroAssesor->phone = $request->phone;
        $pouroAssesor->nid = $request->nid;

        if($request->hasFile('user_picture')) {
            $userImage = $request->file( 'user_picture' );
            $filename    = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $pouroAssesor->user_picture = 'images/' .$filename;
        }

        if($request->is_check == "off") {
            $password = "pouroAssesor".rand(1000, 9999);
            $email = $request->email;
            $pouroAssesor->email = $email;
            $pouroAssesor->password = Hash::make($password);           
            $data = array(
                'user_name'  => $email,           
                'password' => $password,
                'role' => "Pouroshava Assesor Admin",
                'message' => "This above is your updated user name and password. Please login with this credentials.",
            'url' => url('/login')
            );

            \Mail::to($email)->send(new AdminMail($data));
        }

        $pouroAssesor->update();       

        return redirect()->route('pouro_assesors.index')->with('message', 'Pouroshava Assesor Admin Updated Successfully');
    }

    public function destroy($id)
    {
        
    }

    public function delete_pouro_assesors($id)
    {
        $pouro_assesor = User::find($id);
        $pouro_assesor->delete();
        return back()->with("message", "Deleted Successfully");
    }

    public function get_pouroshava(Request $request)
    {
        $pouroshavas = Pouroshava::where('zilla_id', $request->zilla_id)->get();
        return view('admin.registrations.pouroshavaAssesors.pouroshavas', compact('pouroshavas'));
    }

    public function get_ward(Request $request)
    {
        $wards = Ward::where('pouroshava_id', $request->pouroshava_id)->get();
        return view('admin.registrations.pouroshavaAssesors.wards', compact('wards'));
    }
}
