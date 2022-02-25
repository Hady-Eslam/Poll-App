<?php

namespace Services;


class Request{

    public $Method = '';
    public $Session = null;
    public $POST = [];
    public $Param = [];


    function __construct(){
        $this->Method = $_SERVER['REQUEST_METHOD'];
        $this->Session = new class{
            
            function __construct(){
                session_start();
            }

            function __isset($name){
                return isset($_SESSION[$name]) ? true : false;
            }

            function __set($name, $value){
                $_SESSION[$name] = $value;
            }

            function __get($name){
                return $_SESSION[$name];
            }


            function Reset(){
                session_unset();
                session_destroy();
            }
        };
        $this->POST = $_POST;
        $Components = parse_url($_SERVER['REQUEST_URI']);
        parse_str(isset($Components['query']) ? $Components['query'] : '', $this->Param);
    }


    function Redirect($URL = '/'){
        header('Location: ' . '/FeedbackSystem' . $URL);
        exit();
    }


    function LoginRedirect($URL = '/'){
        header('Location: ' . '/FeedbackSystem' . $URL . '?ReturnUrl=' . explode('FeedbackSystem', $_SERVER['REQUEST_URI'])[1]);
        exit();
    }
}
