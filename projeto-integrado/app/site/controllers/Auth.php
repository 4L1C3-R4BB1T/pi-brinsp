<?php

namespace App\Site\controllers;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class Auth {

    private $dados;

    public function auth() {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($search)) {
            $pesquisa = new \App\site\Models\Carousel();
            $pesquisado = $pesquisa->pesquisa($search);
            $carregarView = new \Config\ConfigView("pesquisa/index", $pesquisado);
            $carregarView->renderizar();
            unset($search);
            exit;
        }
        if (isset($this->dados['sendLogin'])) {
            unset($this->dados['sendLogin']);
            $login = new \App\Site\models\Auth();
            $login->autenticar($this->dados);
            if ($login->getResult()) {
                $urlDestino = URL.'home/index';
                header("Location: $urlDestino");
            } else {
                $_SESSION['msg'] = $login->getMsg();
                $this->dados['formRetorno'] = $this->dados;
            }
        }
        $carregarView = new \Config\ConfigView("auth/login", $this->dados);
        $carregarView->renderizar();
    }

    public function logout() {
        $_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Usuário deslogado com sucesso!\", });</script>";
        unset($_SESSION['usuario_id'], $_SESSION['usuario_nome'], $_SESSION['usuario_email'],
        $_SESSION['usuario_imagem']);
        $urlDestino = URL.'home/index';
        header("Location: $urlDestino");
    }

}
