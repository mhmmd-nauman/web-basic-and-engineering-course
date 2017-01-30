<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$string = $_POST['inputstring'];
$data = explode(",", $string);
//echo "<pre>";
//print_r($data);
foreach($data as $index=>$value){
    echo  " index = $index  value = $value <br>";
}
//echo "</pre>";
echo date(" d M, Y");

//echo date("d M, Y", strtotime("- 8 days"));

// string functions