<?php


use Services\BaseView;
use Services\Context;


class Home extends BaseView{

    function get($Request){

        (!file_exists(_DIR_.'/InstallerFile')) ? $Request->Redirect('/Installer') : null;
        (!isset($Request->Session->User)) ? $Request->LoginRedirect('/Login') : null;


        $Records = (new Feedback())->SelectAll();

        return new Context($Request, 'Home', new class($Records){
            public $Title = 'Home';
            public $Feedbacks = [];

            function __construct($Records){
                $this->Feedbacks = $Records;
            }
        });
    }
}
