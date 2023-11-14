<?php

class Perfil {
    private array $funcionalidade_permitidas;
    
    protected function getFuncionalidades(){
        return $funcionalidade_permitidas;
    }

    private function adicionaFuncionalidades($nova_funcionalidade){
        $this->funcionalidade_permitidas[] = $nova_funcionalidade;
        return $funcionalidade_permitidas;
    }
    
}
?>
