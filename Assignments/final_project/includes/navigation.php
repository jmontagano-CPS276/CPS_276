<?php
require_once 'security.php';

if (!$loggedIn) {
    $nav = '';
} else {
    if ($admin) {
    $nav = <<<HTML
        <nav>
          <ul class="nav">
              <li class="nav-item">
                    <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
             </li>
             <li class="nav-item">
                    <a class="nav-link" href="index.php?page=deleteContacts">Delete Contact(s)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=addAdmin">Add Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=deleteAdmins">Delete Admin(s)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=logout">Logout</a>
            </li>
        </ul>
    </nav>
HTML;
} else if (!$admin) {
    $nav = <<<HTML
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=deleteContacts">Delete Contact(s)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=logout">Logout</a>
            </li>
        </ul>
    </nav>
HTML;
}
}
?>