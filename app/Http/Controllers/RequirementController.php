<?php

namespace App\Http\Controllers;

use App\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'requirementName'=>'required',
            'requirementDescription'=>'required',
            'requirementType'=>'required',
            'serviceId'=>'required'
        ]);
        $requierment = new Requirement();
        $requierment->requirementName = request('requirementName');
        $requierment->requirementDescription = request('requirementDescription');
        $requierment->requirementType = request('requirementType');
        $requierment->serviceId = request('serviceId');
        $requierment->save();
        return redirect()->back()->with('success',__('Requirement Created succesfully'));



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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $requirement = Requirement::find($id);
        $requirement->delete();
        return redirect()->back()->with('success',__('Requirement removed successfully'));
    }
}
