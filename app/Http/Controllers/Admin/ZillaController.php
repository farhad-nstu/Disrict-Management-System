<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zilla;

class ZillaController extends Controller
{
    public function index()
    {
        $zillas = Zilla::all();
        return view('admin.configurations.zilla.index', compact('zillas'));
    }

    public function store(Request $request)
    {
        $zilla = new Zilla;
        $zilla->name = $request->name;
        $zilla->save();
        return back()->with('message', 'Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $zilla = Zilla::find($id);
        $zilla->name = $request->name;
        $zilla->update();
        return back()->with("message", "Updated Successfully");
    }

    public function delete_zilla($id)
    {
        $zilla = Zilla::find($id);
        $zilla->delete();
        return back()->with("message", "Deleted Successfully");
    }

}
