<?php

include_once "class.orcamento.php";

class Tratamento extends Orcamento {
    private $valor;
    private $forma_pagamento;
    private $data;
    private $consultas;

    public function __construct($valor, $forma_pagamento, $data) {
        $this->valor = $valor;
        $this->forma_pagamento = $forma_pagamento;
        $this->data = $data;
    }

    public function getValor() {
       return $this->valor;
    }

    public function getFormaPagamento() {
       return $this->forma_pagamento;
    }

    public function getData() {
       return $this->data;
    }

    public function getConsultas() {
       return $this->consultas;
    }
    
    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setFormaPagamento($forma_pagamento) {
        $this->forma_pagamento = $forma_pagamento;
    }

    public function setData($data) {
        $this->data = $data;
    }

     public function setConsultas($consultas) {
        $this->consultas = $consultas;
    }

}


?>
