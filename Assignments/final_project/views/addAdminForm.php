<?php
require_once 'controllers/addAdminProc.php';
require_once 'includes/navigation.php';
function init()
{
    global $formConfig, $stickyForm, $acknowledgment;


    return <<<HTML
{$acknowledgment}
<div class="container mt-5">

<p>Fields with * are required</p>
    <form method="post" action="">
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

        <input type="submit" class="btn btn-primary" value="Add Contact">
    </form>
</div>

HTML;

}

?>