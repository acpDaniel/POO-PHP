<?php

include_once "class.includes.php";

class Paciente extends Pessoa {
    protected string $rg;
    protected string $nascimento;
    protected Cliente $responsavel;

    public function __construct(string $nome, string $email, int $telefone, string $rg, string $nascimento, Cliente $responsavel) {
        parent::__construct($nome, $email, $telefone);
        $this->rg = $rg;
        $this->nascimento = $nascimento;
        $this->responsavel = $responsavel;
        $responsavel->addPacientes($this); //testar essa relação
    }

    public function getRg() {
        return $this->rg;
    }
    public function getNascimento() {
        return $this->nascimento;
    }
    public function getResponsavel() {
        return $this->responsavel;
    }
}
?>