<?php 
const _DIR_ROOT_ = __DIR__;
//Xu ly http root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
    $web_root = 'https://'.$_SERVER['HTTP_HOST'];
}else{
    $web_root = 'http://'.$_SERVER['HTTP_HOST'];
}
    //$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(_DIR_ROOT_));
define('_WEB_ROOT_', $web_root.'/mvc-tranninng');
//
require_once 'configs/routes.php';
require_once 'app/App.php';
require_once 'core/Controller.php';
require_once 'core/ControllerClient.php';
require_once 'core/Model.php';

?> 