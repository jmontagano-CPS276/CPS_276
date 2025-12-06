<?php

require_once('classes/StickyForm.php');
require_once('classes/Pdo_methods.php');

$acknowledgment = "<p></p>";//I use $acknowledgment as a placeholder because sometimes it has data and sometimes it does not and if it does not I don't want the space to collapse. 

$formConfig = [
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*First Name',
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
        'label' => '*Last Name',
        'name' => 'last_name',
        'id' => 'last_name',
        'errorMsg' => 'You must enter a valid last name.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],

    'address' => [
        'type' => 'text',
        'regex' => 'address',
        'label' => '*Address',
        'name' => 'address',
        'id' => 'address',
        'errorMsg' => 'You must enter a valid address.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],

    'city' => [
        'type' => 'text',
        'regex' => 'city',
        'label' => '*City',
        'name' => 'city',
        'id' => 'city',
        'errorMsg' => 'You must enter a valid city.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],

    'state' => [
        'type' => 'select',
        'label' => '*State',
        'name' => 'state',
        'id' => 'state',
        'options' => [
            'MI' => 'Michigan',
            'OH' => 'Ohio',
            'IL' => 'Illinois',
            'WI' => 'Wisconsin',
            'NV' => 'Nevada'
        ],
        'selected' => '',
        'errorMsg' => 'Please select a state.',
        'error' => '',
        'required' => true
    ],

    'phone' => [
        'type' => 'text',
        'regex' => 'phone',
        'label' => '*Phone',
        'name' => 'phone',
        'id' => 'phone',
        'errorMsg' => 'You must enter a valid phone number.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],

    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => '*Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],

    'age' => [
        'type' => 'radio',
        'label' => 'Choose an Age Range',
        'name' => 'age',
        'id' => 'age',
        'options' => [
            ['value' => '0-17', 'label' => '0-17', 'checked' => false],
            ['value' => '18-30', 'label' => '18-30', 'checked' => false],
            ['value' => '30-50', 'label' => '30-50', 'checked' => false],
            ['value' => '50+', 'label' => '50+', 'checked' => false]
        ],
        'required' => true,
        'errorMsg' => 'Please choose an age range.',
        'error' => ''
    ],

    'dob' => [
        'type' => 'text',
        'regex' => 'dob',
        'label' => '*Date of birth',
        'name' => 'dob',
        'id' => 'dob',
        'errorMsg' => 'You must enter a valid date of birth.',
        'error' => '',
        'required' => true,
        'value' => ''
    ],

    'contact' => [
        'type' => 'checkbox',
        'label' => 'Select One or More Options',
        'name' => 'contact',
        'id' => 'contact',
        'options' => [
            ['value' => 'newsletter', 'label' => 'newsletter', 'checked' => false],
            ['value' => 'email', 'label' => 'email', 'checked' => false],
            ['value' => 'text', 'label' => 'text', 'checked' => false]
        ],
        'required' => true,
        'errorMsg' => 'Please select at least one contact method.',
        'error' => ''
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

        $dob = $_POST['dob']; // e.g., "03/12/2024"
        $dobf = DateTime::createFromFormat('m/d/Y', $dob)->format('Y-m-d');
        $contacts = implode(', ', $_POST['contact']);


        $sql = "INSERT INTO contacts (fname, lname, address, city, state, phone, email, dob, contacts, age)
        VALUES (:fname, :lname, :address, :city, :state, :phone, :email, :dob, :contacts, :age)";

        $bindings = [
            [':fname', $_POST['first_name'], 'str'],
            [':lname', $_POST['last_name'], 'str'],
            [':address', $_POST['address'], 'str'],
            [':city', $_POST['city'], 'str'],     
            [':state', $_POST['state'], 'str'],
            [':phone', $_POST['phone'], 'str'],
            [':email', $_POST['email'], 'str'],
            [':dob', $dobf, 'str'],
            [':contacts', $contacts, 'str'],
            [':age', $_POST['age'], 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            $acknowledgment = '<p style="color: red">There was an error adding the name</p>';
        } else {
            $acknowledgment = '<p style="color: green">Name has been added</p>';
        }
    
    }
}