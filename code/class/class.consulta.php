<?php
class Consulta
{
    private Dentista $dentista_executor;
    private Datetime $data_horario;
    private $duracao_consulta;

    public function __construct($dentista_executor, Datetime $data_horario, $duracao_consulta)
    {
        $this->dentista_executor = $dentista_executor;
        $this->data_horario = $data_horario;
        $this->duracao_consulta = $duracao_consulta;
    }

    public function getDentistaExecutor()
    {
        return $this->dentista_executor;
    }

    public function setDentistaExecutor($dentista_executor)
    {
        $this->dentista_executor = $dentista_executor;
    }

    public function getDataHorario()
    {
        return $this->data_horario->format('d-m-Y H-i');
    }

    public function setDataHoario($data_horario)
    {
        $this->data_horario = $data_horario;
    }

    public function getDuracaoConsulta()
    {
        return $this->duracao_consulta;
    }

    public function setDuracaoConsulta($duracao_consulta)
    {
        $this->duracao_consulta = $duracao_consulta;
    }
}
