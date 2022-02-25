<?php


use Services\BaseView;
use Services\Context;


class Statics extends BaseView{

    function get($Request){

        (!file_exists(_DIR_.'/InstallerFile')) ? $Request->Redirect('/Installer') : null;
        (!isset($Request->Session->User)) ? $Request->LoginRedirect('/Login') : null;

        (!isset($Request->Param['ID'])) ? $Request->Redirect('/') : null;


        $Feedback = (new Feedback())->Select([
            'ID' => $Request->Param['ID']
        ], 1);


        (sizeof($Feedback) < 1) ? $Request->Redirect('/') : null;
        $Feedback = $Feedback[0];


        ($Feedback['UserName'] != $Request->Session->User['UserName']) ? $Request->Redirect('/') : null;


        $FeedbackAnswers = (new FeedbackAnswers())->Select([
            'FeedBackID' => $Request->Param['ID']
        ]);

        return new Context($Request, 'Statics', new class($Feedback, $FeedbackAnswers){
            public $Title = 'Statics';
            public $Feedback = [];
            public $FeedbackAnswers = [];

            function __construct($Feedback, $FeedbackAnswers){
                $this->Feedback = $Feedback;
                $this->FeedbackAnswers = $FeedbackAnswers;
            }
        });
    }
}
