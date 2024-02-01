<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Cookie;
use Hash;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserImage;
use App\Http\Requests\RegisterUser;

class CustomRegisterController extends Controller
{
    public function userLogin(Request $request){
        $credentials = $request->only('email','password');
        if(auth::attempt($credentials)){
            $request->session()->regenerate();
            if($request->remember == 'on'){
                Cookie::queue(Cookie::forever('useremail',$request->email));
                Cookie::queue(Cookie::forever('password',$request->password));
            }
            else{
                if(Cookie::has('useremail') && Cookie::has('password')){
                    Cookie::queue(Cookie::forget('useremail'));
                    Cookie::queue(Cookie::forget('password'));
                }
            }
            return redirect()->intended('home')->withSuccess('Signed In');
        }
    }
    public function userRegister(RegisterUser $request){
        // dd("here");
        $id = $this->generateRegistrationId();
        $request->request->add(['userid' => $id]);
        // dd($request);
        $data = $request->all();
        $this->create($data);
        return redirect()->route('login')->withSuccess('Account Created Succesfully.');
    }
    public function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'userid' => $data['userid'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function saveProfile(Request $request){
        
        $validateData = $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:csv,jpg,jpeg,png'
        ]);

       
         UserDetail::create([
            'gender_id' => $request['gender'],
            'organization_name' => $request['organization_name'],
            'location' => $request['location'],
            'city' => $request['city'],
            'user_id' => $request['id'],
            'designation' => $request['designation']
        ]);

        if($request->TotalFiles > 0)
        {
               
           for ($x = 0; $x < $request->TotalFiles; $x++) 
           {

               if ($request->hasFile('files'.$x)) 
                {
                    // dd("here");
                    $file      = $request->file('files'.$x);

                    $path = $file->store('public/files');
                    $name = $file->getClientOriginalName();

                    $insert[$x]['name'] = $name;
                    $insert[$x]['path'] = $path;
                    $insert[$x]['user_id'] = $request['id'];
                }
           }

           UserImage::insert($insert);

            return response()->json(['success'=>'User Profile Uploaded Successfully.']);

         
        }
        else
        {
           return response()->json(["message" => "Please try again."]);
        }
    }
    public function saveProfileImage(Request $request){
        $validateData = $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:csv,jpg,jpeg,png'
        ]);
        if($request->TotalFiles > 0)
        {   
           for ($x = 0; $x < $request->TotalFiles; $x++) 
           {
               if ($request->hasFile('files'.$x)) 
                {
                    $file = $request->file('files'.$x);
                    $path = $file->store('public/files');
                    $name = $file->getClientOriginalName();

                    $insert[$x]['name'] = $name;
                    $insert[$x]['path'] = $path;
                    $insert[$x]['user_id'] = $request['id'];
                }
           }
            UserImage::insert($insert);
            return response()->json(['success'=>'User Profile Uploaded Successfully.']);
        }
        else
        {
            return response()->json(["message" => "Please try again."]);
        }
    }
    function generateRegistrationId() {
        $id = 'TEST-' . mt_rand(10000, 9999999999);
        if ($this->registrationIdExists($id)) {
            return $this->generateRegistrationId();
        }
        return $id;
    }
    
    function registrationIdExists($id) {
        return User::where('userid', $id)->exists();
    }
}
