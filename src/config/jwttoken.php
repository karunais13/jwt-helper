<?php
return [
    'claims' => [
        'iss' => env('APP_URL', null),
        'sub' => base64_encode(env('APP_KEY', '')),
        'exp' => '2'// minutes
    ],
    'default' => [
        'algorithm' => env('JWT_ALG', 'HS256'),
    ],
    'leeway' => env('JWT_LEEWAY', 60), // in seconds

    // Allowed algorithms
    'HS256' =>[
        'algorithm' => 'HS256',
        'public' => env('JWT_KEY_PUBLIC', 'HS256'),
    ],
    'HS384' =>[
        'algorithm' => 'HS384',
        'public' => env('JWT_KEY_PUBLIC', 'HS384'),
    ],
    'HS512' =>[
        'algorithm' => 'HS512',
        'public' => env('JWT_KEY_PUBLIC', 'HS512'),
    ],
    'RS256' =>[
        'algorithm' => 'RS256',
        'is_path' => env('JWT_KEY_BY_PATH'),
        'public' => env('JWT_KEY_PUBLIC', null),
        'private' => env('JWT_KEY_PRIVATE', null)
    ],
    'RS384' =>[
        'algorithm' => 'RS384',
        'is_path' => env('JWT_KEY_BY_PATH'),
        'public' => env('JWT_KEY_PUBLIC', null),
        'private' => env('JWT_KEY_PRIVATE', null)
    ],
    'RS512' =>[
        'algorithm' => 'RS512',
        'is_path' => env('JWT_KEY_BY_PATH'),
        'public' => env('JWT_KEY_PUBLIC', null),
        'private' => env('JWT_KEY_PRIVATE', null)
    ],
];