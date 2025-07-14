<?php
require "connection.php";

$connection = dbConnect();

function getAllProjects()
{
    try {
        global $connection;

        $sql = 'SELECT * FROM project ORDER BY title';
        $projects = $connection->query($sql);

        return $projects;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err-getMessage();
        exit;
    }
}

function getAllProjectCount()
{
    try {
        global $connection;

        $sql = 'SELECT COUNT(id) AS nb FROM project';
        $statement = $connection->query($sql)->fetch();
        $projectCount = $statement['nb'];

        return $projectCount;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}