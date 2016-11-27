<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use App\Http\Requests;
use App\Bear;
use App\Visitor;
use App\Http;
use App\models\Fish;
use App;
use Auth;
use Excel;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

    }
    public function getvisitor(){
        $students = DB::table('students')->get();
        return view('visitors.list_visitors', compact('students'));
    }
    public function export_visitor(){
        //http://laraveldaily.com/laravel-excel-export-eloquent-models-results-easily/
        $students = Visitor::select('id AS ID', 'first_name As First Name', 'last_name AS LastName','mobile As Contact','program as Program','visit_type as CallVisit','information_source as InformationSource','dealt_by as DealtBy','admission_status As AdmissionStatus')->get();
        $excel = App::make('excel');
        Excel::create('visitors', function($excel) use($students) {
            $excel->sheet('Visitors Data', function($sheet) use($students) {
                $sheet->fromArray($students);
            });
        })->export('xls');
    }
     public function getpicnic(){
        $users = DB::table('picnics')->get();

        return view('my.picnic', ['users' => $users]);
    }
     public function getfish(){
        $users = DB::table('fish')->get();

        return view('my.fish', ['users' => $users]);
    }
     public function gettree(){
        $users = DB::table('trees')->get();

        return view('my.trees', ['users' => $users]);
    }
    
    public function add_visitor(Request $request){
        $visitor = new Visitor();
        $visitor->first_name =$request->get('first_name');
        $visitor->last_name = $request->get('last_name');
        $visitor->program=$request->get('program');
        $visitor->visit_type=$request->get('visit_type');
        $visitor->information_source=$request->get('information_source');
        $visitor->mobile=$request->get('mobile');
        $visitor->dealt_by = Auth::user()->name;
        $visitor->save();
        return back();
    }

}
