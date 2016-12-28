<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; 
use App\Http\Requests;
use App\Visitor;
use App\Http;
use App;
use Auth;
use Excel;
use PDF;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

    }
    public function getvisitor(Request $request){
        
        $user_id = Auth::user()->id;
        switch($request->load){
            case'yesterday':
                $report_title = 'Yesterday - Mine';
                $students = Visitor::where('dealtby_id','=',$user_id)
                    ->where('status','=','Info')
                    ->whereDate('created_at', '=', date('Y-m-d',  strtotime("-1 day")))->get();
                break;
            case'last7day':
                $report_title = 'Last 7 Days - Mine';
                $students = Visitor::where('dealtby_id','=',$user_id)
                        ->where('status','=','Info')
                        ->whereDate('created_at', '>=', date('Y-m-d',  strtotime("-30 day")))->get();
                break;
            case'last30day':
                $report_title = 'Last 30 Days - Mine';
                $students = Visitor::where('dealtby_id','=',$user_id)
                        ->where('status','=','Info')
                        ->whereDate('created_at', '>=', date('Y-m-d',  strtotime("-7 day")))->get();
                break;
            case'viewalldata':
                $report_title = 'View All Data';
                $students = Visitor::where('status','=','Info')->get();
                break;
            default:
                $report_title = 'Today - Mine';
                $students = Visitor::where('dealtby_id','=',$user_id)
                        ->where('status','=','Info')
                        ->whereDate('created_at', '=', date('Y-m-d'))->get();
        }
        //$students = DB::table('students')->get();
        return view('visitors.list_visitors', compact('students'),['report_title'=>$report_title]);
    }
    public function export_visitor_pdf(){
        $user_id = Auth::user()->id;
        $students = DB::table('visitors')
                ->where('dealtby_id','=',$user_id)
                ->get();
        $pdf = PDF::loadView('visitors.list_visitors_pdf', compact('students'));
        return $pdf->download('VisitrsReport.pdf');
    }
    public function export_visitor(){
        //http://laraveldaily.com/laravel-excel-export-eloquent-models-results-easily/
        $user_id = Auth::user()->id;
        $students = Visitor::select('id AS ID', 'first_name As First Name', 'last_name AS LastName','mobile As Contact','program as Program','visit_type as CallVisit','information_source as InformationSource','dealt_by as DealtBy','status As AdmissionStatus')
                ->where('dealtby_id','=',$user_id)
                ->get();
        $excel = App::make('excel');
        Excel::create('visitors', function($excel) use($students) {
            $excel->sheet('Visitors Data', function($sheet) use($students) {
                $sheet->fromArray($students);
            });
        })->export('xls');
    }
    public function getvisitor_in_json(Request $request){
        return Visitor::find($request->id)->toJson();
    }
    public function add_visitor(Request $request){
        //print_r($request->get('visitor_edit_id'));
        if($request->get('visitor_edit_id')){
            $visitor =  Visitor::find($request->get('visitor_edit_id'));
        }else{
            $visitor = new Visitor();
        }
        $visitor->first_name = $request->get('first_name');
        $visitor->last_name  = $request->get('last_name');
        $visitor->program    = $request->get('program');
        $visitor->visit_type = $request->get('visit_type');
        $visitor->information_source = $request->get('information_source');
        $visitor->mobile     = $request->get('mobile');
        $visitor->dealtby_id = Auth::user()->id;
        $visitor->dealt_by   = Auth::user()->name;
        $visitor->status = 'Info';
        $visitor->save();
        $request->session()->flash('flash_message', 'Visitor was successful added!');
        return redirect('visitor');
        //return back();
    }
    public function remove_visitor(Request $request){
         Visitor::destroy($request->visitor_id);
         $request->session()->flash('flash_message', 'Visitor was successful removed!');
         return back();
    }
}