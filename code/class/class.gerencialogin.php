<?php
require_once('class.profissional.php');
require_once('class.funcionalidades.php');
class GerenciaLogin {
   private static Profissional $usuario_logado;
   private Funcionalidades $funcionalidades;
   static private $ptr_container = null;

   public function __construct(){

   }
   
    public function ValidaLogin(): boolean{
      
    }
    public function ControlaLogins(): Profissional{

    }
    static function getInstance() {
            if ( self::$ptr_container == null )
                self::$ptr_container = new GerenciaLogin();

            return self::$ptr_container;
    }
}
?>
