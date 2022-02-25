<?php


namespace Services;

class Context{

    public $Request = null;
    public $Templete = '';
    public $Variables = [];
    public $Response = 200;
    public $Headers = [];


    function __construct($Request, $Templete, $Variables = [], $Response = 200, $Headers = []){
        $this->Request = $Request;
        $this->Templete = $Templete;
        $this->Variables = $Variables;
        $this->Response = $Response;
        $this->Headers = $Headers;

        http_response_code($this->Response);
    }


    function render(){

    }
}



class JsonContext extends Context{

    function __construct($Request, $Variables = [], $Response = 200, $Headers = []){
        parent::__construct($Request, '', $Variables, $Response, $Headers);
    }


    function render(){
        echo json_encode($this->Variables);
    }
}
