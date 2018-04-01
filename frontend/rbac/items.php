<?php
return [
    'Upload' => [
        'type' => 2,
        'description' => 'Upload Images',
        'ruleName' => 'Upload',
        'children' => [
            '/image/view',
            '/image/index',
            '/image/create',
        ],
    ],
    'Validate' => [
        'type' => 2,
        'description' => 'Validate image',
        'ruleName' => 'Validate',
        'children' => [
            'Upload',
            '/image/view',
            '/image/index',
            '/image/create',
            '/image/approve',
            '/image/reject',
            '/image/validate',
        ],
    ],
    'Validator' => [
        'type' => 1,
        'description' => 'Validate Images',
        'ruleName' => 'Validate',
        'children' => [
            'Uploader',
            'Upload',
            'Validate',
            '/image/view',
            '/image/index',
            '/image/create',
            '/image/approve',
            '/image/reject',
            '/image/validate',
        ],
    ],
    'Uploader' => [
        'type' => 1,
        'description' => 'Upload images',
        'ruleName' => 'Upload',
        'children' => [
            'Upload',
            '/image/view',
            '/image/index',
            '/image/create',
        ],
    ],
    '/image/view' => [
        'type' => 2,
    ],
    '/image/index' => [
        'type' => 2,
    ],
    '/image/create' => [
        'type' => 2,
    ],
    '/image/approve' => [
        'type' => 2,
    ],
    '/image/reject' => [
        'type' => 2,
    ],
    '/image/validate' => [
        'type' => 2,
    ],
];
