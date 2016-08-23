<?php

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\ZendRouter::class,
        ],
        // Map middleware -> factories here
        'factories' => [
        ],
    ],

    'routes' => [
        // Example:
         [
             'name' => 'Hello',
             'path' => '/hello',
             'middleware' => App\Action\HelloAction::class,
             'allowed_methods' => ['GET'],
         ],
    ],
];
