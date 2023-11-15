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


$pessoa = new pessoa("daniel", "gmail", "123");
$pessoa->Save();

// cria um cliente
$anderson = new Cliente("anderson", "anderson@gmail", "989043325", "mg213", "65464546");
$anderson->save();

// especialidades da rizia
$especialidades_rizia = array(new Especialidade("estética"), new Especialidade("cirurgia"), new Especialidade("limpeza"));

$endereco = new Endereco("catalao", "123", "30", "1456", "bh", "mg", "casa");

$perfil = new Perfil();
$usuario_teste = new Usuario("nomeLogin", "senha", $perfil);

// dentista
$rizia = new DentistaFuncionario("Rízia Gonçalves Delgado", "rizia@gmail.com", "319890413122", "021939123", $endereco, "MG 09321", $especialidades_rizia, 4000, $usuario_teste);

$procedimento1 = new Procedimento("limpeza", "200", "limpar tudo");
$procedimento2 = new Procedimento("retirar siso", "500", "tirar os 4 dentes");
$procedimento3 = new Procedimento("clareamento", "1500", "clarear");

$especilidade_estetica = new Especialidade("estética");
$especilidade_estetica->adicionarProcedimento($procedimento1);
$especilidade_estetica->adicionarProcedimento($procedimento2);

$especialidade_cirurgia = new Especialidade("cirurgia");

$array_especialidades = array();
$array_especialidades[] = $especilidade_estetica;
$array_especialidades[] = $especialidade_cirurgia;

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
