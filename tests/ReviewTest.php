<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=growler';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


?>
