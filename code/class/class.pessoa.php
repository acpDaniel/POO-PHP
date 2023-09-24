<?php

class Pessoa {
    protected string $nome;
    protected string $email;
    protected int $telefone;

    public function __construct(string $nome, string $email, int $telefone) {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
    }

    public function getNome() {
        return $this->nome;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTelefone() {
        return $this->telefone;
    }
    public function printMe(){}
    public function getFilename(){}
}
?>