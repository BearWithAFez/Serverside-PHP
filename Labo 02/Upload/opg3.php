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

// Product Array
$products = array("4GB"=>45, "8GB"=>54, "16GB"=>109);

// POST all variables
$wanted = isset($_POST['wanted']) ?  (string) $_POST['wanted'] : '';
$moduleAction = isset($_POST['moduleAction']) ? (string) $_POST['moduleAction'] : '';
console_log($wanted);

$sucsesString = '';

// form is sent: perform formchecking!
if ($moduleAction == 'process') {
    $allOk = true;

    if(($wanted === '') && array_key_exists($wanted, $products)){
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk === true) {
        $sucsesString = 'De prijs is: ' . $products[$wanted] . ' Euro';
    }

}

?><!DOCTYPE html>
<html>
<head>
    <title>Opgave 3</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <fieldset>

        <h2>Opgave 3</h2>

        <dl class="clearfix">
            <dd>
                <?php foreach ($products as $key => $value):?>
                <label for="<?php echo htmlentities($key); ?>"><input type="radio" class="option" name="wanted" id="<?php echo htmlentities($key); ?>" value="<?php echo htmlentities($key); ?>"<?php if ($wanted == $key) { echo ' checked="checked"'; } ?> /><?php echo htmlentities($key) .' - '. htmlentities($value) .  '€'; ?></label>
                <?php endforeach; ?>
            </dd>

            <dt class="full clearfix" id="lastrow">
                <input type="hidden" name="moduleAction" value="process" />
                <span class="floatyLeft"><?php echo $sucsesString; ?></span>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Buy" />
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