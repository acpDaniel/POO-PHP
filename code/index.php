<?php

include_once "class/class.paciente.php";

echo "deu?\n";
$leonardo = new Paciente ("leonardo de sa", "leonardo@gmail", 178, "213", "18/09", "leonardo");
echo $leonardo->getNome();
?>