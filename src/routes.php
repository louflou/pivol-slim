<?php

use Awni\Controllers\Main;
use Awni\Middlewares\Middleware;

$app->get('/', Main::class . ':home');
$app->get('/home', Main::class . ':home');
$app->get('/search', Main::class . ':search');
$app->get('/about', Main::class . ':about');
$app->post('/', Main::class . ':searchProccess');
$app->post('/home', Main::class . ':searchProccess');
$app->get('/id/{id}', Main::class . ':home');
