<?php
class ConsultaAvaliacao extends Consulta
{
    private $paciente;

    public function __construct($paciente, $dentista_executor, $data, $horario)
    {
        parent::__construct($dentista_executor, $data, $horario, 30);
        $this->paciente = $paciente;
    }
}
