<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$loggedIn = ($_SESSION['logged_in'] ?? false) === true;
$admin    = ($_SESSION['admin']     ?? false) === true;

