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
            'userProfilePicture' =>['required','image'],
            'userIdFile'=>['required','file'],
            'cityId' => ['required'],
            'userAddress' => ['required'],
             'userIdNum' => ['required','max:14'],
            'userJopTitle' => 'required',
        ]);

        $user = new User();
        $file = $request->file('userIdFile');
        $fileSaveAsName = time() . "usersFiles." .$file->getClientOriginalExtension();
        $upload_path = public_path('/usersFiles/Id/');
        $file_url = $upload_path . $fileSaveAsName;
        $file->move($upload_path, $fileSaveAsName);
        //profile picture upload
        $file = $request->file('userProfilePicture');
        $fileSaveName = time() . "usersFiles." .$file->getClientOriginalExtension();
        $uploadPath = public_path('/usersFiles/profilePicture/');
        $profilePicture = $uploadPath . $fileSaveName;
        $file->move($uploadPath, $fileSaveName);

        $user->name = $request->name;
        $user->email =  $request->email;
        $user->password = Hash::make( $request->password);
        $user->roleId = 4;
        $user->userIdFile = $file_url;
        $user->userProfilePicture=$profilePicture;
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
        return response()->json(['name' => 'hussam'], 200);
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
            $requirements =DB::table('requirements')->where('serviceId','=',$service->id)->get();
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
            'ticketStatus'  => 'required',
            'ticketEndTime' => 'required',
            'serviceId' => 'required',
        ]);
        $ticket = new Ticket();
        $ticket->ticketStatus = $request->ticketStatus;
        $ticket->ticketEndTime = $request->ticketEndTime;
        $ticket->serviceId = $request->serviceId;
        $ticket->userId = Auth::user()->id;

        $ticket->save();

        return response()->json(['status'=>'ticket created succeesfully ','tiket'=>$ticket]);


    }

}
