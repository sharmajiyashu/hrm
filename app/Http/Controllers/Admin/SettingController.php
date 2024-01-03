<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    function changePassword(){
        return view('admin.change-password');
    }


    function updatePassword(ChangePassword $request){
            $user = User::where('id',auth()->user()->id)->first();
            if (Hash::check($request->current_password, $user->password)) {
                if(Hash::check($request->new_password, $user->password)){
                    return back()->withErrors([
                        'current_password' => 'This password is already in use.',
                    ])->onlyInput('current_password');
                }else{
                    $user->update(['password' => Hash::make($request->new_password)]);
                    return redirect()->back()->with('success','Password change successfully');
                }
            }else{
                return back()->withErrors([
                    'current_password' => 'Invalid current password.',
                ])->onlyInput('current_password');
            }
    }
}
