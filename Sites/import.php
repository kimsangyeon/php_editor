<?php
$path = "./importDoc/";
$file_server_path = realpath(__FILE__);
$server_path = str_replace(basename(__FILE__), "", $file_server_path);

$GLOBALS['CONVERT_SERVER'] = "http://synapeditor.iptime.org:3000/convertDocToPb";
$GLOBALS['ZIP_FILE_PATH'] = $server_path."uploadFile/doc/zip/";

$valid_formats = array("doc", "docx");
$data   = array();
$data['success'] = false;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    print('------importDoc------');
    $name = $_FILES['docFile']['name'];
    $tmp_name = $_FILES['docFile']['tmp_name'];
    $type = $_FILES['docFile']['type'];
    $size = $_FILES['docFile']['size'];

    if (strlen($name)) {
        list($txt, $ext) = explode(".", $name);

        if (in_array(strtolower($ext),$valid_formats)) {
            $result = getConvertToPbData($tmp_name, $type, $name, $size);
            $fp = fopen($GLOBALS['ZIP_FILE_PATH'] . "/document.word.pb.zip", 'w');
            fwrite($fp, $result);
            fclose($fp);

        } else {
            $data['error'] = "Invalid file format..";
        }
    } else {
        $data['error'] = "Please select file..!";
    }
}

echo json_encode($data);

?>

<!-- convert to pb data-->
<?php
$file_server_path = realpath(__FILE__);
$server_path = str_replace(basename(__FILE__), "", $file_server_path);

function getConvertToPbData($tmp_name, $type, $name, $size) {
    $headers = array("Content-Type:multipart/form-data");
    $curl_file = curl_file_create($tmp_name, $type, $name);
    $post_fields = array(
        'file' => $curl_file);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_INFILESIZE, $size);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $GLOBALS['CONVERT_SERVER']);

    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);

    curl_close ($ch);

    echo substr($response, $header_size);
}
?>

<!--unzipFile-->
<?php

function unzipFile() {

}

?>
