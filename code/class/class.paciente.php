<?php

include_once "class.pessoa.php";

class Paciente extends Pessoa
{
    protected string $rg;
    protected Datetime $data_nascimento;
    protected Cliente $cliente_responsavel;

    public function __construct(string $nome, string $email, int $telefone, string $rg, Datetime $data_nascimento, Cliente $cliente_responsavel)
    {
        parent::__construct($nome, $email, $telefone);
        $this->rg = $rg;
        $this->data_nascimento = $data_nascimento;
        $this->cliente_responsavel = $cliente_responsavel;
    }

    public function setRg(string $rg)
    {
        $this->rg = $rg;
    }

    public function setDataNascimento(Datetime $data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    public function setClienteResponsavel(Cliente $cliente_responsavel): void
    {
        $this->cliente_responsavel = $cliente_responsavel;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getNascimento()
    {
        return $this->data_nascimento->format('d-m-Y');
    }

    public function getClienteResponsavel()
    {
        return $this->cliente_responsavel;
    }
}
