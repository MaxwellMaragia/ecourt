<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $partners = Partner::all();
        return view('super admin.partners.show',compact('partners'));
    }
    public function create()
    {
        return view('super admin.partners.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'name'=>'required',
            'url'=>'required',
        ]);

        $partner = new Partner();
        $partner->name = $request->name;
        $partner->url = $request->url;

        if($request->hasFile('logo'))
        {
            $partner->logo = $request->logo->store('public/files/partners');
        }

        $partner->save();
        return redirect()->back()->with('success','partner created successfully');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $partner = Partner::find($id);
        return view('super admin.partners.edit',compact('partner'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',
        ]);

        $partner = Partner::find($id);
        $partner->name = $request->name;
        $partner->url = $request->url;

        if($request->hasFile('logo'))
        {
            $partner->logo = $request->logo->store('public/files/partners');
        }

        $partner->save();
        return redirect()->back()->with('success','partner updated successfully');
    }

    public function destroy($id)
    {
        partner::where('id',$id)->delete();
        return redirect()->back()->with('success','partner deleted successfully');
    }
}
