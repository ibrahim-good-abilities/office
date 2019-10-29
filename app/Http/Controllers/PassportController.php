<?php

namespace App\Http\Controllers;

use App\User;
use App\City;
use App\Service;
use App\Ticket;
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
            'userIdNum' => ['required','max:14'],
            'userJopTitle' => 'required',
        ]);

        $user = new User();
        if($request->has('userIdFile')){
            $file = $request->file('userIdFile');
            $fileSaveAsName = time() . "usersFiles." .$file->getClientOriginalExtension();
            $upload_path = public_path('/usersFiles/Id/');
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

    //return response()->json(['status'=>'success']);
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

        //create ticket object
        $ticket = new Ticket();
        $ticket->serviceId = $request->serviceId;
        $ticket->ticketStatus = 'on-hold';
        $ticket->shift =  $request->shift;
        $ticket->userId = Auth::user()->id;
        $ticket->save();

        //get office schedule list in order
        $schedule_list = DB::table('schedule')->where('available','=',1)->where('workDayId','=',$request->workDayId)->get();
        
        //ask if this day total  tickets is 0
        $total_tickets = DB::table('tickets')
        ->join('schedule','tickets.scheduleId','=','schedule.id')
        ->join('working_days','schedule.workDayId','=','working_days.id')
        ->where('workDayId','=',$request->workDayId)
        ->where('tickets.ticketStatus','!=','cancelled')
        ->count();

        $service = DB::table('services')->where('id', $request->serviceId)->first();
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

            
            if($start_time != 0){
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
            }
        }
    
        return response()->json(['status'=>'ticket created succeesfully ','ticket'=>$ticket]);


    }

}