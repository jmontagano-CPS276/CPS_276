<?php
$nums = [];
for ($i = 0; $i < 50; $i++) {
    $nums[$i] = $i + 1;
}
$evenNums = [];
foreach ($nums as $num) {
    if ($num % 2 === 0) {
        $evenNums[] = $num;
    }
}
$evenNumbers = 'Even Numbers: ' . implode(" - ", $evenNums);

$form = <<<EOD
<form action="#" method="post">
<div class="mb-3">
  <label for="emailAddress" class="form-label">Email address</label>
  <input type="email" class="form-control" name="userEmail" id="emailAddress" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label for="textBox" class="form-label">Example textarea</label>
  <textarea class="form-control" name="userText" id="textBox" rows="3"></textarea>
</div>
</form>
EOD;

function createTable($rows, $columns) {
    $table = '<table class="table table-bordered">';
    for ($i = 1; $i <= $rows; $i++) {
        $table .= '<tr>';
        for ($j = 1; $j <= $columns; $j++) {
            $table .= "<td>Row {$i}, Col {$j}</td>";
        }
        $table .= '</tr>';
    }
    $table .= '</table>';
    return $table;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Basic Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container">
         <?php 
         echo $evenNumbers; 
         echo $form;
         echo createTable(8, 6);
        ?>
</body>
</html>