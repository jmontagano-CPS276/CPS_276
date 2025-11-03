<?php
require_once 'classes/Pdo_methods.php';
    $output = '';
    $selectStatement = new Pdo_methods();
    $sql = 'SELECT * FROM UploadedFiles';
    $result = $selectStatement->selectNotBinded($sql);
    if ($result !== 'error') {
        if (empty($result)) {
            $output = "Looks like no files have been added yet!";
            return;
        }
        $output = "<ul>";
        foreach ($result as $row) {
            $output .= "<li><a target='_blank' href='" . htmlspecialchars($row['filepath']) . "'>" . htmlspecialchars($row['filename']) . "</a></li>";

}
    $output .= "</ul>";
    return;
}
    $output = 'Error, something went wrong.';
    return;



