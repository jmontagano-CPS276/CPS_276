<?php
require_once 'controllers/deleteAdminProc.php';

function init()
{
    global $records, $msg, $deleted;
    if (count($records) === 0) {
        $msg = "<p></p>";
        $output = "<p>There are no records to display</p>";
    } else {
        $output = <<<HTML

        <form method='post' action='index.php?page=deleteAdmins'>
            <input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br><table class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Status</th>
                </tr>
            </thead>
        <tbody>

HTML;

        foreach ($records as $row) {
            $output .= "<tr><td>{$row['fname']}</td>
            <td>{$row['lname']}</td>
            <td>{$row['email']}</td>
            <td>{$row['password']}</td>
            <td>{$row['status']}</td>
            <td><input type='checkbox' name='chkbx[]' value='{$row['id']}' /></td></tr>";
        }

        $output .= "</tbody></table></form>";

        if ($records == "error") {
            $msg = "<p style='color:red'>Could not display records</p>";
        } else {
            if (!$deleted) {
                $msg = "<p>&nbsp;</p>";
            } else {
                $msg = "<p style='color: green'>Contact(s) deleted</p>";
            }

        }

    }

    return $msg . $output;
}