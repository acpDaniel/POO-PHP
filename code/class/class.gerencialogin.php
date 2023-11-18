<?php
require_once('class.profissional.php');
class GerenciaLogin
{
    
    static private GerenciaLogin $usuario_logado = null;
    private Funcionalidades $funcionalidades;
    private string $usuario;
    private string $senha;
    private function __construct($usuario, $senha){
    }
        $this -> usuario = $usuario;
        $this -> senha = $senha
    
    private function ValidaLogin($usuario, $senha):bool
    {
        if(true){ #Verificar se o login e senha passados por parâmetro estão no persist
            print("Login efetuado com sucesso.");
            return true
        }
        print("Usuário e/ou senha inválidos.")
        return false
      
    }
    static function Logout()
    {
        if(self::$usuario_logado != null){
            print("Logout efetuado.");
            $self::usuario_logado = null;
        }
        else{
            print("Nenhum usuário em uso, impossível deslogar.");
        }
    }
    static function ControlaLogins($usuario, $senha){
        if(self::$usuario_logado == null){
            if(ValidaLogin($usuario, $senha)==true){
                self::$usuario_logado == new GerenciaLogin();
            }
        }
        else{
            print("Desconecte da sessão atual para poder logar.");
        }
        return self::$usuario_logado;
    } 
}
?>
