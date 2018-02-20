<?php

	/**
	 * Includes
	 * ----------------------------------------------------------------
	 */


		// config & functions
		require_once 'includes/config.php';
		require_once 'includes/functions.php';


	/**
	 * Database Connection
	 * ----------------------------------------------------------------
	 */

		$db = getDatabase();


	/**
	 * Initial Values
	 * ----------------------------------------------------------------
	 */


		$priorities = array('low','normal','high'); // The possible priorities of a todo
		$formErrors = array(); // The encountered form errors

		$id = isset($_GET['id']) ? (int) $_GET['id'] : 0; // The passed in id of the todo

		$what = isset($_POST['what']) ? $_POST['what'] : ''; // The todo that was sent in via the form
		$priority = isset($_POST['priority']) ? $_POST['priority'] : 'low'; // The priority that was sent in via the form


	/**
	 * Handle action 'edit' (user pressed edit button)
	 * ----------------------------------------------------------------
	 */

		if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'edit')) {

			// check if item exists (use the id from the $_POST array!)
			$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
			$stmt = $db->query('SELECT * FROM '. DB_NAME.' WHERE '. DB_NAME.'.id = '. $id);
	        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(count($element) === 0) array_push($formErrors, 'Id not found?');
			else{
				// check parameters
				$allOk = true;
				if($what === '') {
					array_push($formErrors, 'No text given');
					$allOk = false;
				}
				switch ($priority) {
					case 'low':
					case 'normal':
					case 'high':
						break;				
					default:
						$allOk = false;
						array_push($formErrors,"Unknown priority set...");
						break;
				}
				if($allOk){
					try {
						$stmt = $db->prepare('UPDATE '. DB_NAME . ' SET what = ?, priority = ? WHERE id = ?');
						$stmt->execute(array($what, $priority, $id));
					} catch (PDOException $e) {
					    array_push($formErrors, $e);
					    $allOk = false;
					}
					if($allOk) header('location: browse.php');
				}			
			}
		}


	/**
	 * No action to handle: show edit page
	 * ----------------------------------------------------------------
	 */

        $stmt = $db->query('SELECT * FROM '. DB_NAME.' WHERE '.DB_NAME.'.id = '.$id);
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//if(count($element) === 0) header('location: browse.php');

		foreach($element as $e){
			$what = $e['what'];
			$priority =$e['priority'];
		}


?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="oldie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="oldie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="oldie ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

	<title>Todolist</title>

	<meta charset="UTF-8" />
	<meta name="viewport" content="width=520" />
	<meta http-equiv="cleartype" content="on" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<link rel="stylesheet" media="screen" href="css/reset.css" />
	<link rel="stylesheet" media="screen" href="css/screen.css" />

	<script src="js/edit.js"></script>

</head>
<body>

	<div id="siteWrapper">

		<!-- header -->
		<header>
			<h1><a href="index.php">Todolist</a></h1>
		</header>

		<!-- content -->
		<section>

			<div class="box" id="boxAddTodo">

				<h2>Edit existing todo</h2>
				<div class="boxInner">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<fieldset>
							<dl class="clearfix columns">
								<dd class="column column-46"><input type="text" name="what" id="what" value="<?php echo $what; ?>" /></dd>
								<dd class="column column-16" id="col-priority">
									<select name="priority" id="priority">
<?php
    foreach($priorities as $prio){
        echo '<option value"' . $prio .'" '. (($prio === $priority)? 'selected' : '') .'>' . $prio .'</option>';
    }
?>
									</select>
								</dd>
								<dd class="column column-16" id="col-submit">
									<label for="btnSubmit"><input type="submit" id="btnSubmit" name="btnSubmit" value="Edit" /></label>
									<input type="hidden" name="id" value="<?php echo $id; ?>" />
									<input type="hidden" name="moduleAction" id="moduleAction" value="edit" />
								</dd>
							</dl>
						</fieldset>
					</form>
					<p class="cancel">or <a href="index.php" title="Cancel and go back">Cancel and go back</a></p>
				</div>

			</div>

<?php
    if(count($formErrors) !== 0){
        echo '<div class="box" id="boxError"><ul class="errors">';
        for ($i = 0; $i < count($formErrors); $i++) {
            echo '<li>' . $formErrors[$i] .'</li>';
        }
        echo '</ul></div>';
    }
?>
		</section>

		<!-- footer -->
		<footer>
			<p>&copy; 2014, <a href="http://www.ikdoeict.be/" title="IkDoeICT.be">IkDoeICT.be</a></p>
		</footer>

	</div>

</body>
</html>