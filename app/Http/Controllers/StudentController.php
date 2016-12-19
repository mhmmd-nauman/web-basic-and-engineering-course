<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use App\Http\Requests;
use App\Bear;
use App\Student;
use App\Visitor;
use App\Http;
use App\models\Fish;
use App;
use Auth;
use Excel;
use PDF;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

    }
   
    public function export_student_pdf(){
        
        $students = DB::table('visitors')->get();
        $pdf = PDF::loadView('visitors.list_visitors_pdf', compact('students'));
        return $pdf->download('VisitrsReport.pdf');
    }
    public function export_student(){
        //http://laraveldaily.com/laravel-excel-export-eloquent-models-results-easily/
        $students = Student::select('id AS ID', 'first_name As First Name', 'last_name AS LastName','mobile As Contact','program as Program','visit_type as CallVisit','information_source as InformationSource','dealt_by as DealtBy','status As AdmissionStatus')->get();
        $excel = App::make('excel');
        Excel::create('visitors', function($excel) use($students) {
            $excel->sheet('Visitors Data', function($sheet) use($students) {
                $sheet->fromArray($students);
            });
        })->export('xls');
    }
    public function getstudent_in_json(Request $request){
        return Student::find($request->id)->toJson();
    }

    public function getstudents(Request $request){
        
        $user_id = Auth::user()->id;
        switch($request->load){
            case'yesterday':
                $report_title = 'Yesterday - Mine';
                $students = Student::where('dealtby_id','=',$user_id)
                    ->where('admission_status','=','accepted')
                    ->whereDate('created_at', '=', date('Y-m-d',  strtotime("-1 day")))->get();
                break;
            case'last7day':
                $report_title = 'Last 7 Days - Mine';
                $students = Student::where('dealtby_id','=',$user_id)
                    ->where('admission_status','=','accepted')
                    ->whereDate('created_at', '>=', date('Y-m-d',  strtotime("-30 day")))->get();
                break;
            case'last30day':
                $report_title = 'Last 30 Days - Mine';
                $students = Student::where('dealtby_id','=',$user_id)
                    ->where('admission_status','=','accepted')
                    ->whereDate('created_at', '>=', date('Y-m-d',  strtotime("-7 day")))->get();
                break;
            case'viewalldata':
                $report_title = 'View All Data';
                $students = Student::where('admission_status','=','accepted');
                break;
            default:
                $report_title = 'Today - Mine';
                $students = Student::where('dealtby_id','=',$user_id)
                    ->where('admission_status','=','accepted')
                    ->whereDate('created_at', '=', date('Y-m-d'))->get();
        }
        //$students = DB::table('students')->get();
        return view('students.list_students', compact('students'),['report_title'=>$report_title]);
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
    
    
    public function remove_student(Request $request){
         Student::destroy($request->visitor_id);
         $request->session()->flash('flash_message', 'Visitor was successful removed!');
         return back();
    }
    public function add_student(Request $request){
        
        $student = new Student();
        $student->visitor_id = $request->get('visitor_id');
        $student->first_name = $request->get('first_name');
        $student->last_name  = $request->get('last_name');
        //$student->program    = $request->get('program');
        //$student->visit_type = $request->get('visit_type');
        //$student->information_source = $request->get('information_source');
        $student->mobile     = $request->get('mobile');
        //$student->semester = $request->get('semester');
        $student->father_name = $request->get('father_name');
        $student->mobile = $request->get('mobile');
        $student->address = $request->get('address');
        $student->father_occupation = $request->get('father_occupation');
        $student->email = $request->get('email');
        $student->gender = $request->get('gender');
        $student->marital_status = $request->get('marital_status');
        $student->date_of_birth = date("Y-m-d",  strtotime($request->get('date_of_birth')));
        $student->country_of_citizenship = $request->get('country_of_citizenship');
        $student->cnic = $request->get('cnic');
        $student->phone = $request->get('phone');
        $student->postal_address = $request->get('postal_address');
        // end of tab 1
        
        $student->candidate_for_any_degree_title = $request->get('candidate_for_any_degree_title');
        
        // end of tab 2
        $student->years_of_english_medium = $request->get('years_of_english_medium');
        $student->first_language = $request->get('first_language');
        $student->honors_awards = $request->get('honors_awards');
        $student->fav_activities = $request->get('fav_activities');
        // end of tab 3
        $student->applicant_name = $request->get('applicant_name');
        $student->privately_supported_student = $request->get('privately_supported_student');
        $student->sponsor_name = $request->get('sponsor_name');
        $student->sponsor_relation = $request->get('sponsor_relation');
        $student->sponsor_sign_date = date("Y-m-d",  strtotime($request->get('sponsor_sign_date')));
        // end of tab 4
        $student->admission_status = $request->get('admission_status');
        $student->admission_date = date("Y-m-d",  strtotime($request->get('admission_date')));
        $student->interviewed_by = $request->get('interviewed_by');
        $student->chairman_admission_committee = $request->get('chairman_admission_committee');
        $student->fee_code = $request->get('fee_code');
        $student->fee_code_date = date("Y-m-d",  strtotime($request->get('fee_code_date')));
        // end of tab 5
        $student->dealtby_id = Auth::user()->id;
        $student->dealt_by   = Auth::user()->name;
        $student->save();
        // update visitor status
        if($student->visitor_id > 0){
            $rel_visitor = Visitor::find($student->visitor_id);
            $rel_visitor->status = $request->get('admission_status');
            $rel_visitor->save();
        }
        $request->session()->flash('flash_message', 'Visitor was successful added!');
        return redirect('student');
        //return back();
    }
    
}
