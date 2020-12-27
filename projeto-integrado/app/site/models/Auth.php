<?php

namespace App\Site\models;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class Auth {

    private $dados;
    private $result;
    private $msg;
    private $rowCount;
    private $tabela = 'usuario';

    public function autenticar(array $dados) {
        $this->dados = $dados;
        $this->validar();
        if ($this->result) {
            $validarAcesso = new \Site\models\helper\ModelsRead();
            $validarAcesso->exeReadEspecifico(
                "SELECT u.*
                FROM {$this->tabela} u
                WHERE u.email = :email 
                LIMIT :limit", "email={$this->dados['email']}&limit=1");
            $this->result = $validarAcesso->getResult();
            if ($validarAcesso->getRowCount() == 1) {
                $this->validarSenha();
            } else {
                $this->result = false;
                $this->msg = "<script>swal({ icon: \"error\",  title: \"Login e/ou senha incorretos!\" });</script>";
            }
        }
    }

    public function validar() {
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)) {
            $this->result = false;
            $this->msg = "<script>swal({ icon: \"error\",  title: \"Login e/ou senha incorretos!\" });</script>";
        } else {
            $this->result = true;
        }
    }

    private function validarSenha() {
        if (password_verify($this->dados['senha'], $this->result[0]['senha'])) {
            $_SESSION['usuario_id'] = $this->result[0]['id'];
            $_SESSION['usuario_nome'] = $this->result[0]['nome'];
            $_SESSION['usuario_email'] = $this->result[0]['email'];
            $_SESSION['usuario_imagem'] = $this->result[0]['imagem'];
            $this->result = true;
        } else {
            $this->msg = "<script>swal({ icon: \"error\",  title: \"Email e/ou senha incorretos!\" });</script>";
            $this->result = false;
        }
    }

    function getResult() {
        return $this->result;
    }

    function getMsg() {
        return $this->msg;
    }

    function getRowCount() {
        return $this->rowCount;
    }
    
}
