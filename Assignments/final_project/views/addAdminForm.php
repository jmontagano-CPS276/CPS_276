<?php
require_once 'controllers/addAdminProc.php';
function init()
{
    global $formConfig, $stickyForm, $acknowledgment;


    return <<<HTML
<h1>Add Admin</h1>
{$acknowledgment}
<div class="container mt-5">

    <form method="post" action="index.php?page=addAdmin">
        <div class="row">
            <!-- Render first name field -->
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['first_name'], 'mb-3')}
            </div>

            <!-- Render last name field -->
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['last_name'], 'mb-3')}
            </div>
        </div>
        <div class="row">
            <!-- Render state select box -->
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
            </div>
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['password'], 'mb-3')}
            </div>
            <div class="col-md-3">
                {$stickyForm->renderSelect($formConfig['status'], 'mb-3')}
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Add Admin">
    </form>
</div>

HTML;

}

?>