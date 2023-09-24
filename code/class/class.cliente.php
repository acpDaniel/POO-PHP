<?php

include_once "class.pessoa.php";

class Cliente extends Pessoa {
    // Atributos protegidos
    private string $rg;
    private string $cpf;
    private array $lista_pacientes = array();
    
    // Construtor
    public function __construct(string $nome, string $email, int $telefone, string $rg, string $cpf) {
        parent::__construct($nome, $email, $telefone);
        $this->rg = $rg;
        $this->cpf = $cpf;
        // $this->lista_pacientes = array();
    }

    // Métodos para obter os atributos
    public function getRg() {
        return $this->rg;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getListaPacientes() {
        return $this->lista_pacientes;
    }

    // Métodos para definir os atributos
    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setListaPacientes($lista_pacientes) {
        $this->lista_pacientes = $lista_pacientes;
    }
}
?>