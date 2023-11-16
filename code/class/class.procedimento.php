<?php
require_once("persist.php");
class Procedimento  extends persist
{
    private string $nome;
    private float $valor;
    private string $descricao;
    static $local_filename = "procedimentos.txt";

    public function __construct(string $nome, float $valor, string $descricao)
    {
        $this->nome = $nome;
        $this->valor = $valor;
        $this->descricao = $descricao;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
