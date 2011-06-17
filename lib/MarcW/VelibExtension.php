<?php

namespace MarcW;

use Silex\Application;
use Silex\ExtensionInterface;

use Velib\Velib;

/**
 * VelibExtension
 *
 * @author Marc Weistroff <marc.weistroff@gmail.com>
 */
class VelibExtension implements ExtensionInterface
{
    public function register(Application $app)
    {
        if (!isset($app['buzz'])) {
            throw new \BadMethodCallException('Please register BuzzExtension first.');
        }

        $app['velib'] = $app->share(function() use ($app) {
            return new Velib($app['buzz']);
        });

        if (isset($app['velib.class_path'])) {
            $app['autoloader']->registerNamespace('Velib', $app['velib.class_path']);
        }
    }
}

