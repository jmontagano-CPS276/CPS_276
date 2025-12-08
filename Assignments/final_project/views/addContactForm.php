<?php
require_once 'controllers/addContactProc.php';
function init()
{
    global $formConfig, $stickyForm, $acknowledgment;


    return <<<HTML
<h1>Add Contact</h1>
{$acknowledgment}
<div class="container mt-5">

    <form method="post" action="index.php?page=addContact">
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
             <div class="col-md-4">
                {$stickyForm->renderInput($formConfig['city'], 'mb-3')}
            </div>
            <div class="col-md-4">
                {$stickyForm->renderSelect($formConfig['state'], 'mb-3')}
            </div>
            <div class="row">
            <div class="col-md-4">
                {$stickyForm->renderInput($formConfig['phone'], 'mb-3')}
            </div>
            <div class="col-md-4">
                {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
            </div>
            <div class="col-md-4">
                {$stickyForm->renderInput($formConfig['dob'], 'mb-3')}
            </div>
        </div>
        <div class="row">
            <div>
                {$stickyForm->renderRadio($formConfig['age'], 'mb-3', 'horizontal')}
            </div>
</div>
        <div class="row">
                {$stickyForm->renderCheckboxGroup($formConfig['contact'], 'mb-3', 'horizontal')}
            </div>

        <div class ='col-md-3'>
        <input type="submit" class="btn btn-primary" value="Add Contact">
</div>
    </form>
</div>

HTML;

}

?>