<?php

include_once "class.procedimento.php";
include_once "class.consultaExecucao.php";

class InfosProcedimento
{
    private $procedimento;
    private $consultas = [];
    private $status;
    private Datetime $data_conclusao;

    public function __construct($procedimento)
    {
        $this->procedimento = $procedimento;
        $this->status = "Em andamento";
    }

    public function adicionaConsulta(ConsultaExecucao $consulta)
    {
        $this->consultas[] = $consulta;
    }

    public function setStatus($novo_status)
    {
        $this->status = $novo_status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setarDataConclusao(Datetime $data_conclusao)
    {
        $this->data_conclusao = $data_conclusao;
    }

    public function getDataConclusao()
    {
        return $this->data_conclusao->format('d-m-Y');
    }
}
