<?php

use Xtreamwayz\Pimple\Container;

// Load configuration
$config = require __DIR__ . '/config.php';

// Build container
$container = new Container();

// Inject config
$container['config'] = $config;

// Inject factories
foreach ($config['dependencies']['factories'] as $name => $object) {
    $container[$name] = function ($c) use ($object, $name) {
        if ($c->has($object)) {
            $factory = $c->get($object);
        } else {
            $factory = new $object();
            $c[$object] = $factory;
        }

        return $factory($c, $name);
    };
}
// Inject invokables
foreach ($config['dependencies']['invokables'] as $name => $object) {
    $container[$name] = function ($c) use ($object) {
        return new $object();
    };
}

// Inject Invokable with dependencies, easy way.
$container['post.user.action'] = function ($c) use ($container) {
    return new \App\Action\PostUserAction(
        $container->get('doctrine.entity_manager.orm_default')
    );
};

$container['get.user.action'] = function ($c) use ($container) {
    return new \App\Action\GetUserAction(
        $container->get('doctrine.entity_manager.orm_default')
    );
};

return $container;
