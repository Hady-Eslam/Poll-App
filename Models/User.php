<?php


use Services\Model;


class User extends Model{

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

    public $Password = [
        'min' => 1,
        'max' => 100,
        'type' => 'text',
        'default' => '\'\'',
        'null' => false,
        'primary' => false
    ];
}
