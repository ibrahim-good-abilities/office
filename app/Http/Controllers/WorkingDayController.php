<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\WorkingDay;

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
        $working_days = WorkingDay::all();
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
        return view('schedule.edit_work_day')->with('working_day',$working_day);
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
