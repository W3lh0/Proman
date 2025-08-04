<?php

class ProjectModel
{
    private PDO $dbconnection;

    public function __constructor(PDO $dbConnectionParameter)
    {
        $this->dbconnection = $dbConnectionParameter;
    }
}