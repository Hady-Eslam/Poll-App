<?php

namespace Services;


require_once(_DIR_.'/Services/ConfigService.php');
require_once(_DIR_.'/Services/RoutesService.php');
require_once(_DIR_.'/Services/ViewsService.php');
require_once(_DIR_.'/Services/TemplateService.php');
require_once(_DIR_.'/Services/FormService.php');
require_once(_DIR_.'/Services/Model.php');





use Services\ConfigService;
use Services\RoutesService;
use Services\ViewsService;
use Services\TemplateService;




class App{

    function __construct(){
        $this->ConfigsService = ConfigService::getInstance();

        $this->RouteService = new RoutesService;


        $this->ViewService = new ViewsService;


        $this->TemplateService = new TemplateService;
    }


    function StartRouting(){
        $this->RouteService->Filter();
        $this->View = $this->RouteService->GetView();
    }


    function ProcessView(){
        
        $this->ViewService->ActivateView($this->View);
        $this->ViewService->CreateRequest();
        $this->ViewService->ProcessView();
    }


    function ProcessTemplate(){

        if ( $this->ViewService->Context instanceof \Services\JsonContext ){
            $this->ViewService->Context->render();
            return;
        }

        $this->TemplateService->ActivateTemplate($this->ViewService->Context);
        $this->TemplateService->ProcessTemplate();
        $this->TemplateService->echoTemplate();
    }


    function EndRequest(){
        exit();
    }
}

