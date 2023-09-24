<?php

include_once "class.pessoa.php";

class Paciente extends Pessoa {
    protected string $rg;
    protected string $nascimento;
    protected string $responsavel;

    public function __construct(string $nome, string $email, int $telefone, string $rg, string $nascimento, string $responsavel) {
        parent:: __construct($nome, $email, $telefone);
        $this->rg = $rg;
        $this->nascimento = $nascimento;
        $this->responsavel = $responsavel;
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