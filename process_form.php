<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($_POST['fname'] == ""){
    echo "its a bad attacker request";
    exit;
    //header("Location:form_validation.html?message=first name error");
}

// we are ready for processing
echo "<pre>";
print_r($_POST); 
echo "</pre>";