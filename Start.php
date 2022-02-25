<?php

define('_DIR_', __DIR__);

assert_options(ASSERT_BAIL, true);


require_once(_DIR_.'/Services/App.php');


use Services\App;



$app = new App();

$app->StartRouting();
$app->ProcessView();
$app->ProcessTemplate();
$app->EndRequest();
