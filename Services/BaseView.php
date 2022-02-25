<?php

namespace Services;


class BaseView{

    function __construct(){
            
    }

    
    function get($Request){
        throw new \Exception('Method Not Implemented');
    }


    function post($Request){
        throw new \Exception('Method Not Implemented');
    }


    function delete($Request){
        throw new \Exception('Method Not Implemented');
    }


    function update($Request){
        throw new \Exception('Method Not Implemented');
    }


    function patch($Request){
        throw new \Exception('Method Not Implemented');
    }


    function unknown($Request){
        throw new \Exception('UnKnown Method { '. $Request->Method . ' }');
    }
}
