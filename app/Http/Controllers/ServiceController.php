<?php

namespace App\Http\Controllers;

use App\Requirement;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServiceController extends Controller
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
        $services = Service::all();
        return view('services.index')->with('services',$services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.add');
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
            'serviceName'=>'required',
            'servicePrice' => 'required',
            'serviceTime' => 'required',
        ]);
        $service = new Service();
        $service->serviceName = request('serviceName');
        $service->servicePrice = request('servicePrice');
        $service->serviceTime = request('serviceTime');
        $service->serviceDescription =request('serviceDescription');
        $service->serviceAllowedCancelTime =request('serviceAllowedCancelTime');

        $service->save();

        return redirect()->route('edit_service',$service->id)->with('success',__('Service created successfully'));
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
        $service = Service::find($id);
        $requirements =DB::table('services')
        ->join('requirements','requirements.serviceId','=','services.id')
        ->select('requirements.*')
        ->where('requirements.serviceId','=',$id)
        ->get();
        return  view('services.edit')->with('service',$service)->with('requirements',$requirements);
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
            'serviceName'=>'required',
            'servicePrice' => 'required',
            'serviceTime' => 'required',
        ]);
        $service = Service::find($id);
        $service->serviceName = request('serviceName');
        $service->servicePrice = request('servicePrice');
        $service->serviceTime = request('serviceTime');
        $service->serviceDescription = request('serviceDescription');
        $service->serviceAllowedCancelTime = request('serviceAllowedCancelTime');

        $service->save();
        return redirect()->back()->with('success',__('Service updated successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $service = Service::find($id);
        $service->delete();
        return redirect()->back()->with('success',__('Service removed successfully'));
    }
}
