<?php

include_once "class.usuario.php";

class GerenciaLogin
{
    private static ?GerenciaLogin $sessao_atual = null;
    private static $usuario_logado = null;

    private function __construct($login, $senha)
    {
        $todos_usuarios_cadastrados = Usuario::getRecords();
        foreach ($todos_usuarios_cadastrados as $usuario) {
            if ($usuario->getLogin() == $login && $usuario->getSenha() == $senha) {
                self::$usuario_logado = $usuario;
                echo "\n";
                print("Usuario logou");
                echo "\n";
            }
        }
        if (self::$usuario_logado == null) {
            print("Não foi possivel logar, usuario ou senha inválidos.");
            echo "\n";
            self::$sessao_atual = null;
            self::$usuario_logado = null;
        }
    }

    static function Logout()
    {
        if (self::$sessao_atual != null) {
            echo "\n";
            print("Logout efetuado.");
            echo "\n";
            self::$sessao_atual = null;
            self::$usuario_logado = null;
        } else {
            print("Nenhum usuário em uso, impossível deslogar.");
            echo "\n";
        }
    }

    static function Login($login, $senha)
    {
        if (self::$sessao_atual == null) {
            self::$sessao_atual = new GerenciaLogin($login, $senha);
        } else {
            print("Desconecte da sessão atual para poder logar.");
            echo "\n";
        }
        return self::$sessao_atual;
    }

    static function getUsuarioLogado()
    {
        return self::$usuario_logado;
    }
}
