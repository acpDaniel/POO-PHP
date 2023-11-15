<?php

include_once "class/class.dentistaparceiro.php";
include_once "class/class.dentistafuncionario.php";
include_once "class/class.cliente.php";
include_once "class/class.paciente.php";
include_once "class/class.secretaria.php";
include_once "class/class.auxiliar.php";
include_once "class/class.formaPagamento.php";
include_once "class/funct.txt.php";

function clientepaciente() {
    // cria clientes    (string $nome, string $email, int $telefone, string $rg, string $cpf)
    $cliente1 = new Cliente("John Doe", "johndoe@example.com", "1234567890", "123456789", "12345678901");
    $cliente2 = new Cliente("Jane Smith", "janesmith@example.com", "0987654321", "987654321", "09876543210");
    $cliente3 = new Cliente("Mike Johnson", "mikejohnson@example.com", "5555555555", "555555555", "55555555555");

    // cria paciententes    (string $nome, string $email, int $telefone, string $rg, Datetime $data_nascimento, Cliente $cliente_responsavel)
    $paciente1 = new Paciente("Alice Johnson", "alice@example.com", "9876543210", "7654321", new DateTime("1990-05-15"), $cliente1);
    $paciente2 = new Paciente("Bob Smith", "bob@example.com", "5556667777", "9876543", new DateTime("1985-08-22"), $cliente1);
    $paciente3 = new Paciente("Charlie Brown", "charlie@example.com", "1112223333", "1234567", new DateTime("1998-03-10"), $cliente3);
    $paciente4 = new Paciente("Diana Wilson", "diana@example.com", "9998887777", "8765432", new DateTime("1980-11-28"), $cliente2);
    $paciente5 = new Paciente("Eva Davis", "eva@example.com", "3334445555", "2345678", new DateTime("1995-09-05"), $cliente3);
}

function dentistas(){
    //cria especialidades (string $nome, array<Procedimentos> $procedimentospermitidos)

    //cria endereços ($rua, $bairro, $numero, $cep, $cidade, $estado, $complemento)
    $endereco4 = new Endereco("Rua D", "Bairro W", "246", "13579-246", "Cidade D", "Estado DD", "Casa 15");
    $endereco5 = new Endereco("Rua E", "Bairro V", "135", "98765-432", "Cidade E", "Estado EE", "Apto 202");
    $endereco6 = new Endereco("Rua F", "Bairro U", "802", "24680-135", "Cidade F", "Estado FF", "Casa 5");
    $endereco7 = new Endereco("Rua G", "Bairro T", "975", "98765-432", "Cidade G", "Estado GG", "Apto 407");
    $endereco8 = new Endereco("Rua H", "Bairro S", "531", "13579-246", "Cidade H", "Estado HH", "Casa 12");
    $endereco9 = new Endereco("Rua I", "Bairro R", "642", "12345-678", "Cidade I", "Estado II", "Apto 503");
    $endereco10 = new Endereco("Rua J", "Bairro Q", "753", "56789-012", "Cidade J", "Estado JJ", "Casa 8");


    //cria dentistas parceiros  (string $nome, string $email, int $telefone, string $cpf, Endereco $endereco, string $cro, array<Especialidades> $especialidades)
    $dentistaparceiro1 = new DentistaParceiro("Dr. Carlos Silva", "carlos@example.com", "1112223333", "11122233344",
    new Endereco("Rua A", "Bairro X", "123", "12345-678", "Cidade A", "Estado AA", "Apto 101"),
    "54321", ["Periodontia", "Endodontia"]);

    $dentistaparceiro2 = new DentistaParceiro("Dra. Marina Oliveira", "marina@example.com", "2223334444", "22233344455",
    new Endereco("Rua B", "Bairro Y", "456", "56789-012", "Cidade B", "Estado BB", "Casa 20"),
    "98765", ["Odontopediatria", "Ortodontia"]);

    $dentistaparceiro3 = new DentistaParceiro("Dr. Eduardo Santos", "eduardo@example.com", "3334445555", "33344455566",
    new Endereco("Rua D", "Bairro W", "246", "13579-246", "Cidade D", "Estado DD", "Casa 15"),
    "12345", ["Cirurgia Oral"]);
}


echo ":p";
