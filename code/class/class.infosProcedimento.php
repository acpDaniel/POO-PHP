<?php

include_once "class.procedimento.php";
include_once "class.consultaExecucao.php";
require_once("persist.php");

class InfosProcedimento extends persist
{
    private $procedimento;
    private $dentista_executor = null;
    private $consultas = [];
    private $status;
    private Datetime $data_conclusao;
    static $local_filename = "infos_procedimentos.txt";

    public function __construct($procedimento)
    {
        $this->procedimento = $procedimento;
        $this->status = "Em andamento";
    }

    public function getDentistaExecutor()
    {
        return $this->dentista_executor;
    }

    public function setDentistaExecutor($dentista_executor)
    {
        if ($this->dentista_executor == null || $this->dentista_executor->getcpf() != $dentista_executor->getCpf()) {
            return;
        } else {
            $this->dentista_executor = $dentista_executor;
        }
    }

    public function getProcedimento()
    {
        return $this->procedimento;
    }

    public function adicionaConsulta(ConsultaExecucao $consulta)
    {
        if ($this->dentista_executor != null && $this->dentista_executor->getcpf() != $consulta->getDentistaExecutor()->getCpf()) {
            return;
        } else {
            $this->consultas[] = $consulta;
            $this->dentista_executor = $consulta->getDentistaExecutor();
        }
    }

    public function getConsultas()
    {
        return $this->consultas;
    }

    public function setStatus($novo_status)
    {
        $this->status = $novo_status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setDataConclusao(Datetime $data_conclusao)
    {
        $this->data_conclusao = $data_conclusao;
    }

    public function getDataConclusao()
    {
        return $this->data_conclusao->format('d-m-Y');
    }
    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
