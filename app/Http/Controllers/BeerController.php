<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\models\Bear;
use App\models\Fish;

class BeerController extends Controller
{
    //
    public function __construct()
    {
        //parent::__construct();
       
    }
    public function index()
    {
       // $this->args['bankaccounts'] = $this->beer->fish;
        
        $cerms = Bear::where('name', '=', 'Lawly')->first();
        //echo $cerms->name;
        //var_dump($cerms->picnics);
        //echo "<pre>";
        //print_r($cerms->picnics->toArray());
        //echo "</pre>";
    // get the picnics and their names and taste levels
        foreach ($cerms->picnics as $picnic)
            echo $picnic->name . ' ' . $picnic->taste_level;
        /*
        echo "here we go ddd";
       $adobot = Bear::where('name', '=', 'Adobot')->first();
       $fish = $adobot->fish;
       echo $fish->weight;
        $bears = Bear::find(4);
        $bears->danger_level = 5;
        $bears->save();
        echo "<pre>";
        print_r($bears->toArray());
        foreach($bears as $beer){
            //->danger_level = 10;
            //$beer->save();
            //echo $beer->name." ".$beer->fish()->weight;
        }
        echo "</pre>";
        */
    }
}
