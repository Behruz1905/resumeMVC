<?php

/*
  * App Core Class
  *  Url create edir & core controller yukleyir
  *URL FORMAT bu cur olacaq -/controller/method/params
*
*/

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'errorPage';
    protected $params = [];

    public function __construct() {

        $url = $this->getUrl();





        if($url == ""){
            $this->currentController = 'Pages';
            $this->currentMethod = 'index';
        }

        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            //eger controller movcuddursa  set ediriy controller kimi
            $this->currentController = ucwords($url[0]);
            unset($url[0]);


             if(!isset($url[1])){
                 $this->currentMethod = 'index';
             }



        }

        require_once '../app/controllers/' . $this->currentController . '.php';

        //Instantiate Controller class
        $this->currentController = new $this->currentController;



        //Url -in 2 ci hissesini check ediriy
        if(isset($url[1])){
            // yoxla gor method movcuddurmu kontrollerde?  ...
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];

                unset($url[1]);
            }
        }


        //parametrleri aliriq
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);


    }

    public function getUrl() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }

    }

}