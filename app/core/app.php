<?php

// this class Handle url and send to public

class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params;

    // Handle URL, Clean Url and return URL
    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";

        //Delete character "/" whitespace of end url
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }

    //Constructor app
    public function  __construct()
    {

        $url = $this->parseURL();
        $url[0] = str_replace("-", "_", $url[0]);

        // set again url, set again index from 0
        if (file_exists("../app/controllers/" . strtolower($url[0]) . ".php")) {
            $this->controller = strtolower($url[0]);
            unset($url[0]);
        }
        require("../app/controllers/" . $this->controller . ".php");
        $this->controller = new $this->controller;
        if (isset($url[1])) {
            $url[1] = strtolower($url[1]);
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //set URL index again from 0
        $this->params = (count($url) > 0) ? $url : ["home"];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    
}
