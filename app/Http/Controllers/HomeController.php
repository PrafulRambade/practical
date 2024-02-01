<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        $user_id = auth::user()->id;
        $userdetails = User::find($user_id)->userdetails;
            if($userdetails){
                $user_data = $userdetails->toArray();
                return view('dashboard');
            }else{
                $user_data = auth::user();
                $gender = DB::table('gender')->get();
                return view('complete-profile',['user_data' => $user_data,'gender'=>$gender]);
            }
        // return view('dashboard');
    }
}
