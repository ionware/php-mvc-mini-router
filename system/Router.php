<?php

namespace sys;

class Router
{

    protected $routes = [
        "GET" => [],
        "POST" => []
    ];

    protected $defaultErrorPage = "404.view";

    public static function load($route_file){
        /*
         * Creates new instance of ROuter Class with
         * route defintions been loaded
         *
         * @param path-to-route-definitions
         *
         * @return Router::class instance
         *
         * */

        $route = new Router();

        require $route_file;

        return $route;
    }



    public function get($uri, $controller){

        /*
         * Add URI of type GET to the Router URI
         * List.
         *
         * @param URI [string]
         *
         * @param controller[string] corresponding to URI
         *
         * @return null
         *
         * */

        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller){

        /*
         * Add URI of type POST to the Router URI
         * List.
         *
         * @param URI [string]
         *
         * @param controller[string] corresponding to URI
         *
         * @return null
         *
         * */

        $this->routes['POST'][$uri] = $controller;
    }




    public function direct($uri, $req_method)
    {
        /*
         * Loads controller Class that correspond to URI
         *
         * @param URI [string]
         *
         * @param Request Type [string] GET|POST
         *
         * @return [Object] from Controller Class method
         *
         * */

        if(array_key_exists($uri, $this->routes[$req_method])){

            $controller = explode("@", $this->routes[$req_method][$uri])[0];
            $method = explode("@", $this->routes[$req_method][$uri])[1];

            return $this->controllerHandler($controller, $method);
        } else {

            return $this->errorRender();
        }

    }


    private function errorRender(){

        return view($this->defaultErrorPage, NULL);
    }

    private function controllerHandler($controller, $method){

        $controller_string = "ehr\\Controllers\\" . $controller;

        $controller_method = new $controller_string;

        if(! method_exists($controller_method, $method)){
            throw new \Exception("Contoller does not have the specified method {$method}");
        }

         return $controller_method->$method();
    }
}