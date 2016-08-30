<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use App\Http\Requests;

class bearController extends Controller
{
    //
    public function getbear(){
        $users = DB::table('bears')->get();
        print_r($users);
        return view('my.print', ['users' => $users]);
    }
     public function getpicnic(){
        $users = DB::table('picnics')->get();

        return view('my.picnic', ['users' => $users]);
    }
     public function getfish(){
        $users = DB::table('fish1')->get();

        return view('my.fish', ['users' => $users]);
    }
     public function gettree(){
        $users = DB::table('trees')->get();

        return view('my.trees', ['users' => $users]);
    }
}
