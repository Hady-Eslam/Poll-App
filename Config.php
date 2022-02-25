<?php

return [

    'Debug' => true,

    'Routes' => _DIR_ . '/Routes.php',

    'Views' => _DIR_ . '/Views/',

    'Templates' => _DIR_ . '/Templates/',

    'Public' => _DIR_ . '/Public/',

    'Models' => [
        include_once(_DIR_.'/Models/User.php'),
        include_once(_DIR_.'/Models/Feedback.php'),
        include_once(_DIR_.'/Models/FeedbackAnswers.php'),
    ],

    'Database' => [
        'host' => '127.0.0.1',
        'User' => 'root',
        'Password' => '',
        'Port' => '3306',
        'Database' => 'FeedbackSystem'
    ]
];
