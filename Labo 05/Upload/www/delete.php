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

    $tpl = $twig->load('delete.twig');
    /**
     * Database Connection
     * ----------------------------------------------------------------
     */

    $db = getDatabase();


    /**
     * Initial Values
     * ----------------------------------------------------------------
     */
    $formErrors = array(); // The encountered form errors

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0; // The passed in id of the

    /**
     * Handle action 'edit' (user pressed edit button)
     * ----------------------------------------------------------------
     */

    if (isset($_POST['moduleAction']) && ($_POST['moduleAction'] == 'delete')) {

        // check if item exists (use the id from the $_POST array!)
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

        $stmt = $db->query('SELECT * FROM '. DB_NAME.' WHERE id = '. $id);
        $element = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($element) === 0) array_push($formErrors, 'Id not found?');


        else{
            $allOk = true;
            try {
                $stmt = $db->prepare('DELETE FROM '. DB_NAME . ' WHERE id = ?');
                $stmt->execute(array($id));
            } catch (PDOException $e) {
                array_push($formErrors, $e);
                $allOk = false;
            }
            if($allOk) header('location: browse.php');
        }
    }


    /**
     * No action to handle: show edit page
     * ----------------------------------------------------------------
     */

    $stmt = $db->query('SELECT * FROM '. DB_NAME.' WHERE '.DB_NAME.'.id = '.$id);
    $element = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($element) === 0) header('location: browse.php');

    echo $tpl->render(array(
        'title' => 'Todolist - Delete',
        'id' => $id,
        'formErrors' => $formErrors,
        'action' => $_SERVER['PHP_SELF']
    ));


?>