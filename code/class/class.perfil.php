<?php
require_once("persist.php");
class Perfil extends persist
{
    protected $nome_perfil;
    protected $funcionalidades_permitidas = [];
    static $local_filename = "perfis.txt";

    public function __construct($nome_perfil, $funcionalidades_permitidas)
    {
        $this->nome_perfil = $nome_perfil;
        $this->funcionalidades_permitidas = $funcionalidades_permitidas;
    }

    public function setNomePerfil($nome_perfil)
    {
        $this->nome_perfil = $nome_perfil;
    }

    public function getNomePerfil()
    {
        return $this->nome_perfil;
    }

    public function getFuncionalidadesPermitidas()
    {
        return $this->funcionalidades_permitidas;
    }

    public function adicionaFuncionalidadePermitida($nova_funcionalidade)
    {
        $this->funcionalidades_permitidas[] = $nova_funcionalidade;
    }

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
