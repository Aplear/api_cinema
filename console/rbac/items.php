<?php
return [
    'film' => [
        'type' => 2,
    ],
    'booking' => [
        'type' => 2,
    ],
    'cinema-hall' => [
        'type' => 2,
    ],
    'cinema-hall-rows' => [
        'type' => 2,
    ],
    'cinema-hall-seats' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'user',
        'children' => [
            'film',
            'booking',
            'cinema-hall',
            'cinema-hall-rows',
            'cinema-hall-seats',
            'logout',
        ],
    ],
];
