<?php

include_once "class.orcamento.php";

class ConsultaAvaliacao extends Consulta
{
    private $paciente;

    public function __construct($paciente, $dentista_executor, $data, $horario)
    {
        parent::__construct($dentista_executor, $data, $horario, "30 minutos");
        $this->paciente = $paciente;
    }

    public function criaOrcamento(Datetime $data_orcamento, array $procedimentos)
    {
        $novo_orcamento = new Orcamento($this->paciente, $this->getDentistaExecutor(), $data_orcamento, $procedimentos);
        return $novo_orcamento;
    }
}
