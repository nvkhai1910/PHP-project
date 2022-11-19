<?php 
class App{
    private $controller;
    private $action;
    private $params;

    function __construct(){
        global $routes;
        if(!empty($routes['default_controller'])){
            $this->controller = $routes['default_controller'];
        }
        $this->action = 'index';
        $this->parmas = [];
        $this->handUrl();
    }
    function getUrl(){
        if(!empty($_SERVER['REDIRECT_QUERY_STRING'])){
            $url = $_SERVER['REDIRECT_QUERY_STRING'];
        }else{
            $url = '/';
        }
        return $url;
    }
    public function handUrl(){
        $url = $this->getUrl();
        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);

        $urlCheck = '';
        if(!empty($urlArr)){
            foreach($urlArr as $key=>$item){
                $urlCheck.=$item.'/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode('/', $fileArr);
                if(!empty($urlArr[$key - 1])){
                    unset($urlArr[$key - 1]);
                }
                if(file_exists('./app/controllers/'.$fileCheck.'.php')){
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArr = array_values($urlArr);
        }

        //xu ly controller
        if(!empty($urlArr[0])){
            $this->controller = ucfirst($urlArr[0]);
        }else{
            $this->controller = ucfirst($this->controller);
        }
        //xu ly khi url check rong
        if(empty($urlCheck)){
            $urlCheck = $this->controller;
        }
        if(file_exists('./app/controllers/'.$urlCheck.'.php')){
            require_once 'controllers/'.$urlCheck.'.php';
            //Kiem tra class ton tai
            if(class_exists($this->controller)){
                $this->controller = new $this->controller;
                unset($urlArr[0]);
            }else{
                $this->loadError();
            }
        }else{
            $this->loadError();
        }
        //xu ly action
        if(!empty($urlArr[1])){
            if(method_exists($this->controller, $urlArr[1])){
                $this->action = $urlArr[1];
                unset($urlArr[1]);
            }
        }
        //Xu ly params
        $this->params = array_values($urlArr);
        call_user_func_array([$this->controller, $this->action], $this->params);
    }
    public function loadError($name='404'){
        require_once 'error/'.$name.'.php';
    }
}
?>