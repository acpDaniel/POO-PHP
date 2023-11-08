<?php

class Especialidade
{
    protected string $nome;
    public $procedimentos_permitidos = array();

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function getEspecialidade()
    {
        return $this->nome;
    }

    public function setEspecialidade(string $nome)
    {
        $this->nome = $nome;
    }

    public function adicionarProcedimento(Procedimento $procedimento)
    {
        array_push($this->procedimentos_permitidos, $procedimento);
    }
}
