<?php
$name = "11.222.333/444-5";
if (!preg_match("/^(\d{2}\.?\d{3}\.?\d{3}\/?\d{4}-?\d{2})$/",$name)) {
  echo $nameErr = "Only letters and white space allowed"; 
} else{
    echo "valid";
}