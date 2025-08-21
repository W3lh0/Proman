<?php

$router->get('/', 'UserController@showLogin');
$router->get('/login', 'UserController@showLogin');
$router->post('/login', 'UserController@login');