<?php
require_once '../classes/Db_conn.php';
require_once '../classes/Pdo_methods.php';

$output = "";

if (!ISSET($_POST['fileUpload'])) {
    return;
}
if ((trim(empty($_FILES['file']['name'])))) {
    $output = "No File Selected, you must select a file to upload.";
    return $output;
}
if (trim(empty($_POST['fileName']))) {
    $output = "You must have a name for the file";
    return $output;
}

const PATH = '/home/j/m/jmontagano/public_html/cps276/Assignments/assignment7/files/';
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$fileName = $_POST['fileName'];
$filePath = PATH . basename($fileName);
$fileSize = $_FILES['file']['size'];
$fileType = $_FILES['file']['type'];

if ($fileType != 'application/pdf') {
    $output = "Error, incorrect file type.";
    return $output;
}

if ($fileSize >= 100_000) {
    $output = "Error, file size too large.";
    return $output;
}

move_uploaded_file($_FILES['file']['tmp_name'], $filePath);

$filePath = 'https://russet-v8.wccnet.edu/~jmontagano/cps276/Assignments/assignment7/files/' . $fileName;

$dataInsert = new Pdo_methods();
$sql = "INSERT INTO UploadedFiles (filename, filepath) VALUES (:filename, :filepath)";

$bindings = [
    [':filename', $fileName, 'str'],
    [':filepath', $filePath, 'str']
];

if ($dataInsert->otherBinded($sql, $bindings)  == 'noerror') {
    $output = 'Successfully uploaded file!';
    return $output;
} else {
    $output = 'Something went wrong.';
    return $output;
}








