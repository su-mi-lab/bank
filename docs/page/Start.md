## Start using

Create a configuration bank.php file

```
<?php

return [
    'adapter' => [
        \Bank\Bank::ADAPTER_DEFAULT_NAMESPACE => [
            'dns' => 'mysql:host=localhost;dbname=bank;charset=utf8',
            'user' => 'root',
            'password' => '',
        ]
    ],
    'schema' => __DIR__ . '/../schema/' # When using data mapper
];
```

Register settings

```php
\Bank\Bank::setConfig(include 'bank.php');
```