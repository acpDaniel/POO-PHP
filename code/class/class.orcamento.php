<?php

include_once "class.procedimento.php";
include_once "class.paciente.php";
include_once "class.dentista.php";

class Orcamento
{
    private Paciente $paciente;
    private Dentista $dentista_avaliador;
    private string $data_orcamento;
    private  $procedimentos = array();
    private $detalhamento;
    private $valor_total;

    public function __construct(Paciente $paciente, Dentista $dentista, string $data, array $procedimentos)
    {
        $this->paciente = $paciente;
        $this->dentista_avaliador = $dentista;
        $this->data_orcamento = $data;
        $this->procedimentos = $procedimentos;
    }

    public function getPaciente()
    {
        return $this->paciente;
    }

    public function getDentista()
    {
        return $this->dentista_avaliador;
    }

    public function getData()
    {
        return $this->data_orcamento;
    }

    public function getProcedimentos()
    {
        return $this->procedimentos;
    }

    public function getDetalhamento()
    {
        return $this->detalhamento;
    }

    public function setDetalhamento($detalhamento)
    {
        $this->detalhamento = $detalhamento;
    }

    public function aprovarOrcamento($valor, $forma_pagamento, $data)
    {
        $tratamento = new Tratamento($valor, $forma_pagamento, $data, $this->paciente, $this->dentista_avaliador, $this->data_orcamento, $this->procedimentos);
        return $tratamento;
    }

    public function setValor($valor)
    {
        $this->valor_total = $valor;
    }

    public function getValor()
    {
        return $this->valor_total;
    }

}
