<?php

class Especialidade {
    protected string $nome;
    
    public function __construct(string $nome){
        $this->nome = $nome;
    }
    
    public function getEspecialidade(){
      return $this->nome;
    }

    public function setEspecialidade(string $nome){
        $this->nome = $nome;
    }
}

?>