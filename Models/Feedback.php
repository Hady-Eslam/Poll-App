<?php

use Services\Model;


class Feedback extends Model{

    public $ID = [
        'type' => 'int',
        'primary' => true,
        'auto_increment' => true,
        'null' => false
    ];

    public $UserName = [
        'min' => 1,
        'max' => 100,
        'type' => 'text',
        'default' => '\'\'',
        'null' => false,
        'primary' => false
    ];

    public $Question = [
        'min' => 1,
        'max' => 100,
        'type' => 'text',
        'default' => '\'\'',
        'null' => false,
    ];

    public $Answers = [
        'min' => 1,
        'max' => 1000,
        'type' => 'text',
        'default' => '\'\'',
        'null' => false,
    ];

    public $Created_At = [
        'type' => 'datetime',
        'null' => false,
        'default' => 'current_timestamp'
    ];

    public $Expire_At = [
        'type' => 'datetime',
        'null' => false,
    ];
}
