<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\WorkingDay;
use App\Schedule;
use App\Office;

class WorkingDayController extends Controller
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
        $working_days = DB::table('working_days')
                     ->where('officeId', '=', auth()->user()->officeId)
                     ->get();
        return view('schedule.working_days')->with('working_days',$working_days);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedule.add_work_day');
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
            'date' => ['required','date',function ($attribute, $value, $fail) {
                                $working_day_exist =  DB::table('working_days')->where('date', $value)->where('officeId', auth()->user()->officeId)->count();
                                if($working_day_exist > 0){
                                    $fail(__('Working day already created'));
                                }
                            },
                        ],
        ]);

        
        $working_day = new WorkingDay();
        $working_day->date = request('date');
        $working_day->officeId = auth()->user()->officeId;
        $working_day->save();
        $employees =  DB::table('users')->where('roleId', 3)->where('officeId', auth()->user()->officeId)->get();
        $office = Office::find($working_day->officeId);
        foreach ($employees as $employee) {
            $schedule = new Schedule();
            $schedule->available = 1;
            $schedule->officialTime = 1;
            $schedule->startTime = $office->officeStartTime;
            $schedule->breakTime = $office->officeBreak;
            $time = strtotime($office->officeBreak);
            $endTime = date("H:i", strtotime('+30 minutes', $time));
            $schedule->backTime = $endTime;
            $schedule->leaveTime = $office->officeEndTime;
            $schedule->userId = $employee->id;
            $schedule->workDayId = $working_day->id;
            $schedule->save();
        }
        return redirect()->route('working-days.edit',$working_day->id)
        ->with('success',__('Working day created successfully'))
        ->with('working_day',$working_day);

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
        $working_day = WorkingDay::find($id);
        $schedule_list =DB::table('schedule')
        ->where('schedule.workDayId',$id)
        ->join('users','users.id','=','schedule.userId')
        ->join('working_days','working_days.id','=','schedule.workDayId')
        ->select('schedule.id','schedule.available','schedule.startTime as start_time','schedule.leaveTime as end_time','working_days.date','users.name as employee')
        ->get();
        return view('schedule.edit_work_day')->with('working_day',$working_day)->with('schedule_list',$schedule_list);
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
            'date' => ['required','date',function ($attribute, $value, $fail)  use ($id){

                                $working_day_exist =  DB::table('working_days')->where('date', $value)->where('id','!=',$id)->where('officeId', auth()->user()->officeId)->count();
                                if($working_day_exist > 0){
                                    $fail(__('Working day already created'));
                                }
                            },
                        ],
        ]);

    
        $working_day = WorkingDay::find($id);
        $working_day->date = request('date');
        $working_day->save();
        return redirect()->route('working-days.edit',$working_day->id)
        ->with('success',__('Working updated successfully'))
        ->with('working_day',$working_day);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $working_day = WorkingDay::find($id);
        $working_day->delete();
        return redirect()->back()->with('success',__('Working day removed successfully'));
    }
}
