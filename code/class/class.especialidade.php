<?php

class Especialidade
{
    private $nome;
    private $procedimentos_permitidos = array();

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNomeEspecialidade()
    {
        return $this->nome;
    }

    public function setNomeEspecialidade(string $nome)
    {
        $this->nome = $nome;
    }

    public function getProcedimentosPermitidos()
    {
        return $this->procedimentos_permitidos;
    }

    public function adicionarProcedimento(Procedimento $procedimento)
    {
        array_push($this->procedimentos_permitidos, $procedimento);
    }
}
