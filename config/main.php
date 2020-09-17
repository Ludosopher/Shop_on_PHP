<?php
return [
    'title' => 'Мой магазин',
    'defaultControllerName' => 'good',

    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'dbname' => 'shop',
                'charset' => 'UTF8',
                'username' => 'root',
                'password' => 'root',
            ]
        ],
        'feedback' => [
            'class' => \App\entities\Feedback::class
        ],
        'good' => [
            'class' => \App\entities\Good::class
        ],
        'order' => [
            'class' => \App\entities\Order::class
        ],
        'order_items' => [
            'class' => \App\entities\OrderItems::class
        ],
        'user' => [
            'class' => \App\entities\User::class
        ],
        'twigRenderer' => [
            'class' => \App\services\renderers\TwigRenderer::class
        ],
        'request' => [
            'class' => \App\services\Request::class
        ],
        'GoodRepository' => [
            'class' => \App\repositories\GoodRepository::class
        ],
        'UserRepository' => [
            'class' => \App\repositories\UserRepository::class
        ],
        'OrderRepository' => [
            'class' => \App\repositories\OrderRepository::class
        ],
        'OrderItemsRepository' => [
            'class' => \App\repositories\OrderItemsRepository::class
        ],
        'OrderListRepository' => [
            'class' => \App\repositories\OrderListRepository::class
        ],
        'FeedbackRepository' => [
            'class' => \App\repositories\FeedbackRepository::class
        ],
        'basketServices' => [
            'class' => \App\services\BasketServices::class
        ],
        'goodServices' => [
            'class' => \App\services\GoodServices::class
        ],
        
    ]
];
