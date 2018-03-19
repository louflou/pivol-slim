<?php

use Awni\Providers\AppDefault;

require dirname(__DIR__) . '/src/bootstrap.php';

$container = new \Slim\Container(['settings' => $config]);
$container->register(new AppDefault());

$app = new \Slim\App($container);

require INSTALL_PATH . '/src/routes.php';

$app->run();
