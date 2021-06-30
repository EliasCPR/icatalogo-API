<?php

namespace App\Core;

class Router
{

    private $controller;

    private $httpMethod = "GET";

    private $controllerMethod = "index";

    private $params = [];



    function __construct()
    {
        //setando no header do response o content-type
        header("content-type: application/json");

        //recuperar a URL que esta sendo acessada
        $url = $this->parseURL();

        //se controller existir dentro da pasta de controller
        if (isset($url[1]) && file_exists("../App/Controller/" . $url[1] . ".php")) {
            $this->controller = $url[1];

            unset($url[1]);
        } elseif (empty($url[1])) {

            //setamos o controller padrão da aplicação
            $this->controller = "produtos";
        } else {
            /*Se não existir ou ouver um controller na url
                exibimos página não encontrada*/

            $this->controller = "erro404";
        }
        //importamos o controller
        require_once "../App/Controller/" . $this->controller . ".php";

        //instanciamos o controller
        $this->controller = new $this->controller;

        //pegando o metodo http
        $this->httpMethod = $_SERVER["REQUEST_METHOD"];

        //pegando o metodo do controller baseando-se no http method
        switch ($this->httpMethod) {

            case "GET":
                if (!isset($url[2])) {
                    $this->controllerMethod = "index";

                } elseif (is_numeric($url[2])) {

                    $this->controllerMethod = "find";

                    $this->params = [$url[2]];
                } else {
                    
                    http_response_code(400);
                    echo json_encode(
                        ["erro" => "Parâmetro inválido"],
                        JSON_UNESCAPED_UNICODE
                    );
                    exit;
                }
                break;

            case "POST":
                $this->controllerMethod = "store";

                break;

            case "PUT":
                $this->controllerMethod = "update";
                break;

            case "DELETE":
                $this->controllerMethod = "delete";
                break;

            default:
                echo "Método não habilitado";
                exit;
        }
        //aribuimos ao atributo method
        if (isset($url[2])) {
            if (method_exists($this->controller, $url[2])) {
                $this->method = $url[2];
                unset($url[2]);
                unset($url[0]);
            }
        }



        //executamos o método dentro do controller, passando os parametros
        call_user_func_array([$this->controller, $this->controllerMethod], $this->params);
    }

    //recuperar a URL e recuperar os parametros
    private function parseURL()
    {
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }
}