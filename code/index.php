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
include_once "class/class.funcionalidadesSistema.php";
require_once "global.php";


//PROVISORIO
$perfil_teste = new Perfil(
    "perfilTeste",
    ["cadastrarDentistaParceiro",
    "cadastrarDentistaFuncionario" ,
    "cadastrarProcedimento", 
    "cadastrarFormaPagamento", 
    "cadastrarPaciente", 
    "cadastrarEspecialidade", 
    "cadastrarPagamentoDoTratamento",
    "cadastrarCliente",
    "marcarConsultaAvaliacao",
    "marcarConsultaExecucao",
    "cadastrarOrcamento",
    "aprovarOrcamento"]
);
$usuario = new Usuario("login123", "senha123", $perfil_teste);
$profissional_logado = new Profissional("daniel", "gmail", "12345678", "142", new Endereco("Rua dos Flores", "Bairro Primavera", "456", "54321-987", "Cidade Alegre", "Estado AA", "Apto 202"), $usuario);
$funcionalidades_sistema = new FuncionalidadesSistema();


//Criação usuário 1 com perfil com acesso a todas menos Cadastrar Procedimento

//Criação usuário 2 com acesso a todas as funcionalidades

//Acesso funcionalidade sem login
    //resultado esperado -> exceção
//$funcionalidades_sistema->cadastrarProcedimento($profissional_logado, "Limpeza", 200, "");

//Login usuário 1

//Cadastro de procedimento com usuário 1
    //resultado esperado -> exceção
//$funcionalidades_sistema->cadastrarProcedimento($profissional_logado, "Limpeza", 200, "");

//Logout usuário 1

//Login usuário 2


//cria procedimentos (string $nome, float $valor, string $descricao)
$funcionalidades_sistema->cadastrarProcedimento($profissional_logado, "Limpeza", 200, "");
$funcionalidades_sistema->cadastrarProcedimento($profissional_logado, "Restauração", 185, "");
$funcionalidades_sistema->cadastrarProcedimento($profissional_logado, "Extração Comum", 280, "Não inclui dente siso.");
$funcionalidades_sistema->cadastrarProcedimento($profissional_logado, "Canal", 800, "");
$funcionalidades_sistema->cadastrarProcedimento($profissional_logado, "Extração de Siso", 400, "Valor por dente.");
$funcionalidades_sistema->cadastrarProcedimento($profissional_logado, "Clareamento a laser", 1700, "");
$funcionalidades_sistema->cadastrarProcedimento($profissional_logado, "Clareamento de moldeira", 900, "Clareamento caseiro.");

$procedimentos_cadastrados = Procedimento::getRecords();
print_r($procedimentos_cadastrados);
echo "<Br>";
echo "<Br>";


//Cria objetos das formas de pagamento
$funcionalidades_sistema->cadastrarFormaPagamento($profissional_logado, "Dinheiro à vista", 0, 0);
$funcionalidades_sistema->cadastrarFormaPagamento($profissional_logado, "Pix", 0, 0);
$funcionalidades_sistema->cadastrarFormaPagamento($profissional_logado, "Débito", 0, 0.03);
$funcionalidades_sistema->cadastrarFormaPagamento($profissional_logado, "Crédito de 1x", 1, 0.04);
$funcionalidades_sistema->cadastrarFormaPagamento($profissional_logado, "Crédito de 2x", 2, 0.04);
$funcionalidades_sistema->cadastrarFormaPagamento($profissional_logado, "Crédito de 3x", 3, 0.04);
$funcionalidades_sistema->cadastrarFormaPagamento($profissional_logado, "Crédito de 4x", 4, 0.07);
$funcionalidades_sistema->cadastrarFormaPagamento($profissional_logado, "Crédito de 5x", 5, 0.07);
$funcionalidades_sistema->cadastrarFormaPagamento($profissional_logado, "Crédito de 6x", 6, 0.07);

$formas_pagamento_cadastradas = FormaPagamento::getRecords();
print_r($formas_pagamento_cadastradas);
echo "<Br>";
echo "<Br>";

//cria especialidades (string $nome, array<Procedimentos> $procedimentospermitidos)
$funcionalidades_sistema->cadastrarEspecialidade(
    $profissional_logado, 
    "Clínica Geral", 
    [Procedimento::getRecordsByField("nome", "Limpeza")[0], 
    Procedimento::getRecordsByField("nome", "Restauração")[0], 
    Procedimento::getRecordsByField("nome", "Extração Comum")[0]]
);
$funcionalidades_sistema->cadastrarEspecialidade(
    $profissional_logado, 
    "Endodontia", 
    [Procedimento::getRecordsByField("nome", "Canal")[0]]
);
$funcionalidades_sistema->cadastrarEspecialidade(
    $profissional_logado, 
    "Cirurgia", 
    [Procedimento::getRecordsByField("nome", "Extração de Siso")[0]]
);
$funcionalidades_sistema->cadastrarEspecialidade(
    $profissional_logado, 
    "Estética", 
    [Procedimento::getRecordsByField("nome", "Clareamento a laser")[0], 
    Procedimento::getRecordsByField("nome", "Clareamento de moldeira")[0]]
);

$especialidades_cadastradas = Especialidade::getRecords();
print_r($especialidades_cadastradas);
echo "<Br>";
echo "<Br>";

//$pegar_tratamento = Tratamento::getRecords();
//echo $pegar_tratamento[0]->getPagamentosEfetuados()[0]->getDataPagamento();


// echo $tratamento->getid();
// echo "<Br>";
// echo $tratamento->getFormaPagamento()->getNomeFormaPagamento();
// echo "<Br>";
// echo $tratamento->getDentista()->getPorcentagemEspecialidade("Endodontia");


//Dentista funcionario  (string $nome, string $email, string $telefone, string $cpf, Endereco $endereco, string $cro, array $especialidade, float $salario, Usuario $usuario)
$funcionalidades_sistema->cadastrarDentistaFuncionario(
    $profissional_logado, 
    "Ana Oliveira",
    "ana@example.com",
    "9876543210",
    "98765432109",
    new Endereco("Rua dos Flores", "Bairro Primavera", "456", "54321-987", "Cidade Alegre", "Estado AA", "Apto 202"),
    "98765432",
    [Especialidade::getRecordsByField("nome", "Clínica Geral")[0], Especialidade::getRecordsByField("nome", "Endodontia")[0], Especialidade::getRecordsByField("nome", "Cirurgia")[0]],
    5000,
    new Usuario("anaoli", "abcdef", new Perfil("perfil1", ["a"]))
);

$dentistas_funcionarios_cadastrados = DentistaFuncionario::getRecords();
print_r($dentistas_funcionarios_cadastrados);
echo "<Br>";
echo "<Br>";

//Cria dentistas parceiros (string $nome, string $email, int $telefone, string $cpf, Endereco $endereco, string $cro, array<Especialidades> $especialidades)

$funcionalidades_sistema->cadastrarDentistaParceiro(
    $profissional_logado, 
    "Carlos Silva",
    "carlos@example.com",
    "1112223333",
    "11122233344",
    new Endereco("Rua A", "Bairro X", "123", "12345-678", "Cidade A", "Estado AA", "Apto 101"),
    "23123123",
    [Especialidade::getRecordsByField("nome", "Clínica Geral")[0], Especialidade::getRecordsByField("nome", "Estética")[0]],
    new Usuario("carlossil", "123456", new Perfil("perfil2", ["b"])),
    ["Clínica Geral" => 0.4,"Estética" => 0.4]
);

$dentistas_parceiros_cadastrados = DentistaParceiro::getRecords();
print_r($dentistas_parceiros_cadastrados);
echo "<Br>";
echo "<Br>";

//Cadastra cliente responsável financeiro do paciente
$funcionalidades_sistema->cadastrarCliente(
    $profissional_logado, 
    "John Smith", 
    "johnsmith@example.com", 
    "1234567890", 
    "123456789", 
    "12345678901"
);

$clientes_cadastrados = Cliente::getRecords();
print_r($clientes_cadastrados);
echo "<Br>";
echo "<Br>";

print_r (Cliente::getRecordsByField("cpf", "12345678901"));

//Cadastra paciente
$funcionalidades_sistema->cadastrarPaciente(
    $profissional_logado, 
    "Bob Smith", 
    "bob@example.com", 
    "5556667777", 
    "9876543", 
    new DateTime("1985-08-22"), 
    Cliente::getRecordsByField("cpf", "12345678901")[0]
);

$pacientes_cadastrados = Paciente::getRecords();
print_r($pacientes_cadastrados);
echo "<Br>";
echo "<Br>";

//Agendamento de uma consulta de avaliação
$funcionalidades_sistema->marcarConsultaAvaliacao(
    $profissional_logado, 
    Paciente::getRecordsByField("rg", "9876543")[0], 
    DentistaParceiro::getRecordsByField("cpf", "11122233344")[0], 
    new DateTime("06-11-2023 14:00")
);

$consultas_avaliacao_cadastradas = ConsultaAvaliacao::getRecords();
print_r($consultas_avaliacao_cadastradas);
echo "<Br>";
echo "<Br>";

//Criação de um orçamento a partir de uma consulta de avaliação
$funcionalidades_sistema->cadastrarOrcamento(
    $profissional_logado, 
    1,
    new DateTime("06-11-2023 14:00"),
    [Procedimento::getRecordsByField("nome", "Limpeza")[0], 
    Procedimento::getRecordsByField("nome", "Clareamento a laser")[0], 
    Procedimento::getRecordsByField("nome", "Restauração")[0], 
    Procedimento::getRecordsByField("nome", "Restauração")[0]],
    $funcionalidades_sistema->selecionarConsultasAvaliacao(Paciente::getRecordsByField("rg", "9876543")[0], new DateTime("06-11-2023 14:00")), 

);

$orcamentos_cadastrados = Orcamento::getRecords();
print_r($orcamentos_cadastrados);
echo "<Br>";
echo "<Br>";

//Criação de um tratamento a partir da aprovação do orçamento
$funcionalidades_sistema->aprovarOrcamento(
    $profissional_logado,
    1, 
    FormaPagamento::getRecordsByField("nome_forma_pagamento", "Pix")[0]
);

$tratamentos_cadastrados = Tratamento::getRecords();
print_r($tratamentos_cadastrados);
echo "<Br>";
echo "<Br>";

// //Agendamento das consultas de realização
$funcionalidades_sistema->marcarConsultaExecucao(
    $profissional_logado,
    1,
    DentistaParceiro::getRecordsByField("cpf", "11122233344")[0], 
    new DateTime("05-12-2023 15:00"), 
    "30 minutos", 
    Procedimento::getRecordsByField("nome", "Limpeza")[0]
);

$funcionalidades_sistema->marcarConsultaExecucao(
    $profissional_logado,
    1,
    DentistaParceiro::getRecordsByField("cpf", "11122233344")[0], 
    new DateTime("12-12-2023 09:00"), 
    "30 minutos", 
    Procedimento::getRecordsByField("nome", "Clareamento a laser")[0]
);

$funcionalidades_sistema->marcarConsultaExecucao(
    $profissional_logado,
    1,
    DentistaParceiro::getRecordsByField("cpf", "11122233344")[0], 
    new DateTime("20-12-2023 17:00"), 
    "60 minutos", 
    Procedimento::getRecordsByField("nome", "Restauração")[0]
);

$funcionalidades_sistema->marcarConsultaExecucao(
    $profissional_logado,
    1,
    DentistaParceiro::getRecordsByField("cpf", "11122233344")[0], 
    new DateTime("03-01-2024 14:00"), 
    "60 minutos", 
    Procedimento::getRecordsByField("nome", "Restauração")[0]
);

$consultas_execucao_cadastradas = ConsultaExecucao::getRecords();
print_r($consultas_execucao_cadastradas);
echo "<Br>";
echo "<Br>";

// //Adiciona os pagamentos
$funcionalidades_sistema->cadastrarPagamentoDoTratamento(
    $profissional_logado,
    1,
    FormaPagamento::getRecordsByField("nome_forma_pagamento", "Pix")[0], 
    $valor_total_pagamento,  
    $data_pagamento, 
    $taxa_imposto
);

$funcionalidades_sistema->cadastrarPagamentoDoTratamento(
    $profissional_logado,
    1,
    FormaPagamento::getRecordsByField("nome_forma_pagamento", "Crédito de 3x")[0], 
    $valor_total_pagamento,  
    $data_pagamento, 
    $taxa_imposto
);

$pagamentos_cadastrados = Pagamento::getRecords();
print_r($pagamentos_cadastrados);
echo "<Br>";
echo "<Br>";

// $pessoa = new pessoa("daniel", "gmail", "123");
// $pessoa->Save();

// $data = new DateTime('2023-11-16');

// setlocale(LC_TIME, 'pt_BR.utf-8', 'portuguese');

// $mesAno_do_pagamento = $data->format('m') . $data->format('Y');
// echo $mesAno_do_pagamento;






// echo ":p";
