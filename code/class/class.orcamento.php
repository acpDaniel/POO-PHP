<?php

include_once "class.procedimento.php";
include_once "class.paciente.php";
include_once "class.dentista.php";
require_once("persist.php");

class Orcamento extends persist
{
    private Paciente $paciente;
    private $dentista_avaliador;
    private Datetime $data_orcamento;
    private $valor_total;
    private $procedimentos = array();
    private $detalhamentos_procedimento = [];
    static $local_filename = "orcamentos.txt";

    public function __construct(Paciente $paciente, $dentista_avaliador, Datetime $data, array $procedimentos)
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

    public function getDataOrcamento()
    {
        return $this->data_orcamento->format('d-m-Y');
    }

    public function getProcedimentos()
    {
        return $this->procedimentos;
    }

    public function getDetalhamentos()
    {
        return $this->detalhamentos_procedimento;
    }

    public function getDetalhamentoProcedimento($procedimento)
    {
        return $this->detalhamentos_procedimento[$procedimento->getNome()];
    }

    public function setDetalhamentoProcedimento($procedimento, $detalhamento)
    {
        $this->detalhamentos_procedimento[$procedimento->getNome()] = $detalhamento;
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

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
