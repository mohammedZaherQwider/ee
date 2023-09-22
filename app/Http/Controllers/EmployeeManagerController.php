<?php

namespace App\Http\Controllers;

use App\Models\EmployeeManager;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employeeManager.create');
    }

    public function getEmployeeByCivilRegistry(Request $request){
        $type = $request->get('type') == 'employee' ? 'user' : 'manager';
        $user = User::where([
            'civil_registry' => $request->get('civil_registry'),
//            'roles_name' => '["' . $type . '"]'
        ])->first();

        return response()->json(['status' => ($user) ?  true : false, 'user' => $user]);
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
        $request->validate([
            'employee_civil_registry' => 'required|numeric|exists:users,civil_registry',
            'manager_civil_registry' => 'required|numeric|different:employee_civil_registry|exists:users,civil_registry',
        ]);
        $employeeUser = User::where([
            'civil_registry' => $request->get('employee_civil_registry'),
        ])->first();
        $managerUser = User::where([
            'civil_registry' => $request->get('manager_civil_registry'),
        ])->first();
        if (in_array('user', $managerUser->roles_name)){
            return redirect()->back()->with('errors', ['User must be with type Manager']);
        }

        EmployeeManager::create([
            'employee_civil_registry' => $request->get('employee_civil_registry'),
            'manager_civil_registry' => $request->get('manager_civil_registry'),
        ]);
        return redirect()->route('employeeManager.create')
            ->with('success','Employee linked successfully');
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
}
