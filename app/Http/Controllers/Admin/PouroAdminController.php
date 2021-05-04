<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Pouroshava;
use Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\PouroshavaAdmin;
use App\Mail\AdminMail;
use DB;
use App\User;

class PouroAdminController extends Controller
{
    public function index()
    {
        $pouroshavas = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('pouroshavas', 'users.pouroshava_id', '=', 'pouroshavas.id')
                ->select('users.*', 'zillas.name as zilla', 'pouroshavas.name as pouroshava')
                ->orderBy('id', 'desc')
                ->get();

        return view('admin.registrations.pouroshavas.index', compact('pouroshavas'));  
    }

    public function create()
    {
        $zillas = Zilla::all();
        $pouroshavas = Pouroshava::all();
        return view('admin.registrations.pouroshavas.create', compact('zillas', 'pouroshavas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zilla_id' => ['required'],
            'pouroshava_id' => ['required'],
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
        $password = "pouroshava".rand(1000, 9999);

        $pouroshavaAdmin = new User;
        $pouroshavaAdmin->role = "mayor";
        $pouroshavaAdmin->zilla_id = $request->zilla_id;
        $pouroshavaAdmin->pouroshava_id = $request->pouroshava_id;
        $pouroshavaAdmin->name = $request->name;
        $pouroshavaAdmin->designation = $request->designation;
        $pouroshavaAdmin->phone = $request->phone;
        $pouroshavaAdmin->email = $request->email;
        $pouroshavaAdmin->nid = $request->nid;
        $pouroshavaAdmin->post_code = $postCode;
        $pouroshavaAdmin->office_type = "Pouroshava";
        $pouroshavaAdmin->password = Hash::make($password);

        $pouroshavaAdmin->free_active_date = $request->free_active_date;
        $pouroshavaAdmin->charge_type = $request->charge_type;
        $pouroshavaAdmin->tax_payer_date = $request->tax_payer_date;
        $pouroshavaAdmin->first_online_charge = $request->first_online_charge;
        $pouroshavaAdmin->free_expire_date = $request->free_expire_date;
        $pouroshavaAdmin->online_charge = $request->online_charge;
        $pouroshavaAdmin->tax_expire_date = $request->tax_expire_date;
        $pouroshavaAdmin->renew_charge = $request->renew_charge;

        if($request->hasFile('user_picture')) {

            $userImage = $request->file( 'user_picture' );
            $filename    = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $pouroshavaAdmin->user_picture = 'images/' .$filename;
        }

        $pouroshavaAdmin->save();

        $email = $request->email;
        $data = array(
            'user_name'  => $email,           
            'password' => $password,
            'role' => "Pouroshava Admin",
            'message' => "This above is your user name and password. Please login with this credentials.",
            'url' => url('/login')
        );

        \Mail::to($email)->send(new AdminMail($data));

        return redirect()->route('pouroAdmin.index')->with('message', 'Pouroshava Admin Created Successfully');
    }

    public function show($id)
    {
        $pouroshava = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('pouroshavas', 'users.pouroshava_id', '=', 'pouroshavas.id')
                ->select('users.*', 'zillas.name as zilla', 'pouroshavas.name as pouroshava')
                ->where('users.id', $id)
                ->first();

        return view('admin.registrations.pouroshavas.view', compact('pouroshava')); 
    }

    public function edit($id)
    {
        $zillas = Zilla::all();
        $pouroAdmin = User::find($id);
        $pouroshavas = Pouroshava::where('zilla_id', $pouroAdmin->zilla_id)->get();
        return view('admin.registrations.pouroshavas.edit', compact('zillas', 'pouroAdmin', 'pouroshavas'));
    }

    public function update(Request $request, $id)
    {
    	// dd($request->all());
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'pouroshava_id' => ['required'],
                'name' => ['required', 'string'],
                'designation' => ['required', 'string'],
                'phone' => ['required', 'string', 'numeric'],
                'nid' => ['required', 'string', 'min:10'],
            ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $pouroshavaAdmin = User::find($id);
        $pouroshavaAdmin->zilla_id = $request->zilla_id;
        $pouroshavaAdmin->pouroshava_id = $request->pouroshava_id;
        $pouroshavaAdmin->name = $request->name;
        $pouroshavaAdmin->designation = $request->designation;
        $pouroshavaAdmin->phone = $request->phone;
        $pouroshavaAdmin->nid = $request->nid;
        // $pouroshavaAdmin->post_code = $postCode;
        // $pouroshavaAdmin->office_type = "Upazilla";
        $pouroshavaAdmin->free_active_date = $request->free_active_date;
        $pouroshavaAdmin->charge_type = $request->charge_type;
        $pouroshavaAdmin->tax_payer_date = $request->tax_payer_date;
        $pouroshavaAdmin->first_online_charge = $request->first_online_charge;
        $pouroshavaAdmin->free_expire_date = $request->free_expire_date;
        $pouroshavaAdmin->online_charge = $request->online_charge;
        $pouroshavaAdmin->tax_expire_date = $request->tax_expire_date;
        $pouroshavaAdmin->renew_charge = $request->renew_charge;

        if($request->hasFile('user_picture')) {
            $userImage = $request->file( 'user_picture' );
            $filename    = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $pouroshavaAdmin->user_picture = 'images/' .$filename;
        }

        if($request->is_check == "off") {
            $password = "pouroshava".rand(1000, 9999);
            $email = $request->email;
            $pouroshavaAdmin->email = $email;
            $pouroshavaAdmin->password = Hash::make($password);           
            $data = array(
                'user_name'  => $email,           
                'password' => $password,
                'role' => "Pouroshava Admin",
                'message' => "This above is your updated user name and password. Please login with this credentials.",
                'url' => url('/login')
            );

            \Mail::to($email)->send(new AdminMail($data));
        }

        $pouroshavaAdmin->update();       

        return redirect()->route('pouroAdmin.index')->with('message', 'Pouroshava Admin Updated Successfully');
    }

    public function destroy($id)
    {
        
    }

    public function delete_pouro_admin($id)
    {
        $pouroshava = User::find($id);
        $pouroshava->delete();
        return back()->with("message", "Deleted Successfully");
    }

    public function get_pouroshava(Request $request)
    {
        $pouroshavas = Pouroshava::where('zilla_id', $request->zilla_id)->get();
        return view('admin.registrations.pouroshavas.pouro', compact('pouroshavas'));
    }
}
