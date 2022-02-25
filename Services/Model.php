<?php


namespace Services;

use PDO;
use PDOException;
use Services\ConfigService;

class Model{

    private $Schema = [
        'type' => 'string',
        'min' => null,
        'max' => null,
        'null' => true,
        'primary' => false,
        'auto_increment' => false,
        'default' => null,
        'unique' => false
    ];


    function __construct(){
        $DB = ConfigService::getInstance()->Database;

        $this->host = $DB['host'];
        $this->User = $DB['User'];
        $this->Password = $DB['Password'];
        $this->Port = $DB['Port'];
        $this->Database = $DB['Database'];

        $this->Connect();
    }


    function CreateModel(){

        $Class_Name = get_class($this);
        $Vars = get_class_vars($Class_Name);
        $Model = "drop table if exists `$Class_Name`";
        
        $this->PDO->exec($Model);

        $Model = "create table `$Class_Name`(";

        assert( sizeof($Vars) > 0, 'Model Has No Column' );
        
        foreach($Vars as $Name => $Value){

            if ( $Name == 'Schema' ){
                continue;
            }

            $Value = array_merge($this->Schema, $Value);
            $Model .= "$Name ";
        
            if ($Value['type'] == 'int'){
                $Model .= 'int ';
            }
            else if ($Value['type'] == 'text'){
                $Model .= 'varchar ';
            }
            else if ($Value['type'] == 'datetime'){
                $Model .= 'datetime ';
            }

            if ( !is_null($Value['max']) ){
                $Model .= '('.$Value['max'].') ';
            }

            if ( !$Value['null'] ){
                $Model .= 'not null ';
            }

            if ( $Value['type'] == 'int' && $Value['auto_increment'] ){
                $Model .= 'auto_increment ';
            }

            if ( $Value['unique'] ){
                $Model .= 'unique ';
            }

            if ( $Value['primary'] ){
                $Model .= 'primary key ';
            }

            if ( !is_null($Value['default']) ){
                $Model .= 'default '.$Value['default'].' ';
            }

            $Model .= ', ';
        }

        $Model = str_split($Model, strlen($Model)-2 )[0];

        $Model .= ')ENGINE=InnoDB';
        
        $this->PDO->exec($Model);        
    }


    function Connect(){
        $this->PDO = new PDO(
            "mysql:host=$this->host;port=$this->Port;dbname=$this->Database;",
            $this->User,
            $this->Password
        );
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    function Insert($Array){
        $Insert = 'INSERT INTO `'.get_class($this).'`(';
        foreach($Array as $Item => $Value){
            $Insert .= $Item.', ';
        }
        $Insert = str_split($Insert, strlen($Insert)-2)[0] . ')';

        $Insert .= 'VALUES(';
        $Values = [];
        foreach($Array as $Item => $Value){
            $Insert .= '?, ';
            array_push($Values, $Value);
        }
        $Insert = str_split($Insert, strlen($Insert)-2)[0] . ')';

        $Statement = $this->PDO->prepare($Insert);
        $Statement->execute($Values);
    }


    function Select($Array, $Limit = -1){
        $Select = 'SELECT * FROM `'.get_class($this).'` WHERE ';
        $Values = [];
        foreach($Array as $Item => $Value){
            $Select .= $Item.' = ? AND ';
            array_push($Values, $Value);
        }
        $Select = str_split($Select, strlen($Select)-4)[0];

        if ( $Limit != -1 ){
            $Select .= ' LIMIT '.$Limit;
        }

        $Statement = $this->PDO->prepare($Select);
        $Statement->execute($Values);

        return $Statement->fetchAll();
    }

    function SelectAll(){
        $Statement = $this->PDO->prepare('SELECT * FROM `'.get_class($this).'`');
        $Statement->execute([]);

        return $Statement->fetchAll();
    }


    function Delete($Array, $Limit = 1){
        $Delete = 'DELETE FROM `'.get_class($this).'` WHERE ';
        $Values = [];
        foreach($Array as $Item => $Value){
            $Delete .= $Item.' = ? AND ';
            array_push($Values, $Value);
        }
        $Delete = str_split($Delete, strlen($Delete)-4)[0];

        $Delete .= ' LIMIT '.$Limit;

        $Statement = $this->PDO->prepare($Delete);
        $Statement->execute($Values);
    }


    function LastInsertedID(){
        return $this->PDO->lastInsertId();
    }
}
