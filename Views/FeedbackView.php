<?php


use Services\BaseView;
use Services\Context;
use Services\Form;
use Services\JsonContext;

class FeedbackView extends BaseView{

    function get($Request){

        (!file_exists(_DIR_.'/InstallerFile')) ? $Request->Redirect('/Installer') : null;
        (!isset($Request->Session->User)) ? $Request->LoginRedirect('/Login') : null;

        (!isset($Request->Param['id'])) ? $Request->Redirect('/') : null;


        $Feedback = (new Feedback())->Select([
            'ID' => $Request->Param['id']
        ], 1);

        (sizeof($Feedback) < 1) ? $Request->Redirect('/') : null;

        $Feedback = $Feedback[0];

        return new Context($Request, 'Feedback', new class($Feedback, $Request){
            public $Title = 'Feedback';
            public $ID = 0;
            public $UserName = '';
            public $Question = '';
            public $isAuthor = false;
            public $Answers = [];

            public function __construct($Record, $Request){
                $this->ID = $Record['ID'];
                $this->UserName = $Record['UserName'];
                $this->Question = $Record['Question'];
                $this->Answers = json_decode($Record['Answers'], true);
                $this->isAuthor = ($Request->Session->User['UserName'] == $Record['UserName']);

                $this->Expired = ( new DateTime($Record['Expire_At']) > new DateTime() ) ? false : true;
            }
        });
    }


    function post($Request){
        
        (!file_exists(_DIR_.'/InstallerFile')) ? $Request->Redirect('/Installer') : null;
        (!isset($Request->Session->User)) ? $Request->LoginRedirect('/Login') : null;

        (!isset($Request->Param['id'])) ? $Request->Redirect('/') : null;

        $Feedback = (new Feedback())->Select([
            'ID' => $Request->Param['id']
        ], 1);

        (sizeof($Feedback) < 1) ? $Request->Redirect('/') : null;

        $Feedback = $Feedback[0];

        $Form = new Form($Request->POST);
        $Form->Schema([
            'QuestionAnswers' => [
                'min' => 1,
                'max' => 100,
                'required' => true,
                'type' => 'string'
            ]
        ]);

        if ( !$Form->isValid() ){

            return new Context($Request, 'Feedback', new class($Feedback, $Request, $Form->Errors()){
                public $Title = 'Feedback';
                public $ID = 0;
                public $UserName = '';
                public $Question = '';
                public $isAuthor = false;
                public $Answers = [];
                public $Errors = [];
    
                public function __construct($Record, $Request, $Errors){
                    $this->ID = $Record['ID'];
                    $this->UserName = $Record['UserName'];
                    $this->Question = $Record['Question'];
                    $this->Answers = json_decode($Record['Answers'], true);
                    $this->isAuthor = ($Request->Session->User['UserName'] == $Record['UserName']);
    
                    $this->Expired = ( new DateTime($Record['Expire_At']) > new DateTime() ) ? false : true;
                    $this->Errors = $Errors;
                }
            });
        }

        $Record = (new FeedbackAnswers())->Select([
            'FeedBackID' => $Request->Param['id'],
            'UserName' => $Request->Session->User['UserName']
        ], 1);

        (sizeof($Record) != 0) ? $Request->Redirect('/') : null;

        (new FeedbackAnswers())->Insert([
            'FeedBackID' => $Request->Param['id'],
            'UserName' => $Request->Session->User['UserName'],
            'Answer' => $Form->CleanedData['QuestionAnswers']
        ]);

        $Request->Redirect('/');
    }


    function delete($Request){

        (!file_exists(_DIR_.'/InstallerFile')) ? $Request->Redirect('/Installer') : null;
        (!isset($Request->Session->User)) ? $Request->LoginRedirect('/Login') : null;

        (!isset($Request->Param['id'])) ? $Request->Redirect('/') : null;


        (new Feedback())->Delete([
            'ID' => $Request->Param['id'],
            'UserName' => $Request->Session->User['UserName']
        ]);

    }
}
