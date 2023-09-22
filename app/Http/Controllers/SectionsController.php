<?php

namespace App\Http\Controllers;

use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Sections::all();
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sections.create');
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
            'sections_id' => 'required | integer'
        ],[
            'name.required' =>'حقل الاسم مطلوب ',
            'sections_id.required' =>'حقل رقم القسم مطلوب ',
            'sections_id.integer' =>'حقل رقم القسم ارقام فقط  ',
        ]);
        Sections::create([
            'name' => $request->name,
            'sections_id' => $request->sections_id
        ]);
        return redirect()->route('sections.index')
            ->with(['msg' => "تم اضافة القسم بنجاح"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $section)
    {
        return view('sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit($sections)
    {
        $section = Sections::findorFail($sections);
        return view('sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sections)
    {
        $request->validate([
            'name' => 'required',
            'sections_id' => 'required | integer'
        ],[
            'name.required' =>'حقل الاسم مطلوب ',
            'sections_id.required' =>'حقل رقم القسم مطلوب ',
            'sections_id.integer' =>'حقل رقم القسم ارقام فقط  ',
        ]);
        $section = Sections::findorFail($sections);
        $section->name=$request->name;
        $section->sections_id=$request->sections_id;
        $section->save();
        return redirect()->route('sections.index')->with('edit','تم التعديل ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy($sections)
    {
        $section = Sections::findorFail($sections);
        $section->delete();
        return redirect()->route('sections.index')
            ->with('delete', 'Sections deleted successfully');
    }
}
