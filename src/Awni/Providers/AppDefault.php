<?php

namespace Awni\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Illuminate\Database\Capsule\Manager;
use DS\ViewManager;

class AppDefault implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        $manager = new ViewManager($container['settings']['view']);
        $manager->setAsGlobal();

        $container['theme'] = function (\Slim\Container $c) {

            $settings = require($c['settings']['theme']['file']);

            return \DS\View::make($settings['file'])
                ->with($settings);

        };

        $container['db'] = function (\Slim\Container $c) {

            $manager = new Manager();
            $manager->addConnection($c['settings']['db']);

            return $manager->getConnection();
        };

        /*
        $container['errorHandler'] = function (\Slim\Container $c) {
            return new CustomHandler();
        }; */

    }
}
