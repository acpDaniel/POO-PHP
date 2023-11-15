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

// cria paciententes    (string $nome, string $email, int $telefone, string $rg, Datetime $data_nascimento, Cliente $cliente_responsavel)
$paciente1 = new Paciente("Alice Johnson", "alice@example.com", "9876543210", "7654321", new DateTime("1990-05-15"), $cliente1);
$paciente2 = new Paciente("Bob Smith", "bob@example.com", "5556667777", "9876543", new DateTime("1985-08-22"), $cliente1);
$paciente3 = new Paciente("Charlie Brown", "charlie@example.com", "1112223333", "1234567", new DateTime("1998-03-10"), $cliente3);
$paciente4 = new Paciente("Diana Wilson", "diana@example.com", "9998887777", "8765432", new DateTime("1980-11-28"), $cliente2);
$paciente5 = new Paciente("Eva Davis", "eva@example.com", "3334445555", "2345678", new DateTime("1995-09-05"), $cliente3);

//cria procedimentos (string $nome, float $valor, string $descricao)
$procedimento1 = new Procedimento("Consulta Odontológica", 150.00, "Exame clínico e avaliação radiográfica.");
$procedimento2 = new Procedimento("Limpeza Dentária", 80.00, "Remoção de placa bacteriana e tártaro, polimento dental.");
$procedimento3 = new Procedimento("Extração Dentária", 200.00, "Remoção de dente devido a cárie, trauma ou doença periodontal.");
$procedimento4 = new Procedimento("Restauração Dentária", 120.00, "Preenchimento de cavidades com resinas ou amálgama.");
$procedimento5 = new Procedimento("Tratamento de Canal", 350.00, "Remoção da polpa infectada, selamento e preenchimento do canal radicular.");
$procedimento6 = new Procedimento("Coroas e Pontes", 500.00, "Colocação de coroa para cobrir e proteger dente danificado. Colocação de ponte para substituir dente ausente.");
$procedimento7 = new Procedimento("Implantes Dentários", 1200.00, "Inserção de implante de titânio no osso maxilar para substituir raiz dentária ausente.");
$procedimento8 = new Procedimento("Ortodontia", 2500.00, "Uso de aparelhos ortodônticos para corrigir problemas de alinhamento dentário e mordida.");
$procedimento9 = new Procedimento("Periodontia", 180.00, "Tratamento de doenças periodontais, incluindo raspagem e alisamento radicular.");
$procedimento10 = new Procedimento("Clareamento Dental", 200.00, "Procedimentos para clarear dentes, removendo manchas e descolorações.");
$procedimento11 = new Procedimento("Odontopediatria", 100.00, "Cuidados odontológicos específicos para crianças.");
$procedimento12 = new Procedimento("Cirurgia Oral", 800.00, "Procedimentos cirúrgicos, como remoção de dentes do siso, cirurgia ortognática, entre outros.");
$procedimento13 = new Procedimento("Próteses Dentárias", 600.00, "Confecção e ajuste de próteses dentárias removíveis ou fixas.");
$procedimento14 = new Procedimento("Aparelhos Bucais (Odontologia do Sono)", 350.00, "Tratamento de distúrbios do sono, como apneia obstrutiva do sono, com o uso de aparelhos bucais.");
$procedimento15 = new Procedimento("Botox Odontológico", 400.00, "Uso de toxina botulínica para tratamento de bruxismo, sorriso gengival, entre outros.");

//cria especialidades (string $nome, array<Procedimentos> $procedimentospermitidos)
$especialidade1 = new Especialidade("Odontologia Geral", [
    $procedimento1, $procedimento2, $procedimento3, $procedimento4,
    $procedimento5, $procedimento6, $procedimento7, $procedimento8,
    $procedimento9, $procedimento10, $procedimento11, $procedimento12,
    $procedimento13, $procedimento14, $procedimento15
]);
$especialidade2 = new Especialidade("Ortodontia", [$procedimento8, $procedimento9]);
$especialidade3 = new Especialidade("Periodontia", [$procedimento9]);
$especialidade4 = new Especialidade("Cirurgia Oral", [$procedimento3, $procedimento12]);
$especialidade5 = new Especialidade("Implantodontia", [$procedimento7]);
$especialidade6 = new Especialidade("Odontopediatria", [$procedimento11]);
$especialidade7 = new Especialidade("Endodontia", [$procedimento5, $procedimento5, $procedimento5]);
$especialidade8 = new Especialidade("Dentística Restauradora", [$procedimento4, $procedimento4, $procedimento6, $procedimento6,                 $procedimento6]);
$especialidade9 = new Especialidade("Prótese Dentária", [$procedimento6, $procedimento6, $procedimento13]);
$especialidade10 = new Especialidade("Odontologia Estética", [$procedimento10, $procedimento6, $procedimento6, $procedimento6]);
$especialidade11 = new Especialidade("Odontologia do Sono", [$procedimento14, $procedimento12]);
$especialidade12 = new Especialidade("Odontologia Preventiva", [$procedimento15, $procedimento10, $procedimento2]);

//cria endereços ($rua, $bairro, $numero, $cep, $cidade, $estado, $complemento)
$endereco4 = new Endereco("Rua D", "Bairro W", "246", "13579-246", "Cidade D", "Estado DD", "Casa 15");
$endereco5 = new Endereco("Rua E", "Bairro V", "135", "98765-432", "Cidade E", "Estado EE", "Apto 202");
$endereco6 = new Endereco("Rua F", "Bairro U", "802", "24680-135", "Cidade F", "Estado FF", "Casa 5");
$endereco7 = new Endereco("Rua G", "Bairro T", "975", "98765-432", "Cidade G", "Estado GG", "Apto 407");
$endereco8 = new Endereco("Rua H", "Bairro S", "531", "13579-246", "Cidade H", "Estado HH", "Casa 12");
$endereco9 = new Endereco("Rua I", "Bairro R", "642", "12345-678", "Cidade I", "Estado II", "Apto 503");
$endereco10 = new Endereco("Rua J", "Bairro Q", "753", "56789-012", "Cidade J", "Estado JJ", "Casa 8");

//cria dentistas parceiros (string $nome, string $email, int $telefone, string $cpf, Endereco $endereco, string $cro, array<Especialidades> $especialidades)
$dentistaparceiro1 = new DentistaParceiro("Dr. Carlos Silva", "carlos@example.com", "1112223333", "11122233344",
new Endereco("Rua A", "Bairro X", "123", "12345-678", "Cidade A", "Estado AA", "Apto 101"), "23123123", [$especialidade1, $especialidade2],
new Usuario()); //editar aq

/*
$dentistaparceiro2 = new DentistaParceiro("Dra. Marina Oliveira", "marina@example.com", "2223334444", "22233344455",
new Endereco("Rua B", "Bairro Y", "456", "56789-012", "Cidade B", "Estado BB", "Casa 20"),
"98765", ["Odontopediatria", "Ortodontia"]);

$dentistaparceiro3 = new DentistaParceiro("Dr. Eduardo Santos", "eduardo@example.com", "3334445555", "33344455566",
new Endereco("Rua D", "Bairro W", "246", "13579-246", "Cidade D", "Estado DD", "Casa 15"),
"12345", ["Cirurgia Oral"]);
