<?php

use Services\Model;


class FeedbackAnswers extends Model{

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

    public $FeedBackID = [
        'type' => 'int',
        'null' => false
    ];

    public $Answer = [
        'min' => 1,
        'max' => 100,
        'type' => 'text',
        'default' => '\'\'',
        'null' => false,
    ];

    public $Created_At = [
        'type' => 'datetime',
        'null' => false,
        'default' => 'current_timestamp'
    ];
}
