<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Pouroshava;

class PouroshavaController extends Controller
{
  public function index()
  {
      $pouroshavas = Pouroshava::all();
      $zillas = Zilla::all();
      return view('admin.configurations.pouroshava.index', compact('pouroshavas', 'zillas'));
  }

  public function store(Request $request)
  {
      $pouroshava = new Pouroshava;
      $pouroshava->zilla_id = $request->zilla_id;
      $pouroshava->name = $request->name;
      $pouroshava->save();
      return back()->with('message', 'Created Successfully');
  }

  public function update(Request $request, $id)
  {
      $pouroshava = Pouroshava::find($id);
      $pouroshava->zilla_id = $request->zilla_id;
      $pouroshava->name = $request->name;
      $pouroshava->update();
      return back()->with("message", "Updated Successfully");
  }

  public function delete_pouroshava($id)
  {
      $pouroshava = Pouroshava::find($id);
      $pouroshava->delete();
      return back()->with("message", "Deleted Successfully");
  }
}
