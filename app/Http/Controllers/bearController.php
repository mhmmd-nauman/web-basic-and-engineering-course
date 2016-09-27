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
    public function index(){
        $fb = new \Facebook\Facebook([
  'app_id' => '918969521579739',
  'app_secret' => 'f8181732ce846cb95fd6d101df0db210',
  'default_graph_version' => 'v2.7',
  //'default_access_token' => '980368522046150|NXnJJk3wguFHF5mM_c51U2PnFOg', // optional
]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
   //$helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();
  // $accessToken='980368522046150|NXnJJk3wguFHF5mM_c51U2PnFOg';
try {
    $accessToken = $helper->getAccessToken();
   //$accessToken="EAACEdEose0cBANcurNwh5ZCE7FQZC6g5ihxXY0OZBrZCAKkd0GQ0kWMhAZBgBonsF5ubKvq5770ySZAm9JWfMh0hJYXBGyBLZBlMVh4BuvMzltFoK7EwSPFf4HPTurN2xYDt6FHKMwzsTdU11O8BSZBOi3UvjOVpDHeZCT0WB3rf04QZDZD";
  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/me', $accessToken);
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();
echo 'Logged in as ' . $me->getName();
    }

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
        $users = DB::table('fish')->get();

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
