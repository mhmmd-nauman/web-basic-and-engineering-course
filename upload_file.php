<?php
$target_dir = "uploads/";
$target_file = $target_dir . $_FILES["fileToUpload"]["name"];
copy($_FILES["fileToUpload"]["tmp_name"], $target_file);
?>