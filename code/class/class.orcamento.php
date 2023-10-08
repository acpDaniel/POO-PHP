<?php

include_once "class.procedimento.php";
include_once "class.paciente.php";
include_once "class.dentista.php";

class Orcamento {
    private Paciente $paciente;
    private Dentista $dentista;
    private string $data;
    private array $procedimentos;
    private $detalhamento;

    public function __construct(Paciente $paciente, Dentista $dentista, string $data, array $procedimentos)
    {
        $this->paciente = $paciente;
        $this->dentista = $dentista;
        $this->data = $data;
        $this->procedimentos = $procedimentos;
    }
    
    public function getPaciente() {
        return $this->paciente;
    }

    public function getDentista() {
        return $this->dentista;
    }

    public function getData() {
        return $this->data;
    }

    public function getProcedimentos() {
        return $this->procedimentos;
    }

    public function getDetalhamento() {
        return $this->procedimentos;
    }

    public function setDetalhamento($detalhamento) {
        $this->detalhamento = $detalhamento;
    }

    public function aprovarOrcamento($valor, $forma_pagamento, $data) {
        $tratamento = new Tratamento($valor, $forma_pagamento, $data);
        return $tratamento;
    }
}


?>
