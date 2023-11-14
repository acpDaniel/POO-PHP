<?php
class Consulta
{
    private Dentista $dentista_executor;
    private Datetime $data;
    private string $horario;
    private string $duracao_consulta;

    public function __construct($dentista_executor, Datetime $data, $horario, $duracao_consulta)
    {
        $this->dentista_executor = $dentista_executor;
        $this->data = $data;
        $this->horario = $horario;
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

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function setHorario($horario)
    {
        $this->horario = $horario;
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
