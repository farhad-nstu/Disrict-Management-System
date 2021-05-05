<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Upazilla;
use App\Models\Union;
use App\Models\UnionWard;
use DB;

class UnionWardController extends Controller
{
	public function index()
	{
		$wards = DB::table('union_wards')
		->join('unions', 'union_wards.union_id', '=', 'unions.id')
		->join('upazillas', 'union_wards.upazilla_id', '=', 'upazillas.id')
		->join('zillas', 'union_wards.zilla_id', '=', 'zillas.id')
		->select('union_wards.*', 'unions.name as union', 'upazillas.name as upazilla', 'zillas.name as zilla')
		->orderBy('union_wards.id', 'desc')
		->get();

		return view('admin.configurations.unionWard.index', compact('wards'));
	}

	public function create()
	{
		$zillas = Zilla::all();
		return view('admin.configurations.unionWard.create', compact('zillas'));
	}

	public function store(Request $request)
	{
		$ward = new UnionWard;
		$ward->zilla_id = $request->zilla_id;
		$ward->upazilla_id = $request->upazilla_id;
		$ward->union_id = $request->union_id;
		$ward->name = $request->name;
		$ward->ward_no = $request->ward_no;
		$ward->save();
		return redirect()->route('unionWard.index')->with('message', 'Created Successfully');
	}

	public function edit($id)
	{
		$ward = UnionWard::find($id);
		$zillas = Zilla::all();
		$upazillas = Upazilla::where('zilla_id', $ward->zilla_id)->get();
		$unions = Union::where('upazilla_id', $ward->upazilla_id)->get();

		return view('admin.configurations.unionWard.edit', compact('zillas', 'upazillas', 'unions', 'ward'));
	}

	public function update(Request $request, $id)
	{
		$ward = UnionWard::find($id);
		$ward->zilla_id = $request->zilla_id;
		$ward->upazilla_id = $request->upazilla_id;
		$ward->union_id = $request->union_id;
		$ward->name = $request->name;
		$ward->ward_no = $request->ward_no;
		$ward->update();
		return redirect()->route('unionWard.index')->with('message', 'Updated Successfully');
	}

	public function delete_ward($id)
	{
		$ward = UnionWard::find($id);
		$ward->delete();
		return back()->with("message", "Deleted Successfully");
	}

	public function get_upazilla(Request $request)
	{
		$upazillas = Upazilla::where('zilla_id', $request->zilla_id)->get();
		return view('admin.configurations.unionWard.upazillas', compact('upazillas'));
	}

	public function get_union(Request $request)
	{
		$unions = Union::where('upazilla_id', $request->upazilla_id)->get();
		return view('admin.configurations.unionWard.unions', compact('unions'));
	}
}
