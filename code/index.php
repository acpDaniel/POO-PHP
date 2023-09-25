<?php

include_once "class/class.dentistaparceiro.php";
include_once "class/class.dentistafuncionario.php";
include_once "class/class.cliente.php";
include_once "class/class.paciente.php";
include_once "class/class.secretaria.php";
include_once "class/class.auxiliar.php";

echo "deu?\n";
$anderson = new Cliente ("anderson", "anderson@gmail", 989043325, "mg213", "65464546");
$leonardo = new Paciente ("leonardo de sa", "leonardo@gmail", 982118390, "213", "18/09", $anderson);
$leonardo = new Paciente ("daniel de sa", "daniel@gmail", 978516514, "sda", "10/09", $anderson);

// pego o nome do responsavel do leonardo
echo $leonardo->getResponsavel()->getNome() . "\n";

$pac = $anderson->getPacientes();
for($i = 0; $i < count($anderson->getPacientes()); $i++) {
    echo $pac[$i]->getNome() . "\n";
}


?>