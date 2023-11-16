<?php
require_once("persist.php");
class Especialidade extends persist
{
    private $nome;
    private $procedimentos_permitidos = array();
    static $local_filename = "especialidades.txt";

    public function __construct(string $nome, array $procedimentos_permitidos)
    {
        $this->nome = $nome;
        $this->procedimentos_permitidos = $procedimentos_permitidos;
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

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
