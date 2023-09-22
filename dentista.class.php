<?php
    include_once("class.dentista.php")
    class Dentista{
        protected string $CRO;
        protected string $especialidade;
        protected float $salario_fixo;
        
        public function __construct(string $CRO, string $especialidade, float $salario_fixo){
            $this->CRO = $CRIO;
            $this->especialidade = $especialidade;
            $this->salario_fixo = $salario_fixo;
        }
        
        public function getCRO(){
            return $this->CRO;
        }
        public function getEspecialidade(){
            return $this->especialidade;
        }
        public function getSalario(){
            return $this->salario_fixo;
        }

        public function setCRO($CRO){
            $this->CRO =  $CRO;
        }
        public function setEspecialidade($especialidade){
            $this->especialidade = $especialidade;
        }
        public function setSalario($salario_fixo){
            $this->salario_fixo = salario_fixo;
        }
    }
?>
