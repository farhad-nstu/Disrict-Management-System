<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Upazilla;
use App\Models\Union;
use Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\UnionAdmin;
use App\Mail\AdminMail;
use DB;
use App\User;

class UnionParishadController extends Controller
{
    public function index()
    {
        $unions = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('upazillas', 'users.upazilla_id', '=', 'upazillas.id')
                ->join('unions', 'users.union_id', '=', 'unions.id')
                ->select('users.*', 'zillas.name as zilla', 'upazillas.name as upazilla', 'unions.name as union')
                ->orderBy('id', 'desc')
                ->get();

        return view('admin.registrations.unions.index', compact('unions'));  
    }

    public function create()
    {
        $zillas = Zilla::all();
        $upazillas = Upazilla::all();
        $unions = Union::all();
        return view('admin.registrations.unions.create', compact('zillas', 'upazillas', 'unions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'upazilla_id' => ['required'],
                'union_id' => ['required'],
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
        $password = "union".rand(1000, 9999);

        $unionAdmin = new User;
        $unionAdmin->role = "chairman";
        $unionAdmin->zilla_id = $request->zilla_id;
        $unionAdmin->upazilla_id = $request->upazilla_id;
        $unionAdmin->union_id = $request->union_id;
        $unionAdmin->name = $request->name;
        $unionAdmin->designation = $request->designation;
        $unionAdmin->phone = $request->phone;
        $unionAdmin->email = $request->email;
        $unionAdmin->nid = $request->nid;
        $unionAdmin->post_code = $postCode;
        $unionAdmin->office_type = "Union Parishad";
        $unionAdmin->password = Hash::make($password);

        $unionAdmin->free_active_date = $request->free_active_date;
        $unionAdmin->charge_type = $request->charge_type;
        $unionAdmin->tax_payer_date = $request->tax_payer_date;
        $unionAdmin->first_online_charge = $request->first_online_charge;
        $unionAdmin->free_expire_date = $request->free_expire_date;
        $unionAdmin->online_charge = $request->online_charge;
        $unionAdmin->tax_expire_date = $request->tax_expire_date;
        $unionAdmin->renew_charge = $request->renew_charge;

        if($request->hasFile('user_picture')) {

            $userImage = $request->file( 'user_picture' );
            $filename    = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $unionAdmin->user_picture = 'images/' .$filename;
        }

        $unionAdmin->save();

        $email = $request->email;
        $data = array(
            'user_name'  => $email,           
            'password' => $password,
            'role' => "Union Admin",
            'message' => "This above is your user name and password. Please login with this credentials.",
            'url' => url('/login')
        );

        \Mail::to($email)->send(new AdminMail($data));

        return redirect()->route('unionParishads.index')->with('message', 'Union Admin Created Successfully');
    }

    public function show($id)
    {
        $unionAdmin = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('upazillas', 'users.upazilla_id', '=', 'upazillas.id')
                ->join('unions', 'users.union_id', '=', 'unions.id')
                ->select('users.*', 'zillas.name as zilla', 'upazillas.name as upazilla', 'unions.name as union')
                ->where('users.id', $id)
                ->first();

        return view('admin.registrations.unions.view', compact('unionAdmin')); 
    }

    public function edit($id)
    {
        $zillas = Zilla::all();
        $union = User::find($id);
        $upazillas = Upazilla::where('zilla_id', $union->zilla_id)->get();
        $unions = Union::where('upazilla_id', $union->upazilla_id)->get();
        return view('admin.registrations.unions.edit', compact('zillas', 'union', 'upazillas', 'unions'));
    }

    public function update(Request $request, $id)
    {
    	// dd($request->all());
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'upazilla_id' => ['required'],
                'union_id' => ['required'],
                'name' => ['required', 'string'],
                'designation' => ['required', 'string'],
                'phone' => ['required', 'string', 'numeric'],
                'nid' => ['required', 'string', 'min:10'],
            ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $unionAdmin = User::find($id);
        $unionAdmin->zilla_id = $request->zilla_id;
        $unionAdmin->upazilla_id = $request->upazilla_id;
        $unionAdmin->union_id = $request->union_id;
        $unionAdmin->name = $request->name;
        $unionAdmin->designation = $request->designation;
        $unionAdmin->phone = $request->phone;
        $unionAdmin->nid = $request->nid;
        // $unionAdmin->post_code = $postCode;
        // $unionAdmin->office_type = "Upazilla";
        $unionAdmin->free_active_date = $request->free_active_date;
        $unionAdmin->charge_type = $request->charge_type;
        $unionAdmin->tax_payer_date = $request->tax_payer_date;
        $unionAdmin->first_online_charge = $request->first_online_charge;
        $unionAdmin->free_expire_date = $request->free_expire_date;
        $unionAdmin->online_charge = $request->online_charge;
        $unionAdmin->tax_expire_date = $request->tax_expire_date;
        $unionAdmin->renew_charge = $request->renew_charge;

        if($request->hasFile('user_picture')) {
            $userImage = $request->file( 'user_picture' );
            $filename    = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $unionAdmin->user_picture = 'images/' .$filename;
        }

        if($request->is_check == "off") {
            $password = "union".rand(1000, 9999);
            $email = $request->email;
            $unionAdmin->email = $email;
            $unionAdmin->password = Hash::make($password);           
            $data = array(
                'user_name'  => $email,           
                'password' => $password,
                'role' => "Union Admin",
                'message' => "This above is your updated user name and password. Please login with this credentials.",
            'url' => url('/login')
            );

            \Mail::to($email)->send(new AdminMail($data));
        }

        $unionAdmin->update();       

        return redirect()->route('unionParishads.index')->with('message', 'Union Admin Updated Successfully');
    }

    public function destroy($id)
    {
        
    }

    public function delete_unionParishads($id)
    {
        $union = User::find($id);
        $union->delete();
        return back()->with("message", "Deleted Successfully");
    }

    public function get_upazilla(Request $request)
    {
        $upazillas = Upazilla::where('zilla_id', $request->zilla_id)->get();
        return view('admin.registrations.unions.upazillas', compact('upazillas'));
    }

    public function get_union(Request $request)
    {
        $unions = Union::where('upazilla_id', $request->upazilla_id)->get();
        return view('admin.registrations.unions.unions', compact('unions'));
    }
}
