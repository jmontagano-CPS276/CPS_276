<?php
require_once '../classes/Pdo_methods.php';
    $output = '';
    $selectStatement = new Pdo_methods();
    $sql = 'SELECT * FROM UploadedFiles';
    $result = $selectStatement->selectNotBinded($sql);
    $output = "<ul>";
    foreach ($result as $row) {
        $output .= "<li><a target='_blank' href="  . $row['filepath'] . '>' . $row['filename'] . '</a></li>';
}
    $output .= "</ul>";
    return $output;



