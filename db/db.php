<?
    if (!defined('ENGINE')) {
        die("Hack no attempt!");
    }
    $dbConfig = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'dbName' => 'diplom'
    ];

    $db = mysqli_connect($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['dbName']);
    // echo true
?>