<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;
//use App\Http\Controllers\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        
     
       
        
            
     

//=================احصائية نسبة تنفيذ الحالات======================


 




        
            if(auth()->user()->hasRole('owner'))

            {
                return view('home', compact('chartjs','chartjs_2'));
            } 
            elseif(auth()->user()->hasRole('Technical Support'))
            {
                return view('home', compact('chartjs','chartjs_2'));
            }
        
        else 
        return view('homeuser');


       // return view('home', compact('chartjs','chartjs_2'));

    }


}
