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

// Get all variables
$nr1 = isset($_GET['nr1']) ? (string) $_GET['nr1'] : '';
$nr2 = isset($_GET['nr2']) ? (string) $_GET['nr2'] : '';
$moduleAction = isset($_GET['moduleAction']) ? (string) $_GET['moduleAction'] : '';
$msgNr1 = '*';
$msgNr2 = '*';
$sum = '';

// form is sent: perform formchecking!
if ($moduleAction == 'process') {

    $allOk = true;

    if(filter_var($nr1,FILTER_VALIDATE_INT) !== false){
        $nr1 = filter_var($nr1,FILTER_VALIDATE_INT);
    }
    else{
        $allOk = false;
        $msgNr1 = 'Please input a VALID nr...';
    }
    console_log($nr1);

    if(filter_var($nr2,FILTER_VALIDATE_INT) !== false){
        $nr2 = filter_var($nr2,FILTER_VALIDATE_INT);
    }
    else{
        $allOk = false;
        $msgNr2 = 'Please input a VALID nr...';
    }

    console_log($nr2);
    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk === true) {
        $sum = $nr1 + $nr2;
    }

    console_log($sum);

} else{
    $nr1 = rand();
    $nr2 = rand();
}


?><!DOCTYPE html>
<html>
<head>
    <title>Opgave 2</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">

    <fieldset>

        <h2>Opgave 2</h2>

        <dl class="clearfix">

            <dt><label for="nr1">Nr1</label></dt>
            <dd class="text">
                <input type="number" id="nr1" name="nr1" value="<?php echo htmlentities($nr1); ?>" class="input-text" />
                <span class="message error"><?php echo $msgNr1; ?></span>
            </dd>
            <dt><label for="nr2">Nr2</label></dt>
            <dd class="text">
                <input type="number" id="nr2" name="nr2" value="<?php echo htmlentities($nr2); ?>" class="input-text" />
                <span class="message error"><?php echo $msgNr2; ?></span>
            </dd>
            <dt class="full clearfix" id="lastrow">
                <input type="hidden" name="moduleAction" value="process" />
                <span class="floatyLeft"><?php echo $sum; ?></span>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Som" />
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
    // dump $_GET
    dump($_GET);
    ?>

</div>

</body>
</html>