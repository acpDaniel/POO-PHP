<?php

    include_once "class/class.dentistaparceiro.php";
    include_once "class/class.dentistafuncionario.php";
    include_once "class/class.cliente.php";
    include_once "class/class.paciente.php";
    include_once "class/class.secretaria.php";
    include_once "class/class.auxiliar.php";
    include_once "class/funct.txt.php";

    // cria um cliente
    $anderson = new Cliente ("anderson", "anderson@gmail", "989043325", "mg213", "65464546");

    // cria dois pacientes
    $leo = $anderson->criarPaciente ("leonardo de sa", "leonardo@gmail", "982118390", "213", "18/09");
    $daniel = $anderson->criarPaciente ("daniel de sa", "daniel@gmail", "978516514", "sda", "10/09");

    // especialidades da rizia
    $especialidades_rizia = array (new Especialidade("estética"), new Especialidade("cirurgia"), new Especialidade("limpeza"));

    // dentista
    $rizia = new DentistaFuncionario("Rízia Gonçalves Delgado", "rizia@gmail.com", "319890413122", "021939123", "rua sdasdasd", "MG 09321", $especialidades_rizia, 4000);

?>