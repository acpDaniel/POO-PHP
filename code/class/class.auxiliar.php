<?php
    include_once("class.auxiliar.php")
    class Auxiliar{
        private float $salario_fixo;  
        public function __construct(float $salario_fixo){
            $this->salario_fixo = $salario_fixo;
        }
        
        public function getSalario(){
            return $this->salario_fixo;
        }
        public function setSalario($salario_fixo){
            $this->salario_fixo = $salario_fixo;
        }
    }
?>
