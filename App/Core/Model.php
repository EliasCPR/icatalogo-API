<?php

namespace App\Core;

class Model
{
    //Vamos aplicar o padrão de projeto Singleton
    private static $conexao;

    public static function getConexao()
    {
        //se a conexão não estiver criada, criamos ela
        if(!isset($conexao)){
            //self é usado para pegar um atributo estáticoo desta classe
            self::$conexao = new \PDO("mysql:host=localhost;port=3306;dbname=icatalogo;", "root", "bcd127");
        }

        //retornamos a connexão
        return self::$conexao;
    }
}
