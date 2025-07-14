<?php

function dbConnect()
{
    try {
        require "config.php";

        $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
    } catch (PDOException $err) {
        echo "Database connection error. <br>" . $err->getMessage();
        exit;
    }
    return $connection;
}