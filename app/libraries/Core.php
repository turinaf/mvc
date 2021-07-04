<?php

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        // print_r($this->getUrl());
        $url = $this->getUrl();

        // ucwords will capitalize first words.
        if (file_exists('../app/controllers/' .ucwords($url[0]).'.php')){
             // set new controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        // Require the controller
        require_once '../app/controllers'. $this->currentController.'php';
        $this->currentController = new $this->currentController;
    }
    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            // Filter variables as string/number
            $url = filter_var($url, FILTER_SANITIZE_URL);
             // Breaking into arrays
            $url = explode('/', $url);
            return $url;
        }
    }
}