<?php

include_once "class.orcamento.php";

class ConsultaAvaliacao extends Consulta
{
    private $paciente;
    static $local_filename = "consultas_avaliacao.txt";

    public function __construct($paciente, $dentista_executor, $data_horario)
    {
        parent::__construct($dentista_executor, $data_horario, "30 minutos");
        $this->paciente = $paciente;
    }

    public function criaOrcamento($id, Datetime $data_orcamento, array $procedimentos)
    {
        $novo_orcamento = new Orcamento($id, $this->paciente, $this->getDentistaExecutor(), $data_orcamento, $procedimentos);
        return $novo_orcamento;
    }
    public function getPaciente(){
        return $this->paciente;
    }
}
