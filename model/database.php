<?php
    $dsn = 'mysql:host=localhost;dbname=company';
    $username = 'root';
    $password = '321654987';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
    
    $db->exec("set names utf8");
    
?>