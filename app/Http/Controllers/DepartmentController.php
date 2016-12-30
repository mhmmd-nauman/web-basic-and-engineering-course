<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Http\Requests;
use Auth;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $departments = Department::all();
        $report_title = "Departments Information";
        return view('departments.list_departments', compact('departments'),['report_title'=>$report_title]);
    }
    public function add_department(Request $request){
        
        if($request->get('department_edit_id')){
            $department =  Department::find($request->get('department_edit_id'));
        }else{
            $department = new Department();
        }
        $department->department_name = $request->get('department_name');
        $department->contact  = $request->get('contact');
        $department->status    = $request->get('status');
        
        $department->entered_id = Auth::user()->id;
        //later needs to be fix when we have hod roles
        $department->hod_id   = Auth::user()->id;
        $department->save();
        $request->session()->flash('flash_message', 'Department was successful added!');
        
        return back();
    }
    public function remove_department(Request $request){
         Department::destroy($request->department_id);
         $request->session()->flash('flash_message', 'Department was successful removed!');
         return back();
    }
    public function department_in_json(Request $request){
        return Department::find($request->id)->toJson();
    }
    public function all_department_in_json(){
        return Department::where("status","=","Active")->get()->toJson();
    }
}
