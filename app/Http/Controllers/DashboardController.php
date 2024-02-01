<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request){
        // dd(auth::user()->role_id);
            if(auth::user()->role_id == 1 || auth::user()->role_id == 2){
                $data['users'] = DB::table('users')
                ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                ->select('users.*', 'user_details.*')
                ->get();
                // dd($users);
            }
            else{
                $user_id = auth::user()->id;
                $data['users'] = DB::table('users')
                ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                ->where('users.id','=',$user_id)
                ->select('users.*', 'user_details.*')
                ->get();
                // dd($users);
            }
            
        return view('userlist',$data);
    }
}
