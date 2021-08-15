<?php

ob_start();

date_default_timezone_set("Europe/Istanbul");

require_once("includes/externalVariables.php");

define('DB_SERVER', $myServer);
define('DB_USERNAME', $myUsername);
define('DB_PASSWORD', $myPassword);
define('DB_NAME', $myDatabaseName);

try {
    $con = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con -> query("SET CHARACTER SET UTF8");
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e -> getMessage());
}

?>
