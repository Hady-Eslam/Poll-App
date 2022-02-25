<?php


use Services\BaseView;
use Services\Context;



class Installer extends BaseView{

    function get($Request){
        
        if ( file_exists(_DIR_.'/InstallerFile') ){
            $Request->Redirect('/');
        }

        return new Context($Request, 'Installer', new class{
            public $Title = 'Installer';
        });
    }


    function post($Request){

        if ( file_exists(_DIR_.'/InstallerFile') ){
            $Request->Redirect('/');
        }


        $User = new User('127.0.0.1', 'root', 'root', '3306', 'FeedbackSystem');
        $User->CreateModel();
        $User->Insert([
            'UserName' => 'Hady',
            'Password' => '123'
        ]);
        (new Feedback('127.0.0.1', 'root', 'root', '3306', 'FeedbackSystem'))->CreateModel();
        (new FeedbackAnswers('127.0.0.1', 'root', 'root', '3306', 'FeedbackSystem'))->CreateModel();
        

        file_put_contents(_DIR_.'/InstallerFile', 'Installed');
        $Request->Redirect('/Login');
    }
}
