<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App;
use DB;
use PDF;

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
    
    public function manage_pdf(){
        //$pdf = App::make('dompdf.wrapper');
        //$pdf->loadHTML('<h1>Test</h1>');
        //return $pdf->stream();
        $students = DB::table('students')->get();
        $pdf = PDF::loadView('visitors.list_visitors_pdf', compact('students'));
        return $pdf->download('invoice.pdf');
    } 
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
