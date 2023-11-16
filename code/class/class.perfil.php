<?php

class Perfil
{

    private array $funcionalidade_permitidas;

    public function __construct()
    {
        
    }

    protected function getFuncionalidades()
    {
        return $this->funcionalidade_permitidas;
    }

    private function adicionaFuncionalidades($nova_funcionalidade)
    {
        $this->funcionalidade_permitidas[] = $nova_funcionalidade;
    }
}
