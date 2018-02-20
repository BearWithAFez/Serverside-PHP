<?php
/**
 * Created by PhpStorm.
 * User: dwight.vandervelpen
 * Date: 20/11/2017
 * Time: 15:25
 */

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

// POST all variables
$name = isset($_POST['name']) ? (string) $_POST['name'] : '';
$mail = isset($_POST['mail']) ? (string) $_POST['mail'] : '';
$type = isset($_POST['type']) ? (string) $_POST['type'] : '';
$lokaal = isset($_POST['lokaal']) ? (int) $_POST['lokaal'] : 0;
$omschrijving = isset($_POST['omschrijving']) ? (string) $_POST['omschrijving'] : '';
$titel = isset($_POST['titel']) ? (string) $_POST['titel'] : '';
$moduleAction = isset($_POST['moduleAction']) ? (string) $_POST['moduleAction'] : '';

// form is sent: perform formchecking!
if ($moduleAction == 'process') {
    //Click
}

?><!DOCTYPE html>
<html>
<head>
    <title>Opgave 4</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <fieldset>

        <h2>Computer probleem melden: (opg4)</h2>
        <dl class="clearfix">

            <dt><label for="name">Name</label></dt>
            <dd class="text"><input type="text" id="name" name="name" value="<?php echo htmlentities($name); ?>" class="input-text" /></dd>

            <dt><label for="mail">E-mailadres</label></dt>
            <dd class="text"><input type="text" id="mail" name="mail" value="<?php echo htmlentities($mail); ?>" class="input-text" /></dd>

            <dt><label for="lokaal">Lokaal</label></dt>
            <dd>
                <select name="lokaal" id="lokaal">
                    <option value="0"<?php if ($lokaal == 0) { echo ' selected="selected"'; } ?>>LInfo0</option>
                    <option value="1"<?php if ($lokaal == 1) { echo ' selected="selected"'; } ?>>LInfo1</option>
                    <option value="2"<?php if ($lokaal == 2) { echo ' selected="selected"'; } ?>>LInfo2</option>
                    <option value="3"<?php if ($lokaal == 3) { echo ' selected="selected"'; } ?>>LInfo3</option>
                    <option value="4"<?php if ($lokaal == 4) { echo ' selected="selected"'; } ?>>LInfo4</option>
                    <option value="5"<?php if ($lokaal == 5) { echo ' selected="selected"'; } ?>>LInfo5</option>
                    <option value="6"<?php if ($lokaal == 6) { echo ' selected="selected"'; } ?>>LInfo6</option>
                </select>
            </dd>

            <dt><label>Type</label></dt>
            <dd>
                <label for="type_soft"><input type="radio" class="option" name="type" id="type_soft" value="software"<?php if ($type == 'software') { echo ' checked="checked"'; } ?> />Software</label>
                <label for="type_hard"><input type="radio" class="option" name="type" id="type_hard" value="hardware"<?php if ($type == 'hardware') { echo ' checked="checked"'; } ?> />Hardware</label>
            </dd>

            <dt><label for="titel">Titel</label></dt>
            <dd class="text"><input type="text" id="titel" name="titel" value="<?php echo htmlentities($titel); ?>" class="input-text" /></dd>

            <dt><label for="omschrijving">Remark</label></dt>
            <dd class="text"><textarea name="omschrijving" id="omschrijving" rows="5" cols="40"><?php echo htmlentities($omschrijving); ?></textarea></dd>

            <dt class="full clearfix" id="lastrow">
                <input type="hidden" name="moduleAction" value="process" />
                <span class="floatyLeft"><?php echo ''; ?></span>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" />
            </dt>

        </dl>

    </fieldset>

</form>

<div id="debug">

    <?php
    /**
     * Helper Functions
     * ========================
     */
    /**
     * Dumps a variable
     * @param mixed $var
     * @return void
     */
    function dump($var) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
    /**
     * Main Program Code
     * ========================
     */
    // dump $_POST
    dump($_POST);
    ?>

</div>

</body>
</html>