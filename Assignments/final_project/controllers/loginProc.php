<?php
require_once 'classes/StickyForm.php';
require_once 'classes/Pdo_methods.php';
require_once 'includes/security.php';

// session_start();
$acknowledgment = "<p></p>";//I use $acknowledgment as a placeholder because sometimes it has data and sometimes it does not and if it does not I don't want the space to collapse. 
$failed = false;
$formConfig = [
    'email' => [
        'type' => 'text',
        // 'regex' => 'email',
        'label' => 'Username',
        'name' => 'email',
        'id' => 'email',
        // 'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'password' => [
        'type' => 'text',
        // 'regex' => 'password',
        'label' => 'Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => '',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'masterStatus' => [
        'error' => false
    ]
];

   $stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $formConfig = $stickyForm->validateForm($_POST, $formConfig);

    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {

        $pdo = new Pdo_methods();

        $sql = "SELECT id, fname, lname, email, password, status 
                FROM admins 
                WHERE email = :email";

        $bindings = [
            [':email', $_POST['email'], 'str']
        ];

        $records = $pdo->selectBinded($sql, $bindings);

        if ($records === 'error' || count($records) !== 1) {
            $acknowledgment = "<p>Invalid Username Or Password.</p>";
            $failed = true;
        }
     
        if (!$failed &&  password_verify($_POST['password'], $records[0]['password']))  {

            $_SESSION['ID'] = $records[0]['id'];
            $_SESSION['fname'] = $records[0]['fname'];
            $_SESSION['logged_in'] = true;

            if ($records[0]['status'] === 'admin') {
                $_SESSION['admin'] = true;
                header("Location: index.php?page=welcome");
                exit;
            } else {
                $_SESSION['admin'] = false;
                header("Location: index.php?page=welcome");
                exit;
            }

        } else {
            $acknowledgment = "<p>Invalid Username Or Password.</p>";
        }
    }
}

