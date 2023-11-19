<?php
require_once("persist.php");
require_once("class.profissional.php");
require_once("class.tratamento.php");
class FuncionalidadesSistema extends persist
{
    private $imposto_da_clinica = 0.2;
    static $local_filename = "funcionalidades.txt";

    public function __construct()
    {
    }

    static public function getFilename()
    {
        return get_called_class()::$local_filename;
    }

    public function getImpostoDaClinica()
    {
        return $this->imposto_da_clinica;
    }

    public function validaPermissao($nome_funcionalidade, Profissional $profissional_logado)
    {
        // array de funcionalidades permitidas obtida do perfil do profissional
        $funcionalidades_permitidas_usuario_logado = $profissional_logado->getUsuario()->getPerfil()->getFuncionalidadesPermitidas();

        // verificar que a funcionalidade é permitida para o usuario 
        if (in_array($nome_funcionalidade, $funcionalidades_permitidas_usuario_logado)) {
            return true;
        } else {
            return false;
        }
    }

    public function calcularResultadoMensal(Datetime $data_inicio_mes, Datetime $data_final_mes)
    {
        // valida se as datas sao do mesmo ano e mes
        if (!($data_inicio_mes->format('Y-m') === $data_final_mes->format('Y-m'))) {
            echo 'As datas não correspondem ao mesmo ano e mês.';
            return;
        }

        // pegar o mesAno em portugues
        setlocale(LC_TIME, 'pt_BR.utf-8', 'portuguese');
        $mesAno = strftime('%B', $data_inicio_mes->getTimestamp()) . $data_inicio_mes->format('Y');

        $lista_tratamentos = Tratamento::getRecords();
        $receita_total_tratamentos_mes = 0;
        // pegar a receita dos pagamentos que foram feitos naquele mes
        foreach ($lista_tratamentos as $tratamento) {
            $receita_total_tratamentos_mes += $tratamento->caculaReceita($data_inicio_mes, $data_final_mes);
        }

        // pegar despesas com dentistas parceiro
        $lista_dentistas_parceiro = DentistaParceiro::getRecords();
        $salario_total_dentistas_parceiro_mes = 0;
        foreach ($lista_dentistas_parceiro as $dentista_parceiro) {
            $salario_total_dentistas_parceiro_mes += $dentista_parceiro->getSalarioMesAno($mesAno);
        }

        // pegar despesas com dentistas funcionario
        $lista_dentistas_funcionario = DentistaFuncionario::getRecords();
        $salario_total_dentistas_funcionario_mes = 0;
        foreach ($lista_dentistas_funcionario as $dentista_funcionario) {
            $salario_total_dentistas_funcionario_mes += $dentista_funcionario->getSalario();
        }

        return ($receita_total_tratamentos_mes - $salario_total_dentistas_parceiro_mes - $salario_total_dentistas_funcionario_mes);
    }

    public function cadastrarProcedimento($profissional_logado, $nome, $valor, $descricao)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novoProcedimento = new Procedimento($nome, $valor, $descricao);
        $novoProcedimento->save();
    }

    public function cadastrarPagamentoDoTratamento($profissional_logado, $id, $forma_pagamento, $valor_total_pagamento,  $data_pagamento, $taxa_imposto)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            echo "nao foi permitido";
            return;
        }
        $novo_pagamento = new Pagamento($forma_pagamento, $valor_total_pagamento,  $data_pagamento, $taxa_imposto);
        $lista_tratamentos_possiveis = Tratamento::getRecords();
        $objeto_alvo_modificacao = null;
        // encontrar o tratamento que devemos alterar
        echo "entrou aqui";
        foreach ($lista_tratamentos_possiveis as $tratamento_possivel) {
            if ($tratamento_possivel->getId() === $id) {
                echo "achou";
                $objeto_alvo_modificacao = $tratamento_possivel;
            }
        }
        $objeto_alvo_modificacao->adicionaPagamentoEfetuado($novo_pagamento);
        $objeto_alvo_modificacao->save();
    }


    public function cadastrarPaciente($profissional_logado, $nome, $email, $telefone, $rg, $data_nascimento, Cliente $cliente_responsavel)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novoPaciente = new Paciente($nome,  $email, $telefone, $rg, $data_nascimento, $cliente_responsavel);
        $novoPaciente->save();
    }

    public function cadastrarCliente($profissional_logado, $nome, $email, $telefone, $rg, $cpf)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novoCliente = new Cliente($nome, $email, $telefone, $rg, $cpf);
        $novoCliente->save();
    }

    public function marcarConsultaAvaliacao($profissional_logado, $paciente, $dentista_executor, $data_horario)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novaConsultaAvaliacao = new ConsultaAvaliacao($paciente, $dentista_executor, $data_horario);
        $novaConsultaAvaliacao->save();
    }

    public function marcarConsultaExecucao($profissional_logado, $id_tratamento, $dentista_executor, Datetime $dataehorario, $duracao_consulta, $procedimento)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        try {
            $tratamento_certo = Tratamento::getRecordsByField("id", $id_tratamento)[0];
            $tratamento_certo->agendaConsulta($dentista_executor, $dataehorario, $duracao_consulta, $procedimento);
            $tratamento_certo->save();
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }

    public function cadastrarOrcamento($profissional_logado, $id, Datetime $data, array $procedimentos, ConsultaAvaliacao $consulta_avaliacao)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        try {
            $novoOrcamento = $consulta_avaliacao->criaOrcamento($id, $data, $procedimentos);
            $novoOrcamento->save();
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }

    public function aprovarOrcamento($profissional_logado, $id, $forma_pagamento_proposto)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $lista_orcamentos_possiveis = Orcamento::getRecords();
        $objeto_alvo_modificacao = null;
        // encontrar o tratamento que devemos alterar
        foreach ($lista_orcamentos_possiveis as $orcamento_possivel) {
            if ($orcamento_possivel->getId() == $id) {
                $objeto_alvo_modificacao = $orcamento_possivel;
            }
        }
        $objeto_alvo_modificacao->aprovarOrcamento($forma_pagamento_proposto);
    }

    public function cadastrarEspecialidade($profissional_logado, $nome, $procedimentos_permitidos)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novaEspecialidade = new Especialidade($nome, $procedimentos_permitidos);
        $novaEspecialidade->save();
    }

    public function cadastrarFormaPagamento($profissional_logado, $nome_forma_pagamento, $numero_parcelas, $taxa_pagamento)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novoFormaPagamento = new FormaPagamento($nome_forma_pagamento, $numero_parcelas, $taxa_pagamento);
        $novoFormaPagamento->save();
    }

    public function cadastrarDentistaParceiro($profissional_logado, $nome, $email, $telefone, $cpf, $endereco, $cro, $especialidades, Usuario $usuario, $especialidades_porcentagem)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novoDentistaParceiro = new DentistaParceiro($nome, $email, $telefone, $cpf, $endereco, $cro, $especialidades, $usuario, $especialidades_porcentagem);
        $novoDentistaParceiro->save();
    }

    public function cadastrarDentistaFuncionario($profissional_logado, $nome, $email, $telefone, $cpf, $endereco, $cro, $especialidade, $salario, $usuario)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novoDentistaFuncionario = new DentistaFuncionario($nome, $email, $telefone, $cpf, $endereco, $cro, $especialidade, $salario, $usuario);
        $novoDentistaFuncionario->save();
    }

    public function cadastrarProfissional($profissional_logado, $nome, $email, $telefone, $cpf, $endereco, $usuario)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novoProfissional = new Profissional($nome, $email, $telefone, $cpf, $endereco, $usuario);
        $novoProfissional->save();
    }

    public function cadastrarPerfil($profissional_logado, $nome_perfil, $funcionalidades_permitidas)
    {
        if (!$this->validaPermissao(__FUNCTION__, $profissional_logado)) {
            return;
        }
        $novoPerfil = new Perfil($nome_perfil, $funcionalidades_permitidas);
        $novoPerfil->save();
    }

    public function selecionarConsultasAvaliacao(Paciente $paciente, DateTime $dataehorario)
    {
        $todas_consultas_avaliacao = ConsultaAvaliacao::getRecords();
        foreach ($todas_consultas_avaliacao as $consulta_avaliacao) {
            if ($consulta_avaliacao->getPaciente()->getRG() == $paciente->getRG() && $consulta_avaliacao->getDataHorario() == $dataehorario) {
                return $consulta_avaliacao;
            }
            echo $consulta_avaliacao->getPaciente()->getNome();
        }
    }
}
