<?php
require_once 'classes/Db_conn.php';
require_once 'classes/Pdo_methods.php';
// require_once 'classes/Db_conn.php';

class Date_time
{

    private $note_timestamp;
    private $note;
    private $output;

    public function __construct()
    {
        date_default_timezone_set('America/Detroit');
        $this->note_timestamp = '';
        $this->note = '';
    }


    function checkSubmit(): string
    {
        if (isset($_POST['getNotes'])) {
            if (empty($_POST['begDate']) || (empty($_POST['endDate']))) {
                return 'You must select a date range.';
            }
            $begDate = strtotime($_POST['begDate']);
            $endDate = strtotime($_POST['endDate']);
            $output = '<table class="table table-striped table-bordered"><thead><tr><th>Date and Time</th><th>Note</th></tr></thead><tbody>';
            $selectStatement = new Pdo_methods();
            $sql = "SELECT note_timestamp, note FROM notes WHERE note_timestamp BETWEEN $begDate AND $endDate ORDER BY note_timestamp DESC";

            $result = $selectStatement->selectNotBinded($sql);
            if ($result !== 'error') {
                if (empty($result)) {
                    return 'No notes in this time range.';
                }
                foreach ($result as $row) {
                    $output .= "<tr><td>" . htmlspecialchars(date('m/d/y h:i A', $row['note_timestamp'])) . "</td><td>" . htmlspecialchars($row['note']) . "</td></tr>";

                }
                $output .= "</tbody></table>";
                return $output;
            }
            }
            if (isset($_POST['addNote'])) {
                if (empty($_POST['dateTime']) || empty(trim($_POST['note']))) {
                    $output = "You need to enter a date, time and note.";
                    return $output;
                }
                $this->note_timestamp = strtotime($_POST['dateTime']);
                $this->note = $_POST['note'];

                $dataInsert = new Pdo_methods();
                $sql = "INSERT INTO notes (note_timestamp, note) VALUES (:note_timestamp, :note)";

                $bindings = [
                    [':note_timestamp', $this->note_timestamp, 'int'],
                    [':note', $this->note, 'str']
                ];

                if ($dataInsert->otherBinded($sql, $bindings) === 'noerror') {
                    return 'Note added.';
                } else {
                    return 'Something went wrong';
                }
            }
            return "";

        }
    }


