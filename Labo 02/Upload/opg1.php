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
$name = isset($_GET['name']) ? (string) $_GET['name'] : '';
$moduleAction = isset($_GET['moduleAction']) ? (string) $_GET['moduleAction'] : '';
$msgName = '*';
$msgAge = '*';

// form is sent: perform formchecking!
if ($moduleAction == 'processName') {

    $allOk = true;

    // name not empty
    if (trim($name) === '') {
        $msgName = 'Gelieve jouw naam in te vullen';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk === true) {
        // Succses
    }

} else{

}
?><!DOCTYPE html>
<html>
<head>
	<title>Opgave 1</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">

		<fieldset>

			<h2>Opgave 1</h2>

			<dl class="clearfix">

				<dt><label for="name">Name</label></dt>
				<dd class="text">
                    <input type="text" id="name" name="name" value="<?php echo htmlentities($name); ?>" class="input-text" />
                    <span class="message error"><?php echo $msgName; ?></span>
                </dd>
				<dt class="full clearfix" id="lastrow">
                    <input type="hidden" name="moduleAction" value="processName" />
					<input type="submit" id="btnSubmit" name="btnSubmit" value="Send" />
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