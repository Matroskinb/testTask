<?php

return [
    'site_name' => 'My site',
    'site_url' => 'https://mysite.ru',
    'assets' => [
        'version' => 2,
        'minify' => true,
    ],
    'db' => [
        'user' => 'admin',
        'password' => 'ifghigh8y8rt347ghi',
        'name' => 'my_database',
    ],
    'app' => [
        'services' => [
            'resizer' => [
                'prefer_format' => 'webp',
                'fallback_format' => 'jpeg',
            ],
        ],
    ],
];