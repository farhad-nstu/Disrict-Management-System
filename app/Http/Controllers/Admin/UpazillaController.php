<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;
use App\Models\Upazilla;

class UpazillaController extends Controller
{
    public function index()
    {
        $upazillas = Upazilla::all();
        $zillas = Zilla::all();
        return view('admin.configurations.upazilla.index', compact('upazillas', 'zillas'));
    }

    public function store(Request $request)
    {
        $upazilla = new Upazilla;
        $upazilla->zilla_id = $request->zilla_id;
        $upazilla->name = $request->name;
        $upazilla->save();
        return back()->with('message', 'Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $upazilla = Upazilla::find($id);
        $upazilla->zilla_id = $request->zilla_id;
        $upazilla->name = $request->name;
        $upazilla->update();
        return back()->with("message", "Updated Successfully");
    }

    public function delete_upazilla($id)
    {
        $upazilla = Upazilla::find($id);
        $upazilla->delete();
        return back()->with("message", "Deleted Successfully");
    }
}
