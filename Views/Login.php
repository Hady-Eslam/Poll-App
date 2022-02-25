<?php

use Services\BaseView;
use Services\Context;
use Services\Form;


class Login extends BaseView{

    function get($Request){

        (!file_exists(_DIR_.'/InstallerFile')) ? $Request->Redirect('/Installer') : null;
        (isset($Request->Session->User)) ? $Request->Redirect('/') : null;

        return new Context($Request, 'Login', new class{
            public $Title = 'Login';
        });
    }


    function post($Request){

        (!file_exists(_DIR_.'/InstallerFile')) ? $Request->Redirect('/Installer') : null;
        (isset($Request->Session->User)) ? $Request->Redirect('/') : null;

        
        $Form = new Form($Request->POST);
        $Form->Schema([
            'UserName' => [
                'min' => 1,
                'max' => 100,
                'required' => true,
                'type' => 'string'
            ],
            'Password' => [
                'min' => 1,
                'max' => 100,
                'required' => true,
                'type' => 'string'
            ]
        ]);

        if ( !$Form->isValid() ){

            return new Context($Request, 'Login', new class($Form->Errors()){
                public $Title = 'Login';
                public $Errors = null;

                public function __construct($Errors){
                    $this->Errors = $Errors;
                }
            }, 400);
        }

        $User = (new User())->Select([
            'UserName' => $Form->CleanedData['UserName'],
            'Password' => $Form->CleanedData['Password'],
        ], 1);

        if ( sizeof($User) == 0 ){
            return new Context($Request, 'Login', new class{
                public $Title = 'Login';
                public $Errors = 'UserName Or Password Is Wrong';
            });
        }

        $Request->Session->User = [
            'UserName' => $Form->CleanedData['UserName'],
            'Password' => $Form->CleanedData['Password']
        ];

        $Request->Redirect(isset($Request->Param['ReturnUrl']) ? $Request->Param['ReturnUrl'] : '/');
    }
}
