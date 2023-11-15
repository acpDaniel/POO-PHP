<?php

class Pessoa
{
    // atributos protegidos
    protected string $nome;
    protected string $email;
    protected string $telefone;

    // construtor da classe Pessoa
    public function __construct(string $nome, string $email, string $telefone)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
    }

    // retornar o nome
    public function getNome(): string
    {
        return $this->nome;
    }

    // retornar o email
    public function getEmail(): string
    {
        return $this->email;
    }

    // retornar o telefone
    public function getTelefone(): string
    {
        return $this->telefone;
    }

    // valida o telefone
    // no futuro pode ser um bool, depende do que olhar com o professor
    // do jeito q ta agora so ta funcional, sem entrada de variaveis pelo terminal
    // mas se tiver entrada de strings pelo terminal precisa mudar
    public function validaTelefone(string $telefone): bool
    {
        $validado = 1;

        // o telefone so pode ter numeros
        if (ctype_digit($telefone) == false) {
            echo "Número de telefone contém digitos não numéricos.";
            $validado = 0;
        }
        // Um telefone tem que ter 11 digitos
        if (strlen($telefone) != 11) {
            echo "Número de telefone não possui o tamanho esperado: 11 digitos \n";
            $validado = 0;
        }
        // O terceiro digito de um telefone tem que ser um 9
        if ($telefone[2] != 9) {
            echo "Número de telefone não possui o formato esperado: xx9xxxxxxxx\n";
            $validado = 0;
        }
        return $validado;
    }


    // funções para que o codigo rode
    // futuramente vai ir pra uma classe mãe da pessoa
    public function printMe()
    {
    }
    public function getFileName()
    {
    }
}
