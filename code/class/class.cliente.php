<?php

include_once "class.includes.php";

class Cliente extends Pessoa {
    // Atributos protegidos
    private string $rg;
    private string $cpf;
    public array $pacientes; // mudar para privado e ver se acontece erro
    
    // Construtor
    public function __construct(string $nome, string $email, int $telefone, string $rg, string $cpf) {
        parent::__construct($nome, $email, $telefone);
        $this->rg = $rg;
        $this->cpf = $cpf;
        $this->pacientes = array();
    }

    // Métodos para obter os atributos
    public function getRg() {
        return $this->rg;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getPacientes() {
        return $this->pacientes;
    }

    // Métodos para definir os atributos
    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setArrayPacientes(array $pacientes) {
        $this->pacientes = $pacientes;
    }

    public function addPacientes(Paciente $novopaciente) {
        array_push($this->pacientes, $novopaciente);
    }
}
?>