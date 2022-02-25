<?php

use Services\BaseView;
use Services\Context;
use Services\JsonContext;
use Services\Form;
use Services\ConfigService;


class CreateFeedback extends BaseView{

    function get($Request){

        (!file_exists(_DIR_.'/InstallerFile')) ? $Request->Redirect('/Installer') : null;
        (!isset($Request->Session->User)) ? $Request->LoginRedirect('/Login') : null;

        return new Context($Request, 'CreateFeedback', new class{
            public $Title = 'Create Feedback';
        });
    }


    function post($Request){
        
        (!file_exists(_DIR_.'/InstallerFile')) ? $Request->Redirect('/Installer') : null;
        (!isset($Request->Session->User)) ? $Request->LoginRedirect('/Login') : null;


        $Form = new Form($Request->POST);
        $Form->Schema([
            'Question' => [
                'min' => 1,
                'max' => 100,
                'required' => true,
                'type' => 'string'
            ],
            'Answers' => [
                'min_array' => 1,
                'max_array' => 100,
                'min' => 1,
                'max' => 100,
                'required' => true,
                'type' => 'array'
            ],
            'expireDate' => [
                'type' => 'date',
                'required' => true
            ]
        ]);

        if ( !$Form->isValid() ){

            return new JsonContext($Request, new class($Form->Errors()){
                public $Result = 'Error';
                public $Errors = null;

                public function __construct($Errors){
                    $this->Errors = $Errors;
                }
            }, 400);
        }

        $DB = ConfigService::getInstance()->Database;

        $Feedback = new Feedback();
        $Feedback->Insert([
            'UserName' => $Request->Session->User['UserName'],
            'Question' => $Form->CleanedData['Question'],
            'Answers' => json_encode($Form->CleanedData['Answers']),
            'Expire_At' => $Form->CleanedData['expireDate']
        ]);


        return new JsonContext($Request, new class($Feedback->LastInsertedID()){
            public $ID = 0;

            function __construct($ID){
                $this->ID = $ID;
            }
        });
    }
}
