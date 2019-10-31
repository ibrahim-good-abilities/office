<?php

namespace App\Http\Controllers;

use App\User;
use App\City;
use App\File;
use App\Service;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class PassportController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            // 'userProfilePicture' =>['required','image'],
            // 'userIdFile'=>['required','file'],
            'cityId' => ['required'],
            'userAddress' => ['required'],
            'userIdNum' => ['required','max:14','min:14','unique:users'],
            'userJopTitle' => 'required',
        ]);

        $user = new User();
        if($request->has('userIdFile')){
            $file = $request->file('userIdFile');
            $fileSaveAsName = time() . "usersFiles." .$file->getClientOriginalExtension();
            $upload_path = public_path('/usersFiles/id/');
            $file_url = $upload_path . $fileSaveAsName;
            $file->move($upload_path, $fileSaveAsName);
            $user->userIdFile = $file_url;
        }

        //profile picture upload
        if($request->has('userProfilePicture')){
            $file = $request->file('userProfilePicture');
            $fileSaveName = time() . "usersFiles." .$file->getClientOriginalExtension();
            $uploadPath = public_path('/usersFiles/profilePicture/');
            $profilePicture = $uploadPath . $fileSaveName;
            $file->move($uploadPath, $fileSaveName);
            $user->userProfilePicture=$profilePicture;
        }


        $user->name = $request->name;
        $user->email =  $request->email;
        $user->password = Hash::make( $request->password);
        $user->roleId = 4;

        $user->cityId = $request->cityId;
        $user->userAddress = $request->userAddress;
        $user->userIdNum = $request->userIdNum;
        $user->userJopTitle = $request->userJopTitle;
        $user->save();

        $token = $user->createToken('TutsForWeb')->accessToken;
        $user->api_token = $token;
        $user->save();
        return response()->json(['user' => $user], 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            $user = auth()->user();
            $user->api_token = $token;
            $user->save();
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        $users = DB::table('users')->get();
        return response()->json(['user' => $users->get(1)], 200);
    }
    public function cities()
    {
        $cities = City::all();
        $cities_list=[];
        foreach($cities as $city)
        {
            $offices =DB::table('offices')->where('cityId','=',$city->id)->get();
            $cities_list[] = ['city_id'=>$city->id,'city_name'=>$city->cityName,'offices'=>$offices];
        }

        return response()->json(['cities'=>$cities_list]);
    }
    public function resetpassword(Request $request){
       // $this->broker()->sendResetLink();
        $response = Password::sendResetLink(['email' => $request->email], function (Message $message) {
        $message->subject($this->getEmailSubject());
    });

    switch ($response) {
        case Password::RESET_LINK_SENT:
            return response()->json(['status'=>'success ']);
        case Password::INVALID_USER:
            return  response()->json(['status error' => 'invaild email']);
    }
    }
    public function services()
    {
        $services = Service::all();
        $services_list=[];
        foreach($services as $service)
        {
            $requirements = DB::table('requirements')->where('serviceId','=',$service->id)->get();
            $services_list[] = [
                'service_id'=>$service->id , 'service_name'=>$service->serviceName,
                'service_price' => $service->servicePrice ,'service_time' => $service->serviceTime,
                'service_description' =>$service->serviceDescription,
                'service_allowed_cancel_time'=>$service->serviceAllowedCancelTime,
                'requirements'=>$requirements
            ];
        }

        return response()->json(['services'=>$services_list]);
    }

    public function createTicket(Request $request)
    {
        $request->validate([
            'serviceId' => 'required',
            'shift' => 'required',
            'workDayId' => 'required',
        ]);
        $service = DB::table('services')->where('id', $request->serviceId)->first();

        //create ticket object
        $ticket = new Ticket();
        $ticket->serviceId = $request->serviceId;
        $ticket->ticketStatus = 'on-hold';
        $ticket->ticketCost = $service->servicePrice;
        $ticket->shift =  $request->shift;
        $ticket->userId = Auth::user()->id;
        $ticket->save();

        //get office schedule list in order
        $schedule_list = DB::table('schedule')
        ->where('available','=',1)
        ->where('workDayId','=',$request->workDayId)->get();

        //ask if this day total  tickets is 0
        $total_tickets = DB::table('tickets')
        ->join('schedule','tickets.scheduleId','=','schedule.id')
        ->join('working_days','schedule.workDayId','=','working_days.id')
        ->where('workDayId','=',$request->workDayId)
        ->where('tickets.ticketStatus','!=','cancelled')
        ->count();

        //if yes : assign ticket to first schedule
        if($total_tickets == 0){
            $schedule = $schedule_list->get(0);
            if($ticket->shift == 'morning'){
                $ticket->ticketStartTime = $schedule->startTime;
                $time = strtotime($ticket->ticketStartTime);
                $endTime = date("H:i", strtotime('+'.$service->serviceTime.' minutes', $time));
                $ticket->ticketEstimatedEndTime = $endTime;
                $ticket->scheduleId = $schedule->id;
                $ticket->ticketStatus = 'pending-payment';
                $ticket->save();
            }else{
                $ticket->ticketStartTime = $schedule->backTime;
                $time = strtotime($ticket->ticketStartTime);
                $endTime = date("H:i", strtotime('+'.$service->serviceTime.' minutes', $time));
                $ticket->ticketEstimatedEndTime = $endTime;
                $ticket->scheduleId = $schedule->id;
                $ticket->ticketStatus = 'pending-payment';
                $ticket->save();
            }

        }else{
            //else : get last ticket schedule and get the next schedule
            $last_ticket = DB::table('tickets')
                    ->join('schedule','tickets.scheduleId','=','schedule.id')
                    ->join('working_days','schedule.workDayId','=','working_days.id')
                    ->where('workDayId','=',$request->workDayId)
                    ->where('tickets.ticketStatus','!=','cancelled')
                    ->orderBy('tickets.id', 'desc')
                    ->first();
            $schedule = null;
            foreach ($schedule_list as $key => $schedule_obj) {
                if($schedule_obj->id == $last_ticket->scheduleId){
                    if(count($schedule_list) != ($key + 1)){
                        $schedule = $schedule_list->get($key + 1);
                    }else{
                        $schedule = $schedule_list->get(0);
                    }
                }
            }


            //check if schedule has free time on that shift  (including cancelled ticket)
            $start_time = 0;
            //check if we already have the last ticket object on the selected schedule
            if( $last_ticket->scheduleId == $schedule->id && $last_ticket->shift == $request->shift){
                $start_time = $last_ticket->ticketEstimatedEndTime;
            }else{
                //find the the last ticket object on the selected schedule same shift
                $last_ticket = DB::table('tickets')
                    ->where('tickets.scheduleId','=',$schedule->id)
                    ->where('tickets.shift','=',$request->shift)
                    ->where('tickets.ticketStatus','!=','cancelled')
                    ->orderBy('tickets.id', 'desc')
                    ->first();
                if($last_ticket){
                    $start_time = $last_ticket->ticketEstimatedEndTime;
                }else{
                    //shift is empty on that schedule then we can assign directly
                    if($ticket->shift == 'morning'){
                        $ticket->ticketStartTime = $schedule->startTime;
                        $time = strtotime($ticket->ticketStartTime);
                        $endTime = date("H:i", strtotime('+'.$service->serviceTime.' minutes', $time));
                        $ticket->ticketEstimatedEndTime = $endTime;
                        $ticket->scheduleId = $schedule->id;
                        $ticket->ticketStatus = 'pending-payment';
                        $ticket->save();
                    }else{
                        $ticket->ticketStartTime = $schedule->backTime;
                        $time = strtotime($ticket->ticketStartTime);
                        $endTime = date("H:i", strtotime('+'.$service->serviceTime.' minutes', $time));
                        $ticket->ticketEstimatedEndTime = $endTime;
                        $ticket->scheduleId = $schedule->id;
                        $ticket->ticketStatus = 'pending-payment';
                        $ticket->save();
                    }
                }

            }

            if($start_time != null && $start_time !== 0){
                //we were able to define the start time without generate time for the ticket
                if($ticket->shift == 'morning'){
                    $time = strtotime($start_time);
                    $endTime = date("H:i", strtotime('+'.$service->serviceTime.' minutes', $time));
                    $schedule_break_time = date("H:i",strtotime($schedule->breakTime));

                    //is service time inconsistent with break time
                    if($endTime > $schedule_break_time){
                        $ticket->scheduleId = $schedule->id;
                        $ticket->ticketStatus = 'waiting-list';
                        $ticket->save();
                    }else{
                        $ticket->ticketStartTime = $start_time;
                        $time = strtotime($ticket->ticketStartTime);
                        $endTime = date("H:i", strtotime('+'.$service->serviceTime.' minutes', $time));
                        $ticket->ticketEstimatedEndTime = $endTime;
                        $ticket->scheduleId = $schedule->id;
                        $ticket->ticketStatus = 'pending-payment';
                        $ticket->save();
                    }
                }else{
                    //is service time inconsistent with leave time
                    $time = strtotime($start_time);
                    $endTime = date("H:i", strtotime('+'.$service->serviceTime.' minutes', $time));
                    $schedule_leave_time = date("H:i",strtotime($schedule->leaveTime));
                    if($endTime > $schedule_leave_time){
                        $ticket->scheduleId = $schedule->id;
                        $ticket->ticketStatus = 'waiting-list';
                        $ticket->save();
                    }else{
                        $ticket->ticketStartTime = $start_time;
                        $time = strtotime($ticket->ticketStartTime);
                        $endTime = date("H:i", strtotime('+'.$service->serviceTime.' minutes', $time));
                        $ticket->ticketEstimatedEndTime = $endTime;
                        $ticket->scheduleId = $schedule->id;
                        $ticket->ticketStatus = 'pending-payment';
                        $ticket->save();
                    }
                }
            }elseif($start_time === null){
                $ticket->scheduleId = $schedule->id;
                $ticket->ticketStatus = 'waiting-list';
                $ticket->save();
            }
        }

        return response()->json(['status'=>'success','ticket'=>$ticket]);
    }

    public function cancelTicket(Request $request){
        $request->validate([
            'ticketId' => 'required',
        ]);

        $ticket = DB::table('tickets')
        ->join('schedule','tickets.scheduleId','=','schedule.id')
        ->join('working_days','schedule.workDayId','=','working_days.id')
        ->join('services','tickets.serviceId','=','services.id')
        ->where('tickets.id','=',$request->ticketId)
        ->select('services.serviceAllowedCancelTime as cancel_time', 'working_days.date')->first();

        if(!$ticket){
            return response()->json(['status'=>'error','message'=>__('Ticket not found')]);
        }

        $time = strtotime($ticket->date);
        $maxDate = date("Y-m-d", strtotime('-'.$ticket ->cancel_time.' days', $time));
        $today = date("Y-m-d");
        if($today > $maxDate){
            return response()->json(['status'=>'error','message'=>__('Ticket max allowed cancellation period reached')]);
        }

        $ticket = Ticket::find($request->ticketId);
        $ticket->ticketStatus = 'cancelled';
        $ticket->save();

        //try to find waiting list ticket with same shift and same service
        $waitingTicket = Ticket::where('tickets.shift','=',$ticket->shift)
        ->where('tickets.scheduleId','=',$ticket->scheduleId)
        ->where('tickets.serviceId','=',$ticket->serviceId)
        ->where('tickets.ticketStatus','=','waiting-list')
        ->first();

        if($waitingTicket){
            $waitingTicket->ticketStatus = 'pending-payment';
            $waitingTicket->ticketStartTime = $ticket->ticketStartTime;
            $waitingTicket->ticketEstimatedEndTime = $ticket->ticketEstimatedEndTime;
            $waitingTicket->save();
            //send notification to mobile
        }
        return response()->json(['status'=>'success','message'=>__('Ticket cancelled')]);

    }

    public function workingDays($officeId)
    {
        $workingDays = DB::table('working_days')
        ->where('officeId','=',$officeId)
        ->whereDate('date','>=', Carbon::today()->toDateString())
        ->get();

        return response()->json(['workingDays'=>$workingDays]);
    }
    public function payment(Request $request)
    {
        $request->validate([
            'ticketId' =>'required',
        ]);
        $requirements =explode(',',request('requirements'));
        foreach($requirements as $requirement_id)
        {
              $ticket = Ticket::find($request->ticketId);
              $ticket->ticketStatus = "in-progress";
              $ticket->save();
              $file = $request->file($requirement_id);
              $requirement = new File();
              $fileSaveAsName = time() . "usersFiles." .$file->getClientOriginalExtension();
              $upload_path = public_path('/usersFiles/files/');
              $file_url = $upload_path . $fileSaveAsName;
              $file->move($upload_path, $fileSaveAsName);
              $requirement->fileUrl = '/usersFiles/files/'.$fileSaveAsName;
              $requirement->ticketId = $request->ticketId;
              $requirement->requirementId = $requirement_id;
              $requirement->save();
        }
    return response()->json(['status' =>'success'] );
    }

    //history of user tickets
    public function history()
    {
        $userId = Auth::user()->id;
        $tickets = DB::table('tickets')
        ->join('users','users.id','=','tickets.userId')
        ->join('services','services.id','=','tickets.serviceId')
        ->join('schedule','tickets.scheduleId','=','schedule.id')
        ->join('working_days','schedule.workDayId','=','working_days.id')
        ->where('tickets.userId',$userId)
        ->select('tickets.id','services.serviceName as name','tickets.ticketStatus as status',
        'tickets.ticketStartTime as time','tickets.ticketRate as rate'
        ,'working_days.date as workingday-date','working_days.id as workingday-id')
        ->get();
         return  response()->json(['status' =>'success','history'=>$tickets] );
    }
    public function uploadfile(Request $request)
    {
        $file = $request->file('file');
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('/usersFiles/uploadFile/');
       // dd($destinationPath);
        $file->move($destinationPath, $file_name);
        $file_url = base_path().'/public'.'/usersFiles/uploadFile/'.$file_name;
        return response()->json(['file_url'=>$file_url]);

    }

}
