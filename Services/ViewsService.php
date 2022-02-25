<?php

namespace Services;

use Exception;
use Services\Request;
use Services\ConfigService;


class ViewsService{

    private $ViewsDir = '';
    public $Context = null;


    function __construct(){
        $this->ViewsDir = ConfigService::getInstance()->Views;
        include_once(_DIR_.'/Services/BaseView.php');
    }


    function ActivateView($ViewName){
        
        assert( file_exists($this->ViewsDir . $ViewName . '.php'), 'View { '.$ViewName.' } Not Exists');

        include_once($this->ViewsDir . $ViewName . '.php');

        assert( class_exists($ViewName, false), 'View Class Not Exists');

        include_once(_DIR_.'/Services/Context.php');

        $this->Activated_View = new $ViewName();
    }

    
    function CreateRequest(){
        include_once(_DIR_.'/Services/Request.php');
        $this->Request = new Request();
    }


    function ProcessView(){
        if ( $this->Request->Method == 'GET' ){
            $this->Context = $this->Activated_View->get($this->Request);
        }

        else if ( $this->Request->Method == 'POST' ){
            $this->Context = $this->Activated_View->post($this->Request);
        }

        else if ( $this->Request->Method == 'DELETE' ){
            $this->Context = $this->Activated_View->delete($this->Request);
        }

        else if ( $this->Request->Method == 'UPDATE' ){
            $this->Context = $this->Activated_View->update($this->Request);
        }

        else if ( $this->Request->Method == 'PATCH' ){
            $this->Context = $this->Activated_View->patch($this->Request);
        }

        else{
            $this->Context = $this->Activated_View->unknown($this->Request);
        }
    }
}
