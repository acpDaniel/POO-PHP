<?php

include_once "class.includes.php";

class Tratamento extends Orcamento {
    private float $valor;
    private Orcamento $orcamento;

    public function __construct(float $valor, Orcamento $orcamento) {
        $this->orcamento = $orcamento;
        $this->valor = $this->getValor();
    }

    public function getValor() {
        // pega o array de procedimentos dentro do orçamento
        $procedimentos = $this->orcamento->getProcedimentos();
        $valor = 0;

        //conta esses procedimentos e soma eles
        for ($i = 0; $i < count($procedimentos); $i++) {
            $valor += $procedimentos[$i]->getValor();
        }
        return $valor;
    }

}


?>