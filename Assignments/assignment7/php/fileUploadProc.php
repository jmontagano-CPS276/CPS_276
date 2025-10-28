<?php
require_once __DIR__ . '/../classes/Db_conn.php';
require_once __DIR__ . '/../classes/Pdo_methods.php';

const SERVERPATH = '/home/j/m/jmontagano/public_html/cps276/Assignments/assignment7/files/';
const URLPATH = 'https://russet-v8.wccnet.edu/~jmontagano/cps276/Assignments/assignment7/files/';
$output = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['fileUpload'])) {
        return;
    }
    if ((empty($_FILES['file']['name']))) {
        $output = "No File Selected, you must select a file to upload.";
        return;
    }
    if (trim($_POST['fileName']) === '') {
        $output = "You must have a name for the file";
        return;
    }

    // File name the user enters
    $fileName = $_POST['fileName'];
    // Actual file name
    $fileNameActual = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $filePath = SERVERPATH . $fileNameActual;

    if ($fileType !== 'application/pdf') {
        $output = "Error, incorrect file type.";
        return;
    }

    if ($fileSize >= 100_000) {
        $output = "Error, file size too large.";
        return;
    }

    move_uploaded_file($_FILES['file']['tmp_name'], $filePath);

    $filePath = URLPATH . $fileNameActual;

    $dataInsert = new Pdo_methods();
    $sql = "INSERT INTO UploadedFiles (filename, filepath) VALUES (:filename, :filepath)";

    $bindings = [
        [':filename', $fileName, 'str'],
        [':filepath', $filePath, 'str']
    ];

    if ($dataInsert->otherBinded($sql, $bindings) === 'noerror') {
        $output = 'Successfully uploaded file!';
        return;
    } else {
        $output = 'Something went wrong.';
        return;
    }
}









