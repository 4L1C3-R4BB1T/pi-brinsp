<?php

namespace App\Site\models;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class Cadastro {

    private $result = false;
    private $tabela = 'usuario';

    public function addUsuario(array $dados) {
        $this->dados = $dados;
        $this->dados['data_criacao'] = date("Y-m-d H:i:s");
        $this->validarDados();
        if ($this->result) {
            $this->exeAddUsuario();
        }
    }

    private function validarDados() {
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)) {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro ao cadastrar: Os campos obrigatórios não foram preenchidos!\" });</script>";
        } else if (filter_var($this->dados['email'], FILTER_VALIDATE_EMAIL)) {
            if ((strcmp($this->dados['senha'], $this->dados['rsenha']) == 0)) {
                $this->dados['senha'] = password_hash($this->dados['senha'], PASSWORD_DEFAULT);
                $this->result = true;
                unset($this->dados['rsenha']);
            } else {
                $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro ao cadastrar: As senhas não correspondem!\" });</script>";
            }
        } else {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro ao cadastrar: O campo e-mail é inválido!\" });</script>";
        }
    }

    private function exeAddUsuario() {
        $inserir = new \Site\models\helper\ModelsCreate();
        $inserir->exeCreate($this->tabela, $this->dados);
        if ($inserir->getResult()) {
            $this->result = true;
            $_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Cadastrado realizado com sucesso!\" });</script>";
        } else {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Não cadastrado! Erro: {$inserir->getMsg()}\" });</script>";
        }
    }

    public function getResult() {
        return $this->result;
    }

}
