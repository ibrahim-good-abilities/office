<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\City;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'userName' => ['required', 'string', 'max:255'],
            'userEmail' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cityId' => 'required',
            'userAddress' => 'required',
            'userMobile' => 'required',
            'userPhone' => 'required',
            'userJopTitle' => 'required',
            'userIdNum' => 'required',
            'userIdFile' =>['required','file','max:5120']



        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $request = request();

        $file = $request->file('userIdFile');
        $fileSaveAsName = time() . "-profile." .$file->getClientOriginalExtension();
        $upload_path = 'profile_files/';
        $file_url = $upload_path . $fileSaveAsName;
        $file->move($upload_path, $fileSaveAsName);

        return User::create([
            'userName' => $data['userName'],
            'userEmail' => $data['userEmail'],
            'userPassword' => Hash::make(($data['password'])),
            'cityId' => $data['cityId'],
            'roleId' => 1,
            'userAddress' => $data['userAddress'],
            'userMobile' => $data['userMobile'],
            'userPhone' => $data['userPhone'],
            'userJopTitle' => $data['userJopTitle'],
            'userIdNum' => $data['userIdNum'],
            'userIdFile' =>$file_url

        ]);
    }
    public function showRegistrationForm(){
        $cities = City::all();

        return view ('auth.register')->with('cities',$cities);
    }
}
