<?php

include_once "class/class.dentistaparceiro.php";
include_once "class/class.dentistafuncionario.php";
include_once "class/class.cliente.php";
include_once "class/class.paciente.php";
include_once "class/class.secretaria.php";
include_once "class/class.auxiliar.php";
include_once "class/class.formaPagamento.php";
include_once "class/class.perfil.php";
include_once "class/class.usuario.php";
include_once "class/persist.php";
include_once "class/container.php";
include_once "class/class.consultaavaliacao.php";
require_once "global.php";

//cria procedimentos (string $nome, float $valor, string $descricao)
$procedimento1 = new Procedimento("Limpeza", 200, "");
$procedimento2 = new Procedimento("Restauração", 185, "");
$procedimento3 = new Procedimento("Extração Comum", 280, "Não inclui dente siso.");
$procedimento4 = new Procedimento("Canal", 800, "");
$procedimento5 = new Procedimento("Extração de Siso", 400, "Valor por dente.");
$procedimento6 = new Procedimento("Clareamento a laser", 1700, "");
$procedimento7 = new Procedimento("Clareamento de moldeira", 900, "Clareamento caseiro.");

//cria especialidades (string $nome, array<Procedimentos> $procedimentospermitidos)
$especialidade1 = new Especialidade("Clínica Geral", [$procedimento1, $procedimento2, $procedimento3]);
$especialidade2 = new Especialidade("Endodontia", [$procedimento4]);
$especialidade3 = new Especialidade("Cirurgia", [$procedimento5]);
$especialidade4 = new Especialidade("Estética", [$procedimento6, $procedimento7]);

//dentista funcionario  (string $nome, string $email, string $telefone, string $cpf, Endereco $endereco, string $cro, array $especialidade, float $salario, Usuario $usuario)
$dentistafuncionario1 = new DentistaFuncionario("Ana Oliveira", "ana@example.com", "9876543210", "98765432109",
    new Endereco("Rua dos Flores", "Bairro Primavera", "456", "54321-987", "Cidade Alegre", "Estado AA", "Apto 202"), "98765432",
    [$especialidade1, $especialidade2, $especialidade3], 5000,
    new Usuario("anao", "abcdef", new Perfil())
);

//cria dentistas parceiros (string $nome, string $email, int $telefone, string $cpf, Endereco $endereco, string $cro, array<Especialidades> $especialidades)
$dentistaparceiro1 = new DentistaParceiro("Carlos Silva", "carlos@example.com", "1112223333", "11122233344",
    new Endereco("Rua A", "Bairro X", "123", "12345-678", "Cidade A", "Estado AA", "Apto 101"), "23123123",
    [$especialidade1, $especialidade4],
    new Usuario("carloss", "123456", new Perfil())
);

// cria clientes
$cliente1 = new Cliente("John Smith", "johnsmith@example.com", "1234567890", "123456789", "12345678901");

// cria paciententes
$paciente1 = new Paciente("Bob Smith", "bob@example.com", "5556667777", "9876543", new DateTime("1985-08-22"), $cliente1);


// consultas
$consultaavaliacao1 =  new ConsultaAvaliacao($paciente1, $dentistaparceiro1, new DateTime("06-11-2023 14:00"));
// $orcamento1 = new Orcamento();

$cliente1->aprovarOrcamento($orcamento1); //aprovaOrçamento vai fazer uma variavel do orçamento ser igual a 1

// $consultaexecucao1 = new ConsultaExecucao(); 
// $consultaexecucao2 = new ConsultaExecucao(); 
// $consultaexecucao3 = new ConsultaExecucao();

// $orcamento1->pagarorcamento("pix", 0.5)
// $orcamento1->pagarorcamento("cartao de credito 1/3", 0.5/3)
// $orcamento1->pagarorcamento("cartao de credito 2/3", 0.5/3)
// $orcamento1->pagarorcamento("cartao de credito 3/3", 0.5/3)

//resultadofincanceiro();


$pessoa = new pessoa("daniel", "gmail", "123");
$pessoa->Save();

// cria um cliente
//$anderson = new Cliente("anderson", "anderson@gmail", "989043325", "mg213", "65464546");
//$anderson->save();

//print_r(Cliente::getRecords());
//$clienteAnderson = Cliente::getRecordsByField("nome", "anderson");
//print_r($clienteAnderson);
//print_r($clienteAnderson[1]->getCpf());


echo ":p";
