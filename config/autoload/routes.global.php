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
        [
            'name' => 'post_user',
            'path' => '/users',
            'middleware' => 'post.user.action',
            'allowed_methods' => ['POST'],
        ],
        [
            'name' => 'get_user',
            'path' => '/users',
            'middleware' => 'get.user.action',
            'allowed_methods' => ['GET'],
        ],
    ],
];
