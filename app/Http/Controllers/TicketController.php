<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Carbon\Carbon;
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
        ->select('services.serviceName as service', 'employees.name as employee','users.name as user','working_days.date','tickets.ticketStartTime as time','tickets.ticketStatus as status','tickets.ticketRate as rate','tickets.ticketFeedback as feedback')->get();
        return view('tickets.office')
        ->with('tickets',$tickets);
    }
    public function employeeTickets()
    {
        $this->middleware('auth');

        $tickets = DB::table('tickets')
        ->join('schedule','tickets.scheduleId','=','schedule.id')
        ->join('working_days','schedule.workDayId','=','working_days.id')
        ->join('services','tickets.serviceId','=','services.id')
        ->join('users','ticketS.userId','=','users.id')
        ->Join('users as employees','schedule.userId','=','employees.id')
        ->whereDate('working_days.date','=', Carbon::today()->toDateString())
        ->where('schedule.userId','=',auth()->user()->id)
        ->where('tickets.ticketStatus','!=','resolved')
        ->where('tickets.ticketStatus','!=','rated')
        ->orderBy('tickets.id', 'desc')
        ->select('services.serviceName as service','users.name as user','tickets.id','tickets.ticketStartTime as time')->get();
        return view('tickets.employee')
        ->with('tickets',$tickets);
    }
    public function updateTicketStatus($ticketid)
    {
        $ticket = Ticket::find($ticketid);
        $ticket->ticketStatus ='resolved';
        $ticket->save();
        return redirect()->back();
    }

    public function retrieveOfficeTickets($id)
    {
        $this->middleware('auth');
        $tickets = DB::table('tickets')
        ->join('schedule','tickets.scheduleId','=','schedule.id')
        ->join('working_days','schedule.workDayId','=','working_days.id')
        ->join('services','tickets.serviceId','=','services.id')
        ->join('users','tickets.userId','=','users.id')
        ->leftJoin('users as employees','schedule.userId','=','employees.id')
        ->where('working_days.officeId','=',$id)
        ->orderBy('tickets.id', 'desc')
        ->select('services.serviceName as service', 'employees.name as employee','users.name as user','working_days.date','tickets.ticketStartTime as time','tickets.ticketStatus as status','tickets.ticketRate as rate','tickets.ticketFeedback as feedback')->get();
        return view('tickets.office')
        ->with('tickets',$tickets);
    }


    public function userTickets()
    {
        $this->middleware('auth');
        return view('tickets.user');
    }

}
