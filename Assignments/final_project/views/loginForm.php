<?php
require_once 'controllers/loginProc.php';


function init() {
    global $formConfig, $stickyForm, $acknowledgment;

    return <<<HTML
{$acknowledgment}
<div class="container mt-5">

    <h1>Login</h1>

    <form method="post" action="">
        <div class="row">

            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
            </div>
            <div class="row">
            <div class="col-md-6">
                {$stickyForm->renderPassword($formConfig['password'], 'mb-3')}
            </div>
</div>

        </div>

        <input type="submit" class="btn btn-primary" value="Login">
    </form>
</div>

HTML;
}
?>
