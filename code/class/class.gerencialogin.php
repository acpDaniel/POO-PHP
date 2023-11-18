<?php
require_once('class.profissional.php');
require_once('class.funcionalidades.php');
class GerenciaLogin
{
    
    static private GerenciaLogin $usuario_logado = null;
    private Funcionalidades $funcionalidades;
    private function __construct(true)
    {
        
    }
    
    static function ValidaLogin():bool
    {
        return 0;
    }
    static function Logout()
    {
        if($usuario_logado != null){
            print("Logout efetuado.");
            $usuario_logado = null
        }
        else{
            print("Nenhum usuário em uso, impossível deslogar.")
        }
    }
    static function ControlaLogins(true){
        if(self::$usuario_logado == null){
            self::$usuario_logado == new GerenciaLogin();
            print("Login efetuado com sucesso");
        }
        else{
            print("Desconecte da sessão atual para poder logar.");
        }
        return self::$usuario_logado;
    } 
}
?>
