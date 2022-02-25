<?php


namespace Services;

use Exception;
use Services\ConfigService;



class RoutesService{

    private $Routes = [];
    private $URL = '';

    function __construct(){
        $Routes = ConfigService::getInstance()->Routes;

        assert( file_exists($Routes), 'Routes Not Found in this Path { '.$Routes.' }');
        $this->Routes = require_once( $Routes );
    }

    function Filter(){
        try{
            $this->URL = explode('?', $_SERVER['REQUEST_URI'])[0];      // Remove   ?
            $this->URL = explode('/', $this->URL, 2)[1];                // Remove   /
            $this->URL = explode('FeedbackSystem', $this->URL, 2)[1];   // Remove   FeedbackSystem/
        }
        catch(Exception $e){}
    }


    function GetView(){
        return ( isset($this->Routes[$this->URL]) ) ? $this->Routes[$this->URL] : '404';
    }
}
