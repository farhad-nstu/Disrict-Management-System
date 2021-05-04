<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Pouroshava;
use App\Models\Ward;
use DB;

class WardController extends Controller
{
    public function index()
  {
      $wards = DB::table('wards')
      					->join('pouroshavas', 'wards.pouroshava_id', '=', 'pouroshavas.id')
      					->join('zillas', 'wards.zilla_id', '=', 'zillas.id')
      					->select('wards.*', 'pouroshavas.name as pouroshava', 'zillas.name as zilla')
      					->orderBy('wards.id', 'desc')
      					->get();

      return view('admin.configurations.ward.index', compact('wards'));
  }

  public function create()
  {
  	$zillas = Zilla::all();
  	return view('admin.configurations.ward.create', compact('zillas'));
  }

  public function store(Request $request)
  {
      $ward = new Ward;
      $ward->zilla_id = $request->zilla_id;
      $ward->pouroshava_id = $request->pouroshava_id;
      $ward->name = $request->name;
      $ward->ward_no = $request->ward_no;
      $ward->save();
      return redirect()->route('ward.index')->with('message', 'Created Successfully');
  }

  public function edit($id)
  {
  	$ward = Ward::find($id);
  	$zillas = Zilla::all();
  	$pouroshavas = Pouroshava::where('zilla_id', $ward->zilla_id)->get();
  	
  	return view('admin.configurations.ward.edit', compact('zillas', 'pouroshavas', 'ward'));
  }

  public function update(Request $request, $id)
  {
      $ward = Ward::find($id);
      $ward->zilla_id = $request->zilla_id;
      $ward->pouroshava_id = $request->pouroshava_id;
      $ward->name = $request->name;
      $ward->ward_no = $request->ward_no;
      $ward->update();
      return redirect()->route('ward.index')->with('message', 'Updated Successfully');
  }

  public function delete_ward($id)
  {
      $ward = Ward::find($id);
      $ward->delete();
      return back()->with("message", "Deleted Successfully");
  }

  public function get_pouroshava(Request $request)
  {
  	$pouroshavas = Pouroshava::where('zilla_id', $request->zilla_id)->get();
  	return view('admin.configurations.ward.pouroshavas', compact('pouroshavas'));
  }
}
