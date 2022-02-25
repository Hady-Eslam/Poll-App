<?php

use Services\BaseView;


class Logout extends BaseView{

    function get($Request){
        $Request->Session->Reset();
        $Request->Redirect('/Login');
    }
}
