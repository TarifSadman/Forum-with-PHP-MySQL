<?php

define('BASE_URL', 'http://localhost/udemy/');

try {
    define("HOST", "localhost");

    define("USER", "root");

    define("PASS", "");

    define("DBNAME", "forum");

$conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME, USER, PASS);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected";

} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
}