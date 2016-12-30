<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProgramOffered;
use Auth;

class ProgramOfferedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $programs = ProgramOffered::all();
        $report_title = "Programs Information";
        return view('programs.list_programs', compact('programs'),['report_title'=>$report_title]);
    }
    public function add_program(Request $request){
        
        if($request->get('program_edit_id')){
            $program =  ProgramOffered::find($request->get('program_edit_id'));
        }else{
            $program = new ProgramOffered();
        }
        $program->program_name = $request->get('program_name');
        $program->duration  = $request->get('duration');
        $program->status    = $request->get('status');
        $program->department_id    = $request->get('department');
        
        $program->entered_id = Auth::user()->id;
        //later needs to be fix when we have incharge roles
        $program->incharge_id   = Auth::user()->id;
        $program->save();
        $request->session()->flash('flash_message', 'Program was successful added!');
        
        return back();
    }
    public function remove_program(Request $request){
         ProgramOffered::destroy($request->program_id);
         $request->session()->flash('flash_message', 'Program was successful removed!');
         return back();
    }
    public function program_in_json(Request $request){
        return ProgramOffered::find($request->id)->toJson();
    }
    
    public function all_programs_in_json(){
        return ProgramOffered::where("status","=","Active")->get()->toJson();
    }
    
}