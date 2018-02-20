<?php

	/**
	 * Includes
	 * ----------------------------------------------------------------
	 */


		// config & functions
		require_once 'includes/config.php';
		require_once 'includes/functions.php';
        require_once __DIR__ . '/includes/Twig/Autoloader.php';
        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
        $twig = new Twig_Environment($loader);

        $tpl = $twig->load('browse.twig');


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


        echo $tpl->render(array(
            'title' => 'Todolist - Browse',
            'formErrors' => $formErrors,
            'action' => $_SERVER['PHP_SELF'],
            'what' => $what,
            'priorities' => $priorities,
            'priority' => $priority,
            'todoItems' => $todoItems
        ));
?>