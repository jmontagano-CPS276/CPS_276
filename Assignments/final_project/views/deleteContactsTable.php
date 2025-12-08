<?php
require_once 'controllers/deleteContactProc.php';

function init()
{
    global $records, $msg, $deleted;
    if (count($records) === 0) {
        $msg = "<p></p>";
        $output = "<p>There are no records to display</p>";
    } else {
        $output = <<<HTML

        <form method='post' action='index.php?page=deleteContacts'>
            <input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br><table class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Contact</th>
                    <th>age</th>
                    <th></th>
                </tr>
            </thead>
        <tbody>

HTML;

        foreach ($records as $row) {
            $output .= "<tr>
            <td>" . htmlspecialchars($row['fname']) . "</td>
            <td>" . htmlspecialchars($row['lname']) . "</td>
            <td>" . htmlspecialchars($row['address']) . "</td>
            <td>" . htmlspecialchars($row['city']) . "</td>
            <td>" . htmlspecialchars($row['state']) . "</td>
            <td>" . htmlspecialchars($row['phone']) . "</td>
            <td>" . htmlspecialchars($row['email']) . "</td>
            <td>" . htmlspecialchars($row['dob']) . "</td>
            <td>" . htmlspecialchars($row['contacts']) . "</td>
            <td>" . htmlspecialchars($row['age']) . "</td>
            <td><input type='checkbox' name='chkbx[]' value='" . htmlspecialchars($row['id']) . "' /></td></tr>";

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

    return '<h1>Delete Contact</h1>' . $msg . $output;
}