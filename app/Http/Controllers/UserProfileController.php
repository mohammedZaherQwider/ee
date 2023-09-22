<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use App\Http\controllers\controller;
use Illuminate\Support\Facades\Auth;



class UserProfileController extends Controller
{
    public function index()
    {
        return view('users.profile');
    }


    public function updateUserDetails (Request $request)
    {

       $request->validate([
        'name'      => ['required','string'],
        'email'      => ['required','string'],
        'phone'      => ['required','digits:10'],
        'pin_code'      => ['required','digits:6'],
        'address'      => ['required','string','max:499'],


       ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name
        ]);
        $user->userDetail()->updateOrCreate(
               [
                'user_id' => $user->id,
               ],
               [
                   'phone'      => $request->phone,
                   'pin_code'   => $request->pin_code,
                   'address'    => $request->address,
               ]
        );

        return redirect()->back()->with('message','تم التحديث بنجاح');
    }
}
