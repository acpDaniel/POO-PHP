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

//Criação usuário 1 com perfil com acesso a todas menos Cadastrar Procedimento

//Criação usuário 2 com acesso a todas as funcionalidades

//Acesso funcionalidade sem login
    //resultado esperado -> exceção

//Login usuário 1

//Cadastro de procedimento com usuário 1
    //resultado esperado -> exceção
$procedimentoLimpeza = new Procedimento("Limpeza", 200, "");

//Logout usuário 1

//Login usuário 2

//cria procedimentos (string $nome, float $valor, string $descricao)
$procedimentoLimpeza = new Procedimento("Limpeza", 200, "");
$procedimentoRestauracao = new Procedimento("Restauração", 185, "");
$procedimentoExtracaoComum = new Procedimento("Extração Comum", 280, "Não inclui dente siso.");
$procedimentoCanal = new Procedimento("Canal", 800, "");
$procedimentoExtracaoSiso = new Procedimento("Extração de Siso", 400, "Valor por dente.");
$procedimentoClareamentoLaser = new Procedimento("Clareamento a laser", 1700, "");
$procedimentoClareamentoMoldeira = new Procedimento("Clareamento de moldeira", 900, "Clareamento caseiro.");

//Cria objetos das formas de pagamento
$formapagDinheiro = new FormaPagamento("Dinheiro à vista", 0, 0);
$formapagPix = new FormaPagamento("Pix", 0, 0);
$formapagDebito = new FormaPagamento("Débito", 0, 0.03);
$formapagCreditoUm = new FormaPagamento("Crédito de 1x", 1, 0.04);
$formapagCreditoDois = new FormaPagamento("Crédito de 2x", 2, 0.04);
$formapagCreditoTres = new FormaPagamento("Crédito de 3x", 3, 0.04);
$formapagCreditoQuatro = new FormaPagamento("Crédito de 4x", 4, 0.07);
$formapagCreditoCinco = new FormaPagamento("Crédito de 5x", 5, 0.07);
$formapagCreditoSeis = new FormaPagamento("Crédito de 6x", 6, 0.07);

//cria especialidades (string $nome, array<Procedimentos> $procedimentospermitidos)
$especialidadeClinicoGeral = new Especialidade("Clínica Geral", [$procedimentoLimpeza, $procedimentoRestauracao, $procedimentoExtracaoComum]);
$especialidadeEndontia = new Especialidade("Endodontia", [$procedimentoCanal]);
$especialidadeCirurgia = new Especialidade("Cirurgia", [$procedimentoExtracaoSiso]);
$especialidadeEstetica = new Especialidade("Estética", [$procedimentoClareamentoLaser, $procedimentoClareamentoMoldeira]);

//dentista funcionario  (string $nome, string $email, string $telefone, string $cpf, Endereco $endereco, string $cro, array $especialidade, float $salario, Usuario $usuario)
$dentistafuncionarioAnaOliveira = new DentistaFuncionario(
    "Ana Oliveira",
    "ana@example.com",
    "9876543210",
    "98765432109",
    new Endereco("Rua dos Flores", "Bairro Primavera", "456", "54321-987", "Cidade Alegre", "Estado AA", "Apto 202"),
    "98765432",
    [$especialidadeClinicoGeral, $especialidadeEndontia, $especialidadeCirurgia],
    5000,
    new Usuario("anao", "abcdef", new Perfil("perfil1", ["a"]))
);

//cria dentistas parceiros (string $nome, string $email, int $telefone, string $cpf, Endereco $endereco, string $cro, array<Especialidades> $especialidades)
$dentistaparceiroCarlosSilva = new DentistaParceiro(
    "Carlos Silva",
    "carlos@example.com",
    "1112223333",
    "11122233344",
    new Endereco("Rua A", "Bairro X", "123", "12345-678", "Cidade A", "Estado AA", "Apto 101"),
    "23123123",
    [$especialidadeClinicoGeral => 0.4, $especialidadeEstetica => 0.4],
    new Usuario("carloss", "123456", new Perfil("perfil2", ["b"]))
);

//Cadastra cliente
$clienteJohnSmith = new Cliente("John Smith", "johnsmith@example.com", "1234567890", "123456789", "12345678901");

//Cadastra paciente dependente financeiro do cliente acima
$pacienteBobSmith = new Paciente("Bob Smith", "bob@example.com", "5556667777", "9876543", new DateTime("1985-08-22"), $clienteJohnSmith);

//Agendamento de uma consulta de avaliação
$consultaavaliacaoBobSmith =  new ConsultaAvaliacao($pacienteBobSmith, $dentistaparceiroCarlosSilva, new DateTime("06-11-2023 14:00"));

//Criação de um orçamento a partir de uma consulta de avaliação
$orcamentoBobSmith = $consultaavaliacaoBobSmith->criaOrcamento($consultaavaliacaoBobSmith->getDataHorario(), [$procedimentoLimpeza, $procedimentoClareamentoLaser, $procedimentoRestauracao, $procedimentoRestauracao]);

//Criação de um tratamento a partir da aprovação do orçamento
$tratamentoBobSmith = $orcamentoBobSmith->aprovarOrcamento($formapagPix);

//Agendamento das consultas de realização
$tratamentoBobSmith->agendaConsulta($dentistafuncionarioAnaOliveira, new DateTime("05-12-2023 15:00"), "30 minutos", $procedimentoLimpeza); 
$tratamentoBobSmith->agendaConsulta($dentistafuncionarioAnaOliveira, new DateTime("12-12-2023 09:00"), "30 minutos", $procedimentoClareamentoLaser); 
$tratamentoBobSmith->agendaConsulta($dentistaparceiroCarlosSilva, new DateTime("20-12-2023 17:00"), "60 minutos", $procedimentoRestauracao); 
$tratamentoBobSmith->agendaConsulta($dentistaparceiroCarlosSilva, new DateTime("03-01-2024 14:00"), "60 minutos", $procedimentoRestauracao); 

//Adiciona os pagamentos
//$tratamentoBobSmith->adicionaPagamentoEfetuado();
//$tratamentoBobSmith->adicionaPagamentoEfetuado();

$pessoa = new pessoa("daniel", "gmail", "123");
$pessoa->Save();

$data = new DateTime('2023-11-16');

setlocale(LC_TIME, 'pt_BR.utf-8', 'portuguese');

$mesAno_do_pagamento = $data->format('m') . $data->format('Y');
echo $mesAno_do_pagamento;






echo ":p";
