<?php
require_once 'controllers/addContactProc.php';
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

        <!-- Render address field -->
        <div class="row">
            <div class="col-md-12">
                {$stickyForm->renderInput($formConfig['address'], 'mb-3')}
            </div>
        </div>

        <!-- Render zip code, phone, and email fields -->
        <div class="row">
            <!-- Render state select box -->
             <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['city'], 'mb-3')}
            </div>
            <div class="col-md-3">
                {$stickyForm->renderSelect($formConfig['state'], 'mb-3')}
            </div>
            <div class="row">
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['phone'], 'mb-3')}
            </div>
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
            </div>
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['dob'], 'mb-3')}
            </div>
        </div>
        <div class="row">
            <div>
                {$stickyForm->renderRadio($formConfig['age'], 'mb-3')}
            </div>
</div>
        <div class="row">
                {$stickyForm->renderCheckboxGroup($formConfig['contact'], 'mb-3')}
            </div>


        <input type="submit" class="btn btn-primary" value="Add Contact">
    </form>
</div>

HTML;

}

?>