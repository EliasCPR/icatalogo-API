<?php

session_start();

use App\Core\Controller;

use App\Core\Model;

class Categorias extends Controller
{

    public function index()
    {

        $categoriaModel = $this->model("Categoria");

        $categorias = $categoriaModel->listarTodas();

        echo  json_encode($categorias, JSON_UNESCAPED_UNICODE);
    }

    public function find($id){

    $categoriaModel = $this->model("categoria");

    $categoria = $categoriaModel->buscarPorID($id);

    if($categoria){

        echo json_encode($categoria,JSON_UNESCAPED_UNICODE);
    }else{
        http_response_code(400);
        echo json_encode(
            ["erro" => "Categoria não encontrada"],
            JSON_UNESCAPED_UNICODE
        );
    }

    }

}