<?php

use Awni\Controllers\Main;
use Awni\Middlewares\Middleware;

$app->get('/', Main::class . ':home');
$app->get('/home', Main::class . ':home');
$app->get('/home/id/{id}', Main::class . ':item');
$app->get('/search', Main::class . ':search');
$app->get('/about', Main::class . ':about');
$app->post('/', Main::class . ':searchProccess');
$app->post('/home', Main::class . ':searchProccess');
