<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\DcAdmin;
use App\Mail\AdminMail;
use DB;

class DcAdminController extends Controller
{
    public function index()
    {
        $dcs = DB::table('dc_admins')
                ->join('zillas', 'dc_admins.zilla_id', '=', 'zillas.id')
                ->select('dc_admins.*', 'zillas.name as zilla')
                ->orderBy('id', 'desc')
                ->get();

        return view('admin.registrations.dcs.index', compact('dcs'));  
    }

    public function create()
    {
        $zillas = Zilla::all();
        return view('admin.registrations.dcs.create', compact('zillas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'name' => ['required', 'string'],
                'designation' => ['required', 'string'],
                'phone' => ['required', 'string', 'numeric', 'unique:dc_admins'],
                'email' => ['required', 'email', 'unique:dc_admins'],
                'nid' => ['required', 'string', 'min:10', 'unique:dc_admins'],
            ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $postCode = rand ( 1000 , 9999 );
        $password = "dc".rand(1000, 9999);

        $dcAdmin = new DcAdmin;
        $dcAdmin->zilla_id = $request->zilla_id;
        $dcAdmin->name = $request->name;
        $dcAdmin->designation = $request->designation;
        $dcAdmin->phone = $request->phone;
        $dcAdmin->email = $request->email;
        $dcAdmin->nid = $request->nid;
        $dcAdmin->post_code = $postCode;
        $dcAdmin->office_type = "Dc";
        $dcAdmin->password = Hash::make($password);

        $userImage = $request->file( 'user_picture' );
        $filename    = $userImage->getClientOriginalName();
        $image_resize = Images::make( $userImage->getRealPath() );
        $image_resize->resize( 400, 300 );
        $image_resize->save( public_path( 'images/' .$filename ) );
        $dcAdmin->user_picture = 'images/' .$filename;

        $dcAdmin->save();

        $email = $request->email;
        $data = array(
            'user_name'  => $email,           
            'password' => $password,
            'role' => "District Admin",
            'message' => "This above is your user name and password. Please login with this credentials."
        );

        \Mail::to($email)->send(new AdminMail($data));

        return redirect()->route('dcs.index')->with('message', 'DC Admin Created Successfully');
    }

    public function show($id)
    {
        $dc = DB::table('dc_admins')
                ->join('zillas', 'dc_admins.zilla_id', '=', 'zillas.id')
                ->select('dc_admins.*', 'zillas.name as zilla')
                ->where('dc_admins.id', $id)
                ->first();

        return view('admin.registrations.dcs.view', compact('dc')); 
    }

    public function edit($id)
    {
        $zillas = Zilla::all();
        $dc = DcAdmin::find($id);
        return view('admin.registrations.dcs.edit', compact('zillas', 'dc'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'zilla_id' => ['required'],
            'name' => ['required', 'string'],
            'designation' => ['required', 'string'],
            'phone' => ['required', 'string', 'numeric'],
            'nid' => ['required', 'string', 'min:10'],
        ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }        

        $dcAdmin = DcAdmin::find($id);
        $dcAdmin->zilla_id = $request->zilla_id;
        $dcAdmin->name = $request->name;
        $dcAdmin->designation = $request->designation;
        $dcAdmin->phone = $request->phone;
        $dcAdmin->nid = $request->nid;
        $dcAdmin->office_type = "Dc";

        if($request->hasFile('user_picture')) {
            $userImage = $request->file( 'user_picture' );
            $filename    = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $dcAdmin->user_picture = 'images/' .$filename;
        }

        if($request->is_check == "off") {
            $password = "dc".rand(1000, 9999);
            $email = $request->email;
            $dcAdmin->email = $email;
            $dcAdmin->password = Hash::make($password);            
            $data = array(
                'user_name'  => $email,           
                'password' => $password,
                'role' => "District Admin",
                'message' => "This above is your updated user name and password. Please login with this credentials."
            );

            \Mail::to($email)->send(new AdminMail($data));
        }

        $dcAdmin->update();

        return redirect()->route('dcs.index')->with('message', 'DC Admin Updated Successfully');
    }

    public function destroy($id)
    {
        
    }

    public function delete_dc($id)
    {
        $dc = DcAdmin::find($id);
        $dc->delete();
        return back()->with("message", "Deleted Successfully");
    }
}
