<?php

include_once "class/class.dentista.php";
include_once "class/class.cliente.php";
include_once "class/class.paciente.php";
include_once "class/class.secretaria.php";
include_once "class/class.auxiliar.php";

echo "deu?\n";
$array_anderson = array();
$anderson = new Cliente ("anderson", "anderson@gmail", 989043325, "mg213", "65464546", $array_anderson);
$leonardo = new Paciente ("leonardo de sa", "leonardo@gmail", 982118390, "213", "18/09", $anderson);
echo $leonardo->getNome() . "\n";

// pego o nome do responsavel do leonardo
echo $leonardo->getResponsavel()->getNome();


?>