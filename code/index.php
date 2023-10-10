<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>qualquer coisa</title>

    <style>
        /* Estilo para parágrafos gerados com PHP */
        <?php
            $tamanhoParagrafo = "100px"; // Tamanho desejado para o parágrafo (pode ser definido dinamicamente)
            echo "p { font-size: $tamanhoParagrafo; }";
        ?>
    </style>

</head>
<body>
    <h1>
        <?php 
            include_once "class/class.dentistaparceiro.php";
            include_once "class/class.dentistafuncionario.php";
            include_once "class/class.cliente.php";
            include_once "class/class.paciente.php";
            include_once "class/class.secretaria.php";
            include_once "class/class.auxiliar.php";
            include_once "class/funct.txt.php";
        
        
            // cliente
            $anderson = new Cliente ("anderson", "anderson@gmail", "989043325", "mg213", "65464546");
        
            // pacientes
            $leo = $anderson->criarPaciente ("Leonardo de Sá", "leonardo@gmail", "982118390", "213", "18/09");

            echo "<br/>";

            $daniel = $anderson->criarPaciente ("Daniel", "daniel@gmail", "978516514", "sda", "10/09");
            
            echo "<br/>";

            echo linhaObjeto($leo);
        
            // especialidades da rizia
            $especialidades_rizia = array (new Especialidade("estética"), new Especialidade("cirurgia"), new Especialidade("limpeza"));
        
            // dentista
            $rizia = new DentistaFuncionario("Rízia Gonçalves Delgado", "rizia@gmail.com", "319890413122", "021939123", "rua sdasdasd", "MG 09321", $especialidades_rizia, 4000);
        ?>
    </h1>
    <p>paragrafo</p>
</body>
</html>