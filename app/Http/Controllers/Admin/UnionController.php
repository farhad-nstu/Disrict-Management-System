<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Upazilla;
use App\Models\Union;
use DB;

class UnionController extends Controller
{
  public function index()
  {
      $unions = DB::table('unions')
      					->join('upazillas', 'unions.upazilla_id', '=', 'upazillas.id')
      					->join('zillas', 'unions.zilla_id', '=', 'zillas.id')
      					->select('unions.*', 'upazillas.name as upazilla', 'zillas.name as zilla')
      					->orderBy('unions.id', 'desc')
      					->get();

      return view('admin.configurations.union.index', compact('unions'));
  }

  public function create()
  {
  	$zillas = Zilla::all();
  	return view('admin.configurations.union.create', compact('zillas'));
  }

  public function store(Request $request)
  {
      $union = new Union;
      $union->zilla_id = $request->zilla_id;
      $union->upazilla_id = $request->upazilla_id;
      $union->name = $request->name;
      $union->union_no = $request->union_no;
      $union->save();
      return redirect()->route('union.index')->with('message', 'Created Successfully');
  }

  public function edit($id)
  {
  	$union = Union::find($id);
  	$zillas = Zilla::all();
  	$upazillas = Upazilla::where('zilla_id', $union->zilla_id)->get();
  	
  	return view('admin.configurations.union.edit', compact('zillas', 'upazillas', 'union'));
  }

  public function update(Request $request, $id)
  {
      $union = Union::find($id);
      $union->zilla_id = $request->zilla_id;
      $union->upazilla_id = $request->upazilla_id;
      $union->name = $request->name;
      $union->union_no = $request->union_no;
      $union->update();
      return redirect()->route('union.index')->with('message', 'Updated Successfully');
  }

  public function delete_upazilla($id)
  {
      $union = Union::find($id);
      $union->delete();
      return back()->with("message", "Deleted Successfully");
  }

  public function get_upazilla(Request $request)
  {
  	$upazillas = Upazilla::where('zilla_id', $request->zilla_id)->get();
  	return view('admin.configurations.union.upazillas', compact('upazillas'));
  }
}
