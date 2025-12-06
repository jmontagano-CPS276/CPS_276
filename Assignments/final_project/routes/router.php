<?php
require 'includes/security.php';      // sets $loggedIn, $admin from $_SESSION
// require 'controllers/loginProc.php';  

$defaultPage = 'loginForm';
$content = '';

$page = $_GET['page'] ?? $defaultPage;

if (!$loggedIn) {

    if ($page !== 'loginForm') {
        header("Location: index.php?page=$defaultPage");
        exit;
    }

    require_once 'views/loginForm.php';
    $content = init();
    return;
}

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

        case 'loginForm':
            header("Location: index.php?page=$defaultPage");
            exit;

        default:
            header("Location: index.php?page=$defaultPage");
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

    case 'loginForm':
        header("Location: index.php?page=$defaultPage");
        exit;

    default:
        header("Location: index.php?page=$defaultPage");
        exit;
}

$content = init();

