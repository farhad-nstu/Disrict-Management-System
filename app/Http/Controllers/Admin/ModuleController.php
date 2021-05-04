<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminModules;
use App\Models\Zilla;
use Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\DcAdmin;
use App\Mail\AdminMail;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = AdminModules::all();
        return view('admin.configurations.module.index', compact('modules'));
    }

    public function store(Request $request)
    {
        $module = new AdminModules;
        $module->name = $request->name;
        $module->save();
        return back()->with('message', 'Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $module = AdminModules::find($id);
        $module->name = $request->name;
        $module->update();
        return back()->with("message", "Updated Successfully");
    }

    public function delete_module($id)
    {
        $module = AdminModules::find($id);
        $module->delete();
        return back()->with("message", "Deleted Successfully");
    }


    //// Registration Part ////
    public function all_admin()
    {
        $admins = AdminModules::all();
        return view('admin.registrations.allAdmin', compact('admins'));
    }

    public function all_admin_registration(Request $request)
    {
        if($request->admin == "DcAdmin") {
            $zillas = Zilla::all();
            return view('admin.registrations.dcRegistration', compact('zillas'));
        }
    }
    //// DC Admin ////
    public function dc_admin_registration(Request $request)
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

        return back()->with('message', 'DC Admin Created Successfully');
    }
}
