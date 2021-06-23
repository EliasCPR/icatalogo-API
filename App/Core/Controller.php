<?php

namespace App\Core;

class Controller{

  //recebemos o model a ser intanciado 
  //retornamos a instancia pronta
  public function model($model){
    require_once("../App/Model/" . $model . ".php");
    return new $model;
  }
  
  public function view($view, $dados = []){
    require_once "../App/View/template.php";
  }

}