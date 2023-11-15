<?php

class Pessoa
{

    protected string $nome;
    protected string $email;
    protected string $telefone;

    public function __construct(string $nome, string $email, string $telefone)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setTelefone(string $telefone)
    {
        $this->telefone = $telefone;
    }
}
