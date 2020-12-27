<?php

namespace App\adm\controllers;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class AdmPost {

    private $dados;
    private $id;

    public function index() {
        $botao = ['vis_post' => true, 'del_post' => true];
        $this->dados['botao'] = $botao;
        $listarProduto = new \App\adm\models\Galeria();
        $this->dados['listPost'] = $listarProduto->listarPost();
        $carregarView = new \Config\ConfigView("galeria/index", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function delPost($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $apagarPost = new \App\adm\Models\Galeria();
            $apagarPost->apagarPost($this->id);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um post!</div>";
        }
        $urlDestino = URL.'adm-post/index';
        header("Location: $urlDestino");
    }

    public function morePost($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $verPost = new \App\adm\Models\Galeria();
            $this->dados['dados_post'] = $verPost->verPost($this->id);
            $botao = ['list_post' => true, 'del_post' => true];
            $this->dados['botao'] = $botao;
            $carregarView = new \Config\ConfigView("galeria/morePost", $this->dados);
            $carregarView->renderizarAdm();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Post não encontrado!</div>";
            $urlDestino = URL.'adm-post/index';
            header("Location: $urlDestino");
        }
    }

}
