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

		$what = isset($_POST['what']) ? $_POST['what'] : ''; // The todo that was sent in via the form
		$priority = isset($_POST['priority']) ? $_POST['priority'] : 'low'; // The priority that was sent in via the form


	/**
	 * Handle action 'add' (user pressed add button)
	 * ----------------------------------------------------------------
	 */

		if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'add')) {

			// check parameters
			$allOk = ($what !== '');
			if(! $allOk) array_push($formErrors,"No text set...");
			
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

			// if no errors: insert values into database
			try {
				if($allOk){
					$date = date("Y-m-d H:i:s", time());
			        
			        $stmt = $db->prepare('INSERT INTO '. DB_NAME . ' (what, priority, added_on) VALUES (?, ?, ?)');
					$stmt->execute(array($what, $priority, $date));
				}
			} catch (PDOException $e) {
			    array_push($formErrors, $e);
			}
			// if query succeeded: redirect to this very same page

			header('location: browse.php');

		}


	/**
	 * No action to handle: show our page itself
	 * ----------------------------------------------------------------
	 */


		// Fetch needed data from DB
        $stmt = $db->query('SELECT * FROM ' . DB_NAME .' ORDER BY FIELD(priority, "high", "normal", "low"), added_on ASC');
        $todoItems = $stmt->fetchAll(PDO::FETCH_ASSOC);



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

	<script src="js/browse.js"></script>

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

				<h2>Add new todo</h2>

				<div class="boxInner">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<fieldset>
							<dl class="clearfix columns">
								<dd class="column column-46"><input type="text" name="what" id="what" value="" /></dd>
								<dd class="column column-16" id="col-priority">
									<select name="priority" id="priority">
<?php
    foreach($priorities as $prio){
        echo '<option value"' . $prio . '">' . $prio .'</option>';
    }
?>
									</select>
								</dd>
								<dd class="column column-16" id="col-submit">
									<label for="btnSubmit"><input type="submit" id="btnSubmit" name="btnSubmit" value="Add" /></label>
									<input type="hidden" name="moduleAction" id="moduleAction" value="add" />
								</dd>
							</dl>
						</fieldset>
					</form>
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

			<div class="box" id="boxYourTodos">

				<h2>Your todos</h2>

				<div class="boxInner">

<?php
if(count($todoItems) !== 0) {
    echo '<ul>';
    foreach($todoItems as $todo){
        echo '<li id="item-'. $todo['id'] .'" class="item '. $todo['priority'] .' clearfix">';
        echo '<a href="delete.php?id='. $todo['id'] .'" class="delete" title="Delete/Complete this item">delete/complete</a>';
        echo '<a href="edit.php?id='. $todo['id'] .'" class="edit" title="Edit this item">edit</a>';
        echo '<span>' . $todo['what'] . '</span>';
        echo '</li>';
    }
    echo '</ul>';
} else{
    echo '<p>No todos found</p>';
}
?>
				</div>

			</div>

		</section>

		<!-- footer -->
		<footer>
			<p>&copy; 2017, <a href="http://www.ikdoeict.be/" title="IkDoeICT.be">IkDoeICT.be</a></p>
		</footer>

	</div>

</body>
</html>