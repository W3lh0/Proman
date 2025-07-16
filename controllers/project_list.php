<?php

require_once "../model/model.php";

$projects = getAllProjects();
$projectCount = getAllProjectCount();

include "../views/projectList";