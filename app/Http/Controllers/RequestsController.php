<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\Sections;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Requests::all();
        return view('requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Sections::all();
        return view('requests.create', compact('sections'));
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
            'name' => 'required',
            'civil_registry' => 'required',
            'manager_name' => 'required',
            'employee_civil_registry' => 'required',
            'section_name' => 'required',
            'section_id_new' => 'required',
            'date' => 'required'
        ], [
            'name.required' => 'حقل الاسم مطلوب ',
            'civil_registry.required' => 'حقل السجل المدني مطلوب ',
            'manager_name.required' => 'حقل اسم المدير المباشر مطلوب ',
            'employee_civil_registry.required' => 'حقل  مطلوب ',
            'section_name.required' => 'حقل السجل المدي لرئيس المباشر مطلوب ',
            'section_id.required' => 'حقل القسم الحالي مطلوب ',
            'date.required' => 'حقل القسم المراد النقل اليها مطلوب '
        ]);

        Requests::create([
            'employee_civil_id' => $request->civil_registry,
            'current_department_id' => $request->section_id,
            'transfer_deparment_id' => $request->section_id_new,
            'date' => $request->date,
            'current_manager_acceptance' => 0,
            'general_manager_acceptance' => 0,
            'transfer_manager_acceptance' => 0,
            'statas' => 0,
        ]);
        return redirect()->route('requests.index')->with('msg', 'تم ارسال الطلب بنجاح ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $requests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        //
    }
    function requests_send()
    {
        $requests = Requests::all();
        return view('requests.show', compact('requests'));
    }
    function accept(Request $request, $r)
    {
        $req = Requests::findOrFail($r);
        if ($request->type == 'new') {
            $req->current_manager_acceptance = 1;
            $req->save();
        } else if ($request->type == 'future') {
            $req->transfer_manager_acceptance = 1;
            $req->save();
        } else if ($request->type == 'manager') {
            $req->general_manager_acceptance = 1;
            $req->statas =1;
            $$req->user->section_id= $req->transfer_deparment_id;
            $req->save();
        }
        return redirect()->back()->with('msg','تم قبول الطلب ');
    }
    function regect($r)
    {
        $req = Requests::findOrFail($r);
        $req->statas = 'تم رفض الطلب';
        $req->save();
        return redirect()->back()
        ->with('msg','تم رفض الطلب ');
    }
}
