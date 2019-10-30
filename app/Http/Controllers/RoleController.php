<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;


use App\Role;
class RoleController extends Controller
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
        $roles = Role::all();
        return view('roles.index')->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.add');
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
            'roleName' => ['required','unique:roles'],
            'slug' => ['required', 'string', 'max:255', 'unique:roles', 'alpha_dash']
        ]);
        $role = new Role();
        $role->roleName = request('roleName');
        $role->slug = request('slug');

        $role->save();
        return redirect()->route('edit_role',$role->id)->with('success',__('Role created succesfully'));
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
        $role = Role::find($id);
        return view('roles.edit')->with('role',$role);
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
            'roleName' => ['required','unique:roles'],
            'slug' => 'required', 'string', 'max:255', 'unique:roles'.$id, 'alpha_dash'
        ]);
        $role = Role::find($id);
        $role->roleName = request('roleName');
        $role->slug = request('slug');

        $role->save();
        return redirect()->back()->with('success',__('Role updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $role = Role::find($id);
        //dd($role);
        $role->delete();
        return redirect()->back()->with('success',__('Role deleted successfully'));
    }
}
