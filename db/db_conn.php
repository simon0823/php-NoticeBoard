<?php

    static $host = '127.0.0.1';
    static $user = 'root';
    static $pw = '';
    static $dbName = 'php_noticeboard';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbName", $user, $pw);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Success!";

    }catch (PDOException $ex) {
        echo "ERROR : " . $ex->getMessage();
    }
?>
