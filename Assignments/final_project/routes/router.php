<?php
require 'includes/security.php';

$content = '';

if (!isset($_GET['page'])) {
    header("Location: index.php?page=login");
    exit;
}
// GETS THE GET REQUEST VALUE FOR WHATEVER'S IN PAGE
$page = $_GET['page'];

if (!$loggedIn) {

    if ($page !== 'login') {
        header("Location: index.php?page=login");
        exit;
    }

    require_once 'views/loginForm.php';
    $content = init();
    return; 
}
// IF ADMIN THESE LINKS ARE ALLOWABLE
if ($admin) {

    switch ($page) {
        case 'addContact':
            require_once 'views/addContactForm.php';
            break;

        case 'deleteContacts':
            require_once 'views/deleteContactsTable.php';
            break;

        case 'addAdmin':
            require_once 'views/addAdminForm.php';
            break;

        case 'deleteAdmins':
            require_once 'views/deleteAdminsTable.php';
            break;

        case 'logout':
            require_once 'views/logout.php';
            break;

        case 'welcome':
            require_once 'views/welcome.php';
            break;

        case 'login':
            require_once 'views/logout.php';
            init(); 
            header("Location: index.php?page=login");
            exit;

        default:
            header("Location: index.php?page=login");
            exit;
    }

    $content = init();
    return;
}


switch ($page) {

    case 'addAdmin':
    case 'deleteAdmins':
        require_once 'views/logout.php';
        init();
        exit;

    case 'addContact':
        require_once 'views/addContactForm.php';
        break;

    case 'deleteContacts':
        require_once 'views/deleteContactsTable.php';
        break;

    case 'logout':
        require_once 'views/logout.php';
        break;

    case 'welcome':
        require_once 'views/welcome.php';
        break;

    case 'login':
        require_once 'views/logout.php';
        init();
        header("Location: index.php?page=login");
        exit;

    default:
        header("Location: index.php?page=login");
        exit;
}

$content = init();
return;
