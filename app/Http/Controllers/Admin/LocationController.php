<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\City;

class LocationController extends Controller
{
    
    public function index()
    {
        $pageTitle = "Manage Location";
        $emptyMessage = "No data found";
        $locations = Location::latest()->with('city')->paginate(getPaginate());
        $citys = City::where('status', 1)->select('id', 'name')->get();
        return view('admin.location.index', compact('locations', 'pageTitle', 'emptyMessage', 'citys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'city' => 'required|exists:cities,id',
        ]);
        $location = new Location();
        $location->name = $request->name;
        $location->city_id = $request->city;
        $location->status = $request->status ? 1: 0;
        $location->save();
        $notify[] = ['success', 'Location has been created'];
        return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'city' => 'required|exists:cities,id',
        ]);
        $location = Location::findOrFail($request->id);
        $location->name = $request->name;
        $location->city_id = $request->city;
        $location->status = $request->status ? 1: 0;
        $location->save();
        $notify[] = ['success', 'Location has been updated'];
        return back()->withNotify($notify);
    }
}
