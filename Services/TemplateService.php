<?php

namespace Services;

use Exception;
use Services\ConfigService;

class TemplateService{

    private $TemplatesDir = '';

    function __construct(){
        $this->TemplatesDir = ConfigService::getInstance()->Templates;
        $this->PublicDir = ConfigService::getInstance()->Public;
    }


    function ActivateTemplate($Context){
        $this->Context = $Context;
        
        $this->Context->Variables->Public = function($Path){
            return '/FeedbackSystem/Public/'. $Path;
        };

        $this->Context->Variables->Include = function($Path){
            $_ = $this->Context->Variables;
            $Public = $_->Public;
            $Include = $_->Include;
            $Session = $this->Context->Request->Session;

            assert(file_exists($this->TemplatesDir . $Path . '.php'), "Template { $Path } Not Found");
            include($this->TemplatesDir . $Path . '.php');
        };

        $this->Context->Variables->base_url = '/FeedbackSystem/';

        assert( file_exists($this->TemplatesDir . $this->Context->Templete . '.php'), 'Template Not Found' );
    }


    function ProcessTemplate(){
        $_ = $this->Context->Variables;
        $Public = $_->Public;
        $Include = $_->Include;
        $Session = $this->Context->Request->Session;

        ob_start();
        
        try{
            include_once($this->TemplatesDir . $this->Context->Templete . '.php');
        }
        catch(Exception $e){}
    }


    function echoTemplate(){
        ob_end_flush();
    }
}
