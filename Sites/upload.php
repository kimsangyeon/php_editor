<?php
 
$path = "./uploadFile/";
$file_server_path = realpath(__FILE__);
$server_path = str_replace(basename(__FILE__), "", $file_server_path);
 
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
$data   = array();
$data['success'] = false;
 
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
     
    if(strlen($name))
    {
        list($txt, $ext) = explode(".", $name);
        if(in_array(strtolower($ext),$valid_formats))
        {
            if($size < ( 3072*3072 )) // Image size max 1 MB
            {
                $actual_image_name = time()."-image.".$ext;
                $tmp = $_FILES['file']['tmp_name'];
                if(move_uploaded_file($tmp, $server_path."uploadFile/".$actual_image_name))
                {
                    $data['success'] = true;
                    $data['uploadPath']  = "/~kimsangyeon/uploadFile/".$actual_image_name;
                }
                else
                {
                    $data['success'] = false;
                    $data['error'] = $server_path."uploadFile/".$actual_image_name;
                }
                     
            }
            else
                $data['error'] = "Image file size max 1 MB";
        }
        else
            $data['error'] = "Invalid file format..";
    }
    else
        $data['error'] = "Please select image..!";
}
 
echo json_encode($data);
 
?>