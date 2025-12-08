<?php

require_once 'classes/StickyForm.php';
require_once 'classes/Pdo_methods.php';

$acknowledgment = "<p></p>";//I use $acknowledgment as a placeholder because sometimes it has data and sometimes it does not and if it does not I don't want the space to collapse. 

$formConfig = [
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'First Name',
        'name' => 'first_name',
        'id' => 'first_name',
        'errorMsg' => 'You must enter a valid first name',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'last_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'Last Name',
        'name' => 'last_name',
        'id' => 'last_name',
        'errorMsg' => 'You must enter a valid last name.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => true,
        'value' => 'example@gmail.com'
    ],
    'password' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => 'Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'You must enter a valid password.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'status' => [
        'type' => 'select',
        'label' => 'Status',
        'name' => 'status',
        'id' => 'status',
        'options' => [
            '' => 'Please Select a Status',
            'staff' => 'Staff',
            'admin' => 'Admin'
        ],
        'selected' => '',
        'errorMsg' => 'You must select a status.',
        'error' => '',
        'required' => true
    ],

    'masterStatus' => [
        'error' => false
    ]
];



// Initialize StickyForm instance
$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {

        $pdo = new Pdo_methods();
        $sql = 'SELECT email FROM admins WHERE email = :email';
        $bindings =
            [[':email', $_POST['email'], 'str']];
        $result = $pdo->selectBinded($sql, $bindings);
        if (count($result) > 0) {
            $acknowledgment = 'An account with that email already exists.';
        } else {
            $password = $_POST['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO admins (fname, lname, email, password, status) VALUES (:fname, :lname, :email, :password, :status)";
            $bindings = [
                [':fname', $_POST['first_name'], 'str'],
                [':lname', $_POST['last_name'], 'str'],
                [':email', $_POST['email'], 'str'],
                [':password', $password, 'str'],
                [':status', $_POST['status'], 'str']
            ];
            $result = $pdo->otherBinded($sql, $bindings);


            if ($result === 'error') {
                $acknowledgment = '<p style="color: red">There was an error adding the name</p>';
            } else {
                $acknowledgment = '<p style="color: green">User has been added</p>';
            }
            foreach ($formConfig as $key => &$field) {
                if (isset($field['value'])) {
                    $field['value'] = '';
                }

                if (isset($field['selected'])) {
                    $field['selected'] = '';
                }

            }
        }
    }
}