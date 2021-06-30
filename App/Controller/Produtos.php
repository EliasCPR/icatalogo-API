<?php

    use App\Core\Controller;

    class Produtos extends Controller{

        //listagem
        public function index(){ 
            $produtoModel = $this->model("Produto");

            $produtos = $produtoModel->listarTodos();

            $produtos = array_map(function ($p){
                $p->categoria = ["id" => $p->categoria_id, "descricao" => $p->categoria];
                unset($p->categoria_id);
                return $p;
                }, $produtos);
            
            echo json_encode($produtos, JSON_UNESCAPED_UNICODE);
        }

        //buscar por id

        public function find($id){

            $produtoModel= $this->model("Produto");
            
            $produtoModel = $produtoModel->buscarPorId($id);

            if($produtoModel){
                $produtoModel->categoria = ["id" => $produtoModel->categoria_id,"descricao" => $produtoModel->categoria];
                unset($produtoModel->categoria_id);

                echo json_encode($produtoModel, JSON_UNESCAPED_UNICODE);
            }else{
                http_response_code(404);
                json_encode(["erro"=>"Produto não encontrado"]);
            }

        }

        
    

    }