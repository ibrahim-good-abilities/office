<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Office;
use App\City;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OfficeController extends Controller
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
        $offices =DB::table('offices')
        ->leftJoin('users','users.id','=','offices.officeAdminId')
        ->join('cities','cities.id','=','offices.cityId')
        ->select('offices.*','users.name','cities.cityName')
        ->get();

        $admins = DB::table('users')
        ->join('roles','roles.id','=','users.roleId')
        ->where('roles.roleName','admin')
        ->select('users.*')
        ->get();

        return view('offices.index')
                ->with('offices',$offices)
                ->with('admins',$admins);
    }


    public function summary()
    {
        $offices = DB::table('offices')
        ->join('cities','cities.id','=','offices.cityId')
        ->leftJoin('working_days','working_days.officeId','=','offices.id')
        ->leftJoin('schedule','schedule.workDayId','=','working_days.id')
        ->leftJoin('tickets','tickets.scheduleId','=','schedule.id')
        ->select('offices.officeName as office','offices.id as id', 'cities.cityName as city',DB::raw('COUNT(tickets.id) as total_tickets'))
        ->groupBy('offices.officeName','offices.id','cities.cityName')
        ->get();
        return view('offices.superadmin.index')
        ->with('offices',$offices);
    }
    public function operations()
    {
        $offices = DB::table('offices')
        ->join('cities','cities.id','=','offices.cityId')
        ->leftJoin('working_days','working_days.officeId','=','offices.id')
        ->leftJoin('schedule','schedule.workDayId','=','working_days.id')
        ->leftJoin('tickets',function($join){
            $join->on('schedule.id','=','tickets.scheduleId');
            $join->where('tickets.ticketStatus','<>','cancelled');
            $join->where('tickets.ticketStatus','<>','on-hold');
            $join->where('tickets.ticketStatus','<>','waiting-list');
        })
        ->select('offices.officeName as office','offices.id as id', 'cities.cityName as city',DB::raw('IFNULL(COUNT(tickets.id),0) as total_tickets'),DB::raw('IFNULL(SUM(tickets.ticketCost),0)  as cost'))
        ->groupBy('offices.officeName','offices.id','cities.cityName')
        ->get();

        return view('reports.operations')
        ->with('offices',$offices);
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
        $office->officeStartTime=2;

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
        $office_id = request('office_id');
        $office = Office::find($office_id);
        $office->officeAdminId =  request('admin');
        $office->save();

        $userId = request('admin');
        $user = User::find($userId);
        $user->officeId =  request('office_id');


        $user->save();
        return redirect()->back();
    }
    public function settings()
    {
        $officeId = Auth::user()->office->id;
        $office = Office::find($officeId);
        return view('offices.settings')->with('office',$office);
    }

    public function storeSettings(Request $request)
    {
        $request->validate([
            'officeStartTime'=>'required',
            'officeBreak'=>'required',
            'officeEndTime'=>'required'

        ]);
        $officeId =Auth::user()->office->id;

        $office = Office::find($officeId);

        $office->officeStartTime = request('officeStartTime');
        $office->officeBreak = request('officeBreak');
        $office->officeEndTime = request('officeEndTime');
        $office->save();

        return redirect()->back()->with('success',__('Office updated successfully'));


    }
  public function rates()
    {
        $employees = DB::table('users')
        ->join('roles','roles.id','=','users.roleId')
        ->leftJoin('schedule','schedule.userId','=','users.id')
        ->leftJoin('tickets',function($join){
            $join->on('schedule.id','=','tickets.scheduleId');
            $join->where('tickets.ticketStatus','<>','cancelled');
            $join->where('tickets.ticketStatus','<>','on-hold');
            $join->where('tickets.ticketStatus','<>','waiting-list');
        })
        ->leftJoin('tickets as ratedTickets',function($join){
            $join->on('schedule.id','=','ratedTickets.scheduleId');
            $join->where('ratedTickets.ticketStatus','=','rated');
        })
        ->where('roles.slug','=','employee')
        ->select('users.name as name',DB::raw('IFNULL(COUNT(tickets.id),0) as total_tickets'),DB::raw("IFNULL(IFNULL(SUM(ratedTickets.ticketRate),0)/IFNULL(COUNT(ratedTickets.id),0),'-')  as totalRate"))
        ->groupBy('users.name')
        ->get();
        return view('reports.rates')
        ->with('employees',$employees);
     }


    public function attendance()
    {
        $employees = DB::table('users')
        ->join('roles','roles.id','=','users.roleId')
        ->leftJoin('schedule','schedule.userId','=','users.id')
        ->leftJoin('schedule as attend_schedule',function($join){
            $join->on('attend_schedule.userId','=','users.id');
            $join->where('attend_schedule.available','=','1');
        })
        ->where('roles.slug','=','employee')
        ->select('users.name as name',DB::raw('IFNULL(COUNT(schedule.id),0) as official'),DB::raw('IFNULL(COUNT(attend_schedule.id),0) as actual'))
        ->groupBy('users.name')
        ->get();
        return view('reports.attendance')
        ->with('employees',$employees);
     }
}
