<?php

include_once "class/class.dentistaparceiro.php";
include_once "class/class.dentistafuncionario.php";
include_once "class/class.cliente.php";
include_once "class/class.paciente.php";
include_once "class/class.secretaria.php";
include_once "class/class.auxiliar.php";
include_once "class/class.formaPagamento.php";
include_once "class/funct.txt.php";


// cria um cliente
$anderson = new Cliente("anderson", "anderson@gmail", "989043325", "mg213", "65464546");

// cria dois pacientes
$leo = $anderson->criarPaciente("leonardo de sa", "leonardo@gmail", "982118390", "213", "18/09");
$daniel = $anderson->criarPaciente("daniel de sa", "daniel@gmail", "978516514", "sda", "10/09");

// especialidades da rizia
$especialidades_rizia = array(new Especialidade("estética"), new Especialidade("cirurgia"), new Especialidade("limpeza"));

// dentista
$rizia = new DentistaFuncionario("Rízia Gonçalves Delgado", "rizia@gmail.com", "319890413122", "021939123", "rua sdasdasd", "MG 09321", $especialidades_rizia, 4000);

$forma_pagamento = new FormaPagamento("dinheiro", "0", "0");
echo "<br>";
echo $forma_pagamento->getFormaPagamento();

$data = new datetime('2023-01-20');

$procedimento1 = new Procedimento("limpeza", "200", "limpar tudo");
$procedimento2 = new Procedimento("retirar siso", "500", "tirar os 4 dentes");
$arrayProcedimentos = array($procedimento1, $procedimento2);
//$procedimento3 = new Procedimento("clareamento", "1500", "clarear");


$cliente_responsavel = new Cliente("naiara", "gmail", "123", "200", "142");
$paciente = new Paciente("daniel", "gmail.com", "123", "200", "2021", $cliente_responsavel);

$tratamento = new Tratamento($forma_pagamento, new datetime('2023-01-20'), $paciente, $rizia, "2023", $arrayProcedimentos);
echo "<br>";
echo $tratamento->getData()->format('Y-m-d H:i:s');

//$tratamento->adicionaProcedimento($procedimento1);

$procedimento3 = new Procedimento("clareamento", "1500", "clarear");
$arrayProcedimentos = [];
$chaveSerializada = serialize($procedimento1);

$arrayProcedimentos[$chaveSerializada] = [
    'status' => "Em andamento",
    "data_conclusao" => new DateTime('0000-00-00 00:00:00'),
    'consultas' => []
];

echo $arrayProcedimentos[$chaveSerializada]['status'];
