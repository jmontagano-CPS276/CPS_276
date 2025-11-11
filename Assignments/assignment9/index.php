<?php
/**
 * Main form handling script
 * Demonstrates the usage of StickyForm class for form validation and rendering
 * Includes various form elements like text inputs, select boxes, radio buttons, and checkboxes
 */

require_once('classes/StickyForm.php');
require_once 'classes/Pdo_methods.php';

$output = '';
$tableOutput = '';

// Configuration array defining the structure and validation rules for the form
$formConfig = [
    // First name field configuration
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*First Name',
        'name' => 'first_name',
        'id' => 'first_name',
        'errorMsg' => null,//if this is set to null then the default error message will appear
        'error' => '',
        'required' => true,
        'value' => 'Monty'
    ],

    // Last name field configuration
    'last_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'Last Name',
        'name' => 'last_name',
        'id' => 'last_name',
        'errorMsg' => 'You must enter a valid last name.',
        'error' => '',
        'required' => false,
        'value' => 'Python'
    ],

    // Email field configuration
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => false,
        'value' => 'jmonty@wccnet.edu'
    ],

    'password' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => '*Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)',
        'error' => '',
        'required' => false,
        'value' => 'examplePass@123!'

    ],

    'confirm_password' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => 'Confirm Password',
        'name' => 'confirm_password',
        'id' => 'confirm_password',
        'errorMsg' => 'Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)',
        'error' => '',
        'required' => false,
        'value' => 'examplePass@123!'
    ],

    // Master status for form validation
    'masterStatus' => [
        'error' => false
    ]
];

// Initialize StickyForm instance for form handling
$stickyForm = new StickyForm();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data and update form configuration
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);

    // Check if form is valid (no errors)
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
        if ($_POST['password'] === $_POST['confirm_password']) {

            $sql = "SELECT email FROM users WHERE email = :email";
            $bindings = [[':email', $_POST['email'], 'str']];
            $pdo = new Pdo_Methods();

            if (count($pdo->selectBinded($sql, $bindings)) > 0) {
                $output = 'There is already a record with that email';

            } else {

                $sql = "INSERT into users (email, first_name, last_name, password) VALUES (:email, :first_name, :last_name, :password)";
                $bindings =
                    $bindings = [
                        [':email', $_POST['email'], 'str'],
                        [':first_name', $_POST['first_name'], 'str'],
                        [':last_name', $_POST['last_name'], 'str'],
                        [':password', password_hash($_POST['password'], PASSWORD_DEFAULT), 'str']
                    ];

                $output = $pdo->otherBinded($sql, $bindings) ? "You have been added to the database." : "Something went wrong.";
                foreach ($formConfig as $key => &$field) {
                    if (isset($field['value'])) {
                        $field['value'] = '';
                    }
                }
            }

        } else {
            $formConfig['confirm_password']['error'] = 'Your passwords must match.';
        }
    }
}

$sql = "SELECT first_name, last_name, email, password FROM users";
$pdo = new Pdo_Methods();
$records = $pdo->selectNotBinded($sql);

if ($records === 'error') {
    $tableOutput = '<p>Error retrieving users.</p>';
} else if (count($records) == 0) {
    $tableOutput = "No Records to display.";
} else {
    $tableOutput = '<table class="table table-bordered mt-2">
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Password</th>
  </tr>';
    foreach ($records as $row) {
        $tableOutput .= '<tr>';
        $tableOutput .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        $tableOutput .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        $tableOutput .= '<td>' . htmlspecialchars($row['email']) . '</td>';
        $tableOutput .= '<td>' . htmlspecialchars($row['password']) . '</td>';
        $tableOutput .= '</tr>';
    }
}
$tableOutput .= '</table>';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sticky Form Example</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <p><?php echo $output ?></p>
    <div class="container mt-5">
        <!-- Main form container -->
        <form method="post" action="index.php">
            <!-- Name fields row -->
            <div class="row">
                <!-- First name field -->
                <div class="col-md-6">
                    <?php echo $stickyForm->renderInput($formConfig['first_name'], 'mb-3'); ?>
                </div>

                <!-- Last name field -->
                <div class="col-md-6">
                    <?php echo $stickyForm->renderInput($formConfig['last_name'], 'mb-3'); ?>
                </div>
            </div>

            <!-- Contact information row -->
            <div class="row">
                <!-- Email field -->
                <div class="col-md-3">
                    <?php echo $stickyForm->renderInput($formConfig['email'], 'mb-3'); ?>
                </div>
                <!-- password selection -->
                <div class="col-md-3">
                    <?php echo $stickyForm->renderInput($formConfig['password'], 'mb-3'); ?>
                </div>
                <div class="col-md-3">
                    <?php echo $stickyForm->renderInput($formConfig['confirm_password'], 'mb-3'); ?>
                </div>

            </div>

            <!-- Submit button -->
            <input type="submit" class="btn btn-primary" value="Register">
        </form>
        <?php echo $tableOutput ?>
    </div>



</body>

</html>