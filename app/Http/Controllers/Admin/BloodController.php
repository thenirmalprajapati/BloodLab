<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blood;

class BloodController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage Blood Group";
        $emptyMessage = "No data found";
        $bloods = Blood::latest()->paginate(getPaginate());
        return view('admin.blood.index', compact('pageTitle', 'emptyMessage', 'bloods'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:60']);
        $blood = new Blood();
        $blood->name = $request->name;
        $blood->status = $request->status ? 1: 0;
        $blood->save();
        $notify[] = ['success', 'Blood group has been created'];
        return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
        $request->validate(['name' => 'required|max:60']);
        $blood = Blood::findOrFail($request->id);
        $blood->name = $request->name;
        $blood->status = $request->status ? 1: 0;
        $blood->save();
        $notify[] = ['success', 'Blood group has been updated'];
        return back()->withNotify($notify);
    }
}
