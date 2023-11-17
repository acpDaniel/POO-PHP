<?php
require_once('class.perfil.php');
require_once("persist.php");

class Usuario extends persist
{
    protected string $login;
    protected string $senha;
    protected Perfil $perfil;
    static $local_filename = "perfis.txt";

    public function __construct(string $login, string $senha, Perfil $perfil)
    {
        $this->login = $login;
        $this->senha = $senha;
        $this->perfil = $perfil;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    public function getPerfil()
    {
        return $this->perfil;
    }

    public function setPerfil(Perfil $perfil)
    {
        $this->perfil = $perfil;
    }

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }
}
