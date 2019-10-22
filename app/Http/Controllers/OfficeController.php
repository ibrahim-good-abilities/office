<?php

namespace App\Http\Controllers;

use App\Office;
use App\City;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::all();
        return view('offices.index')->with('offices',$offices);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $citys = City::all();
        return view('offices.add')->with('cities',$citys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'officeName'=>'required',
            'officeAddress' => 'required',
            'officePhone' => 'required',
            'officeNumber' => 'required',
            'officeEmail' => 'required',
            'cityId' => 'required'
        ]);

        $office = new Office();
        $office->officeName = request('officeName');
        $office->officeAddress = request('officeAddress');
        $office->officePhone  = request('officePhone');
        $office->officeMobile  = request('officeNumber');
        $office->officeEmail = request('officeEmail');
        $office->cityId = request('cityId');
        $office->save();
        return redirect()->route('edit_office',$office->id)->with('success',__('office Added  successfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $office = Office::find($id);
        $citys = City::all();
        return view('offices.edit')->with('office',$office)->with('cities',$citys);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'officeName'=>'required',
            'officeAddress' => 'required',
            'officePhone' => 'required',
            'officeNumber' => 'required',
            'officeEmail' => 'required',
            'cityId' => 'required'
        ]);
        $office = Office::find($id);
        $office->officeName = request('officeName');
        $office->officeAddress = request('officeAddress');
        $office->officePhone  = request('officePhone');
        $office->officeMobile  = request('officeNumber');
        $office->officeEmail = request('officeEmail');
        $office->cityId = request('cityId');
        $office->save();
        return redirect()->back()->with('success',__('Office updated successfully'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = Office::find($id);
        $office->delete();
        return redirect()->back()->with('success',__('Office removed successfully'));
    }
}
