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

        $tpl = $twig->load('edit.twig');


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
		if(count($element) === 0) header('location: browse.php');

		foreach($element as $e){
			$what = $e['what'];
			$priority =$e['priority'];
		}

        echo $tpl->render(array(
            'title' => 'Todolist - Edit',
            'id' => $id,
            'formErrors' => $formErrors,
            'action' => $_SERVER['PHP_SELF'],
            'what' => $what,
            'priorities' => $priorities,
            'priority' => $priority
        ));

?>
