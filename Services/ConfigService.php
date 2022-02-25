<?php


namespace Services;

use Exception;

class ConfigService{

    private $Configs = [];

    private static $Self = null;

    
    function __construct(){
        $this->Configs = require_once(_DIR_.'/Config.php');
    }

    function __get($name){
        // assert here
        if ( isset($this->Configs[$name]) ){
            return $this->Configs[$name];
        }
        // raise exception
        throw new \Exception($name . ' Not Exists in Configurations');
    }


    static function getInstance(){
        if ( !is_null(ConfigService::$Self) ){
            return ConfigService::$Self;
        }

        ConfigService::$Self = new ConfigService();
        return ConfigService::$Self;
    }
}
