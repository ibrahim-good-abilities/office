<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\City;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
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
        $users =DB::table('users')
        ->join('roles','users.roleId','=','roles.id')
        ->select('users.*','roles.roleName')
        ->get();

        return view('users.index')->with('users',$users);
    }
    public function adminIndex()
    {
        $users =DB::table('users')
        ->join('roles','users.roleId','=','roles.id')
        ->where('roles.slug','=','employee')
        ->select('users.*','roles.roleName')
        ->get();

        return view('admin.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $roles = Role::all()->where('roleName','!=','User');
        $offices = Office::all();
        return view('users.add')
                ->with('roles',$roles)
                ->with('offices',$offices)
                ->with('cities',$cities);
    }
    public function adminCreate()
    {

        $cities = City::all();
        $role = DB::table('roles')->where('slug','=','employee')->first();
        $office_id = Auth::user()->officeId;
        return view('admin.add')
                ->with('role',$role)
                ->with('office_id',$office_id)
                ->with('cities',$cities);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => 'required',

         ]);
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
        $user->roleId = request('role_id');
        $user->officeId = request('officeId');
        $user->save();
        return redirect()->route('edit_user',$user->id)->with('success',__('User created successfully'));

    }
    public function adminStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => 'required',

         ]);
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
        $user->roleId = request('role_id');
        $user->officeId = request('officeId');
        $user->save();
        return redirect()->route('admin_edit_user',$user->id)->with('success',__('User created successfully'));

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
        $user = User::find($id);
        $cities = City::all();
        $roles =Role::all();
        $offices = Office::all();
        return view('users/edit')
            ->with('user',$user)
            ->with('roles',$roles)
            ->with('offices',$offices)
            ->with('cities',$cities);

    }
    public function adminEdit($id)
    {
        $user = User::find($id);
        $role = DB::table('roles')->where('slug','=','employee')->first();
        $office_id = Auth::user()->officeId;
        return view('admin.edit')
            ->with('user',$user)
            ->with('role',$role)
            ->with('office_id',$office_id);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required', 'string', 'email', 'max:255'.$id,
            'role_id'=>'required'

         ]);
         $user = User::find($id);
         //dd($user);
         $user->name = request('name');
         $user->email = request('email');
         if($request->input('password') !=""){
            $user->password = Hash::make(request('password'));
         }
         $user->roleId = request('role_id');
         $user->officeId = request('officeId');
         $user->save();
         $roles =Role::all();

         return redirect()->route('edit_user',$user->id)->with('success',__('User updated successfully'));

    }
    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required', 'string', 'email', 'max:255'.$id,


         ]);
         $user = User::find($id);

         $user->name = request('name');
         $user->email = request('email');
         if($request->input('password') !=""){
            $user->password = Hash::make(request('password'));
         }

         $user->save();

         return redirect()->route('admin_edit_user',$user->id)->with('success',__('User updated successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success',__('User deleted successfully'));
    }
    public function adminDestroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success',__('User deleted successfully'));
    }
}
