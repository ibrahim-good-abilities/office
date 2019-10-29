<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   #write query here ^_^

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function officeTickets()
    {
        $this->middleware('auth');
        $tickets = DB::table('tickets')
        ->join('schedule','tickets.scheduleId','=','schedule.id')
        ->join('working_days','schedule.workDayId','=','working_days.id')
        ->join('services','tickets.serviceId','=','services.id')
        ->join('users','tickets.userId','=','users.id')
        ->leftJoin('users as employees','schedule.userId','=','employees.id')
        ->where('working_days.officeId','=',auth()->user()->officeId)
        ->orderBy('tickets.id', 'desc')
        ->select('services.serviceName as service', 'employees.name as employee','users.name as user','working_days.date','tickets.ticketStartTime as time','tickets.ticketStatus as status')->get();
        return view('tickets.office')
        ->with('tickets',$tickets);
    }

    public function employeeTickets()
    {
        $this->middleware('auth');
        return view('tickets.employee');
    }
    public function userTickets()
    {
        $this->middleware('auth');
        return view('tickets.user');
    }

}
