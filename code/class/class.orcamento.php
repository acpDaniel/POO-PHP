<?php

include_once "class.includes.php";

class Orcamento {
    private Paciente $paciente;
    private Dentista $dentista;
    private string $data;
    private array $procedimentos;

    public function __construct(Paciente $paciente, Dentista $dentista, string $data, array $procedimentos)
    {
        $this->paciente = $paciente;
        $this->dentista = $dentista;
        $this->data = $data;
        $this->procedimentos = $procedimentos;
    }
    
    public function getPaciente() {
        return $this->paciente;
    }

    public function getDentista() {
        return $this->dentista;
    }

    public function getData() {
        return $this->data;
    }

    public function getProcedimentos() {
        return $this->procedimentos;
    }
}


?>