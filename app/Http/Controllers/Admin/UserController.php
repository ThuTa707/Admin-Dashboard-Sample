<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        return view('admin.show', compact('users'));
    }

    public function makeAdmin($id){

        $user = User::find($id);
        if($user->is_admin == 1){
            
            $user->is_admin = '0';
            $user->update();
            return redirect()->back()->with('toast', ['icon' => 'success', 'title' => 'Role is upgraded for '.$user->name]);
        }

    }

    public function banUser($id){

        $user = User::find($id);
        if($user->is_banned == 0){
            
            $user->is_banned = '1';
            $user->update();
            return redirect()->back()->with('toast', ['icon' => 'success', 'title' => $user->name.' is Banned!!!']);
        }

    }


    public function unbanUser($id){

        $user = User::find($id);
        if($user->is_banned == 1){
            
            $user->is_banned = '0';
            $user->update();
            return redirect()->back()->with('toast', ['icon' => 'success', 'title' => $user->name.' is unbanned!!!']);
        }
    }

    // PW Change with Ajax Sweet Alert
    public function changePassword(Request $request){
        
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:10|string',
        ]);

        if($validator->fails()){
        return response()->json(['status' => 422, 'message' => $validator->errors()]);     
        }

        $user = User::find($request->id);
        if($user->is_admin == 1){
            $user->password = Hash::make($request->password);
            $user->update();
        }

        return response()->json(['status' => 200, 'message' => "Password change for $user->name is complete"]);

    }




    // Password Change with Bootstrap Modal
//    public function changenewPassword(Request $request){

//          $request->validate([

//             'newpassword' => ['required', 'string', 'min:8'],

//         ]);
//             $user = User::find($request->id);
//             $user->password = Hash::make($request->newpassword);
//             $user->update();
//             return redirect()->back()->with('toast', ['icon' => 'success', 'title' => "Password for $user->name is changed!!!"]);
        
//    }
}
