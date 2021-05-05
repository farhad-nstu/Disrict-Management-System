<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Upazilla;
use App\Models\UnionWard;
use Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminMail;
use DB;
use App\User;

class UnionAssessorController extends Controller
{
    public function index()
    {
        $unionAssesors = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('upazillas', 'users.upazilla_id', '=', 'upazillas.id')
                ->join('unions', 'users.union_id', '=', 'unions.id')
                ->join('union_wards', 'users.union_ward_id', '=', 'union_wards.id')
                ->select('users.*', 'zillas.name as zilla', 'upazillas.name as upazilla', 'unions.name as union', 'union_wards.name as ward')
                ->orderBy('id', 'desc')
                ->get();

        return view('admin.registrations.unionAssessors.index', compact('unionAssesors'));  
    }

    public function create()
    {
        $zillas = Zilla::all();
        $upazillas = Upazilla::all();
        $unions = Union::all();
        $wards = UnionWard::all();
        return view('admin.registrations.unionAssessors.create', compact('zillas', 'upazillas', 'wards', 'unions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'upazilla_id' => ['required'],
                'union_ward_id' => ['required'],
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

        $password = "unionAssesor".rand(1000, 9999);

        $unionAssesor = new User;
        $unionAssesor->role = "union_assesor";
        $unionAssesor->zilla_id = $request->zilla_id;
        $unionAssesor->upazilla_id = $request->upazilla_id;
        $unionAssesor->union_ward_id = $request->union_ward_id;
        $unionAssesor->name = $request->name;
        $unionAssesor->designation = $request->designation;
        $unionAssesor->phone = $request->phone;
        $unionAssesor->email = $request->email;
        $unionAssesor->nid = $request->nid;
        $unionAssesor->password = Hash::make($password);

        if($request->hasFile('user_picture')) {
            $userImage = $request->file( 'user_picture' );
            $filename = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $unionAssesor->user_picture = 'images/' .$filename;
        }

        $unionAssesor->save();

        $email = $request->email;
        $data = array(
            'user_name'  => $email,           
            'password' => $password,
            'role' => "Union Assesor Admin",
            'message' => "This above is your user name and password. Please login with this credentials.",
            'url' => url('/login')
        );

        \Mail::to($email)->send(new AdminMail($data));

        return redirect()->route('union_assesors.index')->with('message', 'Union Assesor Admin Created Successfully');
    }

    public function show($id)
    {
        $unionAssesor = DB::table('users')
                ->join('zillas', 'users.zilla_id', '=', 'zillas.id')
                ->join('upazillas', 'users.upazilla_id', '=', 'upazillas.id')
                ->join('unions', 'users.union_id', '=', 'unions.id')
                ->join('union_wards', 'users.union_ward_id', '=', 'union_wards.id')
                ->select('users.*', 'zillas.name as zilla', 'upazillas.name as upazilla', 'unions.name as union', 'union_wards.name as ward')
                ->where('users.id', $id)
                ->first();

        return view('admin.registrations.unionAssessors.view', compact('unionAssesor')); 
    }

    public function edit($id)
    {
        $zillas = Zilla::all();
        $unionAssesor = User::find($id);
        $upazillas = Upazilla::where('zilla_id', $unionAssesor->zilla_id)->get();
        $unions = Union::where('upazilla_id', $unionAssesor->upazilla_id)->get();
        $wards = UnionWard::where('upazilla_id', $unionAssesor->upazilla_id)->get();
        return view('admin.registrations.unionAssessors.edit', compact('zillas', 'unionAssesor', 'upazillas', 'wards', 'unions'));
    }

    public function update(Request $request, $id)
    {
    	// dd($request->all());
        $validator = Validator::make($request->all(), [
                'zilla_id' => ['required'],
                'upazilla_id' => ['required'],
                'union_ward_id' => ['required'],
                'name' => ['required', 'string'],
                'designation' => ['required', 'string'],
                'phone' => ['required', 'string', 'numeric'],
                'nid' => ['required', 'string', 'min:10'],
            ]);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $unionAssesor = User::find($id);
        $unionAssesor->zilla_id = $request->zilla_id;
        $unionAssesor->upazilla_id = $request->upazilla_id;
        $unionAssesor->union_ward_id = $request->union_ward_id;
        $unionAssesor->name = $request->name;
        $unionAssesor->designation = $request->designation;
        $unionAssesor->phone = $request->phone;
        $unionAssesor->nid = $request->nid;

        if($request->hasFile('user_picture')) {
            $userImage = $request->file( 'user_picture' );
            $filename    = $userImage->getClientOriginalName();
            $image_resize = Images::make( $userImage->getRealPath() );
            $image_resize->resize( 400, 300 );
            $image_resize->save( public_path( 'images/' .$filename ) );
            $unionAssesor->user_picture = 'images/' .$filename;
        }

        if($request->is_check == "off") {
            $password = "unionAssesor".rand(1000, 9999);
            $email = $request->email;
            $unionAssesor->email = $email;
            $unionAssesor->password = Hash::make($password);           
            $data = array(
                'user_name'  => $email,           
                'password' => $password,
                'role' => "Union Assesor Admin",
                'message' => "This above is your updated user name and password. Please login with this credentials.",
            'url' => url('/login')
            );

            \Mail::to($email)->send(new AdminMail($data));
        }

        $unionAssesor->update();       

        return redirect()->route('union_assesors.index')->with('message', 'Union Assesor Admin Updated Successfully');
    }

    public function destroy($id)
    {
        
    }

    public function delete_pouro_assesors($id)
    {
        $unionAssesor = User::find($id);
        $unionAssesor->delete();
        return back()->with("message", "Deleted Successfully");
    }

    public function get_upazilla(Request $request)
    {
        $upazillas = Upazilla::where('zilla_id', $request->zilla_id)->get();
        return view('admin.registrations.unionAssessors.upazillas', compact('upazillas'));
    }

    public function get_union(Request $request)
    {
        $unions = Union::where('upazilla_id', $request->upazilla_id)->get();
        return view('admin.registrations.unionAssessors.unions', compact('unions'));
    }

    public function get_ward(Request $request)
    {
        $wards = UnionWard::where('union_id', $request->union_id)->get();
        return view('admin.registrations.unionAssessors.wards', compact('wards'));
    }
}
