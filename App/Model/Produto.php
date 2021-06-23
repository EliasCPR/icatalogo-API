<?php

use App\Core\Model;

class Produto
{

    public $id;
    public $descricao;
    public $peso;
    public $tamanho;
    public $quantidade;
    public $cor;
    public $valor;
    public $desconto;
    public $imagem;

    public function listarTodos()
    {
        $sql = " SELECT p.*, c.descricao as categoria FROM tbl_produto p
                 INNER JOIN tbl_categoria c ON p.categoria_id = c.id ORDER BY p.id DESC ";

        //preparamos a consulta
        $stmt = Model::getConexao()->prepare($sql);
        //executamos a consulta
        $stmt->execute();

        //verificamos a quantidade de linhas
        if ($stmt->rowCount() > 0) {
            //pegamos os resultados em forma de lista de objetos
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            //retornamos o resultado
            return $resultado;
        } else {
            return [];
        }
    }
}
