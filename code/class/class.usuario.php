<?php
require_once('class.perfil.php');

class Usuario {
    protected string $login;
    protected string $senha;
    protected Perfil $perfil;
  
    public function cadastraUsuario(string $login, string $senha, Perfil $perfil){
        $this->login = $login;
        $this->senha = $senha;
        $this->perfil = $perfil; 
    }
}
?>
