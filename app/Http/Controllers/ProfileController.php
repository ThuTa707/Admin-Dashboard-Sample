<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function profile()
    {
        return view('profile.index');
    }

    public function editPhoto()
    {
        return view('profile.edit-photo');
    }

    public function editNameEmail()
    {
        return view('profile.edit-name-email');
    }

    public function editPassword(){
        return view('profile.edit-password');
    }


    public function changeNameEmail(Request $request)
    {

        $user = User::find(Auth::id());

        if ($request->name) {
           $request->validate([
                'name' => ['required', 'string','min:3', 'max:255'],
            ]);
          
                $user->name = $request->name;  
                $user->update();    
                return redirect()->back()->with('toast', ['icon' => 'success', 'title' => 'Your phone is updated!!!']);            
        }


        if($request->email){
           $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
                $user->email = $request->email;
                $user->update();    
                return redirect()->back()->with('toast', ['icon' => 'success', 'title' => 'Your email is updated!!!']);      
        }

    }


    public function changePhoto(Request $request){

        $user = User::find(Auth::id());
        $request->validate([
            "photo" => "required|mimetypes:image/jpeg,image/png|file|max:2500"
        ]);

        Storage::delete('public/profile/'.Auth::user()->photo);

        $file = $request->file('photo');
        $imgName = uniqid()."_".$file->getClientOriginalName();
        Storage::putFileAs('public/profile/',$file,$imgName);
        
        $user->photo = $imgName;
        $user->update();
        return redirect()->back()->with('toast', ['icon' => 'success', 'title' => 'Your photo is updated!!!']);

    }

    public function changePassword(Request $request){
        $user = User::find(Auth::id());
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user->password = Hash::make($request->new_password);
        $user->update();

        Auth::logout();
        return redirect()->route('login')->with('toast', ['icon' => 'success', 'title' => 'Your Password is changed!!']);
     
    }

    public function updatePhoneAddress(Request $request){


        $request->validate([

            'phone' => 'required|min:9|max:11',
            'address' => 'required|string'

        ]);

        $user = User::find(Auth::id());
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('toast', ['icon' => 'success', 'title' => 'Your info is updated!!!']);

    }

}
