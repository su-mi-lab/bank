<?php

return [
    'adapter' => [
        \Bank\Bank::ADAPTER_DEFAULT_NAMESPACE => [
            'dns' => 'mysql:host=localhost;dbname=bank;charset=utf8',
            'user' => 'root',
            'password' => '',
        ]
    ],
    'schema' => __DIR__ . '/../schema/'
];