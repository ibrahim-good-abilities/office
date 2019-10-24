<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Office;
use App\City;
use App\User;
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
        $offices =DB::table('offices')
        ->leftJoin('users','users.id','=','offices.officeAdminId')
        ->select('offices.*','users.userName')
        ->get();

        $admins = DB::table('users')
        ->join('roles','roles.id','=','users.roleId')
        ->where('roles.roleName','admin')
        ->select('users.*')
        ->get();
        //dd($admins);
        return view('offices.index')
                ->with('offices',$offices)
                ->with('admins',$admins);
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
        return redirect()->route('edit_office',$office->id)->with('success',__('Office added successfully'));

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
    //
    public function officeEmployee($officeId)
    {
        $employees = DB::table('offices')
        ->join('users','users.officeId','=','offices.id')
        ->join('roles','users.roleId','=','roles.id')
        ->where('roles.roleName','employee')
        ->where('offices.id',$officeId)
        ->select('users.*','roles.roleName')
        ->get();

        return view('offices.employees')->with('employees',$employees);
    }
    public function updateAdmin(Request $request)
    {
        $request->validate([
            'office_id' => 'required',
            'admin' =>'required'
        ]);
        $office_id=request('office_id');
        $office = Office::find($office_id);
        $office->officeAdminId =  request('admin');
        $office->save();
        return redirect()->back();
    }
}
