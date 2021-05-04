<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Upazilla;
use Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\UnoAdmin;
use App\Mail\AdminMail;
use DB;
use App\User;

class UnoAdminController extends Controller
{
    public function index()
    { 
        $unos = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('upazillas', 'users.upazilla_id', '=', 'upazillas.id')
                ->select('users.*', 'zillas.name as zilla', 'upazillas.name as upazilla')
                ->orderBy('id', 'desc')
                ->get();

        return view('admin.registrations.unos.index', compact('unos'));  
    }

    public function create()
    {
        $zillas = Zilla::all();
        return view('admin.registrations.unos.create', compact('zillas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'upazilla_id' => ['required'],
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

        $postCode = rand ( 1000 , 9999 );
        $password = "uno".rand(1000, 9999);

        $unoAdmin = new User;
        $unoAdmin->role = "uno";
        $unoAdmin->zilla_id = $request->zilla_id;
        $unoAdmin->upazilla_id = $request->upazilla_id;
        $unoAdmin->name = $request->name;
        $unoAdmin->designation = $request->designation;
        $unoAdmin->phone = $request->phone;
        $unoAdmin->email = $request->email;
        $unoAdmin->nid = $request->nid;
        $unoAdmin->post_code = $postCode;
        $unoAdmin->office_type = "Upazilla";
        $unoAdmin->password = Hash::make($password);

        if($request->hasFile('user_picture')) {

            $userImage = $request->file( 'user_picture' );
            $filename    = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $unoAdmin->user_picture = 'images/' .$filename;
        }

        $unoAdmin->save();

        $email = $request->email;
        $data = array(
            'user_name'  => $email,           
            'password' => $password,
            'role' => "Upazilla Admin",
            'message' => "This above is your user name and password. Please login with this credentials.",
            'url' => url('/login')
        );

        \Mail::to($email)->send(new AdminMail($data));

        return redirect()->route('unos.index')->with('message', 'Upazilla Admin Created Successfully');
    }

    public function show($id)
    {
        $uno = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('upazillas', 'users.upazilla_id', '=', 'upazillas.id')
                ->select('users.*', 'zillas.name as zilla', 'upazillas.name as upazilla')
                ->where('users.id', $id)
                ->first();

        return view('admin.registrations.unos.view', compact('uno')); 
    }

    public function edit($id)
    {
        $zillas = Zilla::all();
        $uno = User::find($id);
        $upazillas = Upazilla::where('zilla_id', $uno->zilla_id)->get();
        return view('admin.registrations.unos.edit', compact('zillas', 'uno', 'upazillas'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'upazilla_id' => ['required'],
                'name' => ['required', 'string'],
                'designation' => ['required', 'string'],
                'phone' => ['required', 'string', 'numeric'],
                'nid' => ['required', 'string', 'min:10'],
            ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $unoAdmin = User::find($id);
        $unoAdmin->zilla_id = $request->zilla_id;
        $unoAdmin->upazilla_id = $request->upazilla_id;
        $unoAdmin->name = $request->name;
        $unoAdmin->designation = $request->designation;
        $unoAdmin->phone = $request->phone;
        $unoAdmin->nid = $request->nid;
        // $unoAdmin->post_code = $postCode;
        $unoAdmin->office_type = "Upazilla";

        if($request->hasFile('user_picture')) {
            $userImage = $request->file( 'user_picture' );
            $filename    = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $unoAdmin->user_picture = 'images/' .$filename;
        }

        if($request->is_check == "off") {
            $password = "uno".rand(1000, 9999);
            $email = $request->email;
            $unoAdmin->email = $email;
            $unoAdmin->password = Hash::make($password);           
            $data = array(
                'user_name'  => $email,           
                'password' => $password,
                'role' => "Upazilla Admin",
                'message' => "This above is your updated user name and password. Please login with this credentials.",
                'url' => url('/login')
            );

            \Mail::to($email)->send(new AdminMail($data));
        }

        $unoAdmin->update();       

        return redirect()->route('unos.index')->with('message', 'Uno Admin Updated Successfully');
    }

    public function destroy($id)
    {
        
    }

    public function delete_uno($id)
    {
        $uno = User::find($id);
        $uno->delete();
        return back()->with("message", "Deleted Successfully");
    }

    public function get_upazilla(Request $request)
    {
        $upazillas = Upazilla::where('zilla_id', $request->zilla_id)->get();
        return view('admin.registrations.unos.upazillas', compact('upazillas'));
    }
}
