<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use App\Http\Requests;
use App\Bear;
use App\Http;

use App\models\Fish;

class bearController extends Controller
{
    //
    public function getbear(){
        $users = DB::table('bears')->get();
        return view('my.print', compact('users'));
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
    
    public function add_bear(Request $request){
        $bear = new Bear;
        
        $bear->name =$request->get('name');
        $bear->type = $request->get('type');
        $bear->danger_level=$request->get('level');
        $bear->save();
        return back();
    }
//    public function missingMethod($parameters = array()) {
//        parent::missingMethod($parameters);
//    }

}
