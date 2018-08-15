<?php

$path = "./importDoc/";
$file_server_path = realpath(__FILE__);
$server_path = str_replace(basename(__FILE__), "", $file_server_path);

$data   = array();
$data['success'] = false;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];

}

echo json_encode($data);

?>