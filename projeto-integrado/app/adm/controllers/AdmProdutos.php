<?php

namespace App\adm\controllers;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class AdmProdutos {

    private $dados;
    private $id;

    public function index() {
        $botao = ['vis_produto' => true, 'del_produto' => true];
        $this->dados['botao'] = $botao;
        $listarProduto = new \App\adm\models\Produtos();
        $this->dados['listProd'] = $listarProduto->listarProduto();
        $carregarView = new \Config\ConfigView("produtos/index", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function delProduto($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $apagarProduto = new \App\adm\Models\Produtos();
            $apagarProduto->apagarProduto($this->id);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um produto!</div>";
        }
        $urlDestino = URL.'adm-produtos/index';
        header("Location: $urlDestino");
    }

    public function moreProduto($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $verProduto = new \App\adm\Models\Produtos();
            $this->dados['dados_produto'] = $verProduto->verProduto($this->id);
            $botao = ['list_produto' => true, 'del_produto' => true];
            $this->dados['botao'] = $botao;
            $carregarView = new \Config\ConfigView("produtos/moreProduto", $this->dados);
            $carregarView->renderizarAdm();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Produto não encontrado!</div>";
            $urlDestino = URL.'adm-produtos/index';
            header("Location: $urlDestino");
        }
    }

}
