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
require_once "global.php";


// cria clientes    (string $nome, string $email, int $telefone, string $rg, string $cpf)
$cliente1 = new Cliente("John Doe", "johndoe@example.com", "1234567890", "123456789", "12345678901");
$cliente2 = new Cliente("Jane Smith", "janesmith@example.com", "0987654321", "987654321", "09876543210");
$cliente3 = new Cliente("Mike Johnson", "mikejohnson@example.com", "5555555555", "555555555", "55555555555");

$pessoa = new pessoa("daniel", "gmail", "123");
$pessoa->Save();

// cria um cliente
$anderson = new Cliente("anderson", "anderson@gmail", "989043325", "mg213", "65464546");
$anderson->save();

//cria especialidades (string $nome, array<Procedimentos> $procedimentospermitidos)

//cria endereços ($rua, $bairro, $numero, $cep, $cidade, $estado, $complemento)
$endereco4 = new Endereco("Rua D", "Bairro W", "246", "13579-246", "Cidade D", "Estado DD", "Casa 15");
$endereco5 = new Endereco("Rua E", "Bairro V", "135", "98765-432", "Cidade E", "Estado EE", "Apto 202");
$endereco6 = new Endereco("Rua F", "Bairro U", "802", "24680-135", "Cidade F", "Estado FF", "Casa 5");
$endereco7 = new Endereco("Rua G", "Bairro T", "975", "98765-432", "Cidade G", "Estado GG", "Apto 407");
$endereco8 = new Endereco("Rua H", "Bairro S", "531", "13579-246", "Cidade H", "Estado HH", "Casa 12");
$endereco9 = new Endereco("Rua I", "Bairro R", "642", "12345-678", "Cidade I", "Estado II", "Apto 503");
$endereco10 = new Endereco("Rua J", "Bairro Q", "753", "56789-012", "Cidade J", "Estado JJ", "Casa 8");

$perfil = new Perfil();
$usuario_teste = new Usuario("nomeLogin", "senha", $perfil);

// dentista
$rizia = new DentistaFuncionario("Rízia Gonçalves Delgado", "rizia@gmail.com", "319890413122", "021939123", $endereco, "MG 09321", $especialidades_rizia, 4000, $usuario_teste);

$dentista_parceiro = new DentistaParceiro("dentista", "gmail", "123", "142", $endereco, "croo", $array_especialidades, $usuario_teste);
$dentista_parceiro->setPorcentagemEspecialidade($especilidade_estetica, "0.15");
$dentista_parceiro->calculaValorProcedimento($procedimento3);

$forma_pagamento = new FormaPagamento("dinheiro", "0", "0");
echo "<br>";
echo $forma_pagamento->getFormaPagamento();

$data = new datetime('2023-01-20');

$arrayProcedimentos = array($procedimento1, $procedimento2);

$cliente_responsavel = new Cliente("naiara", "gmail", "123", "200", "142");
$paciente = new Paciente("daniel", "gmail.com", "123", "200", new datetime('2023-01-20'), $cliente_responsavel);

$tratamento = new Tratamento($forma_pagamento, $paciente, $rizia, new datetime('2023-01-20'), $arrayProcedimentos);
echo "<br>";


//$tratamento->adicionaProcedimento($procedimento1);

//$procedimento3 = new Procedimento("clareamento", "1500", "clarear");
