<?php

include_once "class.procedimento.php";
include_once "class.paciente.php";
include_once "class.dentista.php";

class Orcamento
{
    private Paciente $paciente;
    private Dentista $dentista_avaliador;
    private Datetime $data_orcamento;
    private $procedimentos = array();
    private $detalhamento;
    private $valor_total;

    public function __construct(Paciente $paciente, Dentista $dentista_avaliador, Datetime $data, array $procedimentos)
    {
        $this->paciente = $paciente;
        $this->dentista_avaliador = $dentista_avaliador;
        $this->data_orcamento = $data;
        $this->procedimentos = $procedimentos;
        $this->valor_total = $this->calculaValorTotal();
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
        return $this->data_orcamento->format('d-m-Y');
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

    public function aprovarOrcamento($forma_pagamento_proposto)
    {
        $tratamento = new Tratamento($forma_pagamento_proposto, $this->paciente, $this->dentista_avaliador, $this->data_orcamento, $this->procedimentos);
        return $tratamento;
    }

    public function calculaValorTotal()
    {
        $valor_total = 0;
        foreach ($this->procedimentos as $procedimento) {
            $valor_total += $procedimento->getValor();
        }
        return $valor_total;
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
