<?php

// importa a classe mãe da herança "pessoa"
include_once "class.pessoa.php";

// classe Paciente, filha da classe Pessoa
class Paciente extends Pessoa {
    // atributos protegidos
    protected string $rg;
    protected string $nascimento;
    protected Cliente $responsavel;

    // construtor de paciente
    public function __construct(string $nome, string $email, int $telefone, string $rg, string $nascimento, Cliente $responsavel) {
        parent::__construct($nome, $email, $telefone);  // construtor da classe mãe Pessoa
        $this->rg = $rg;
        $this->nascimento = $nascimento;
        $this->responsavel = $responsavel;
    }

    // retorna rg
    public function getRg() : string {
        return $this->rg;
    }

    // retorna nascimento
    public function getNascimento() : string {
        return $this->nascimento;
    }

    // retorna responsavel
    public function getResponsavel() : Cliente {
        return $this->responsavel;
    }

    // valida o nascimento, do tipo dd/mm/aaaa, porem recebe a string como ddmmaaaa
    public function validaNascimento($nascimento) : bool {
        $validado = 1;
        //o nascimento tem q ter 8 caracteres
        if (strlen($nascimento) != 8)
            echo "A data de nascimento não possui o tamanho esperado: 8 digitos \n";
            $validado = 0;

        // O terceiro digito de um telefone tem que ser um 9
        if ($nascimento[0] . $nascimento[1] >= 31)
            echo "O dia do nascimento foi excedido: > 31\n";
            $validado = 0;
            
    

        return $validado;
    }
}
?>