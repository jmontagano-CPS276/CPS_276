<?php
function init() {
session_start();

/* DELETE THE SESSION COOKIE */
setcookie("PHPSESSID", "", time() - 3600, "/");

/* DESTROY SESSION DATA */
session_destroy();

/* REDIRECT TO INDEX */
header('Location: index.php?page=loginForm');
exit;
}
    