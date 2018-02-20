<?php

function showDbError($type, $msg) {
    if(DEBUG === true){
        echo $msg;
        exit;
    }else{
        file_put_contents(
            __DIR__ . '/error_log_mysql',
            PHP_EOL . (new DateTime())->format('Y-m-d H:i:s') . ' : ' . $msg,
            FILE_APPEND
        );
        header('location: error.php?type=db&detail=' . $type);
        exit();
    }
}

function getDatabase(){
    try{
        $db = new PDO('mysql:host=' . DB_HOST .';dbname=' .  DB_NAME. ';charset=utf8mb4', DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        showDbError('connect',$e->getMessage());
    }
    return $db;
}

// EOF