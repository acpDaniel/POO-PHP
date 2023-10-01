<?php

// importa a classe mãe da herança "pessoa"
include_once "class.pessoa.php";
include_once "class.paciente.php";
include_once "class.orcamento.php";
include_once "class.tratamento.php";

class Cliente extends Pessoa {
    // Atributos protegidos
    private string $rg;
    private string $cpf;
    private array $pacientes;
    
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

    public function getPaciente(int $i) {
        $paciente = $this->getPacientes();
        return $paciente[$i];
    }

    // Métodos para definir os atributos
    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function criarPaciente(string $nome, string $email, int $telefone, string $rg, string $nascimento) {
        $novopaciente = new Paciente ($nome, $email, $telefone, $rg, $nascimento, $this);
        $this->addPacientes($novopaciente);
        echo "Paciente " . $nome . " criado para " . $this->getNome() . "\n";
    }

    public function setArrayPacientes(array $pacientes) {
        $this->pacientes = $pacientes;
    }

    public function addPacientes(Paciente $novopaciente) {
        array_push($this->pacientes, $novopaciente);
    }
}
?>