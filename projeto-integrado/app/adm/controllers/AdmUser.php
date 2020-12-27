<?php

namespace App\adm\controllers;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class AdmUser {

    private $dados;
    private $id;

    public function index() {
        $botao = ['vis_usuario' => true, 'del_usuario' => true];
        $this->dados['botao'] = $botao;
        $listarUsario = new \App\adm\models\User();
        $this->dados['listUser'] = $listarUsario->listarUsuario();
        $carregarView = new \Config\ConfigView("user/index", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function pedidos() {
        $botao = ['vis_pedido' => true, 'del_pedido' => true];
        $this->dados['botao'] = $botao;
        $listarPedido = new \App\adm\models\User();
        $this->dados['listPed'] = $listarPedido->listarPedido();
        $carregarView = new \Config\ConfigView("pedidos/index", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function delUser($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $apagarUsuario = new \App\adm\Models\User();
            $apagarUsuario->apagarUsuario($this->id);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um usuário!</div>";
        }
        $urlDestino = URL.'adm-user/index';
        header("Location: $urlDestino");
    }

    public function delPedido($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $apagarPedido = new \App\adm\Models\User();
            $apagarPedido->apagarPedido($this->id);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um pedido!</div>";
        }
        $urlDestino = URL.'adm-user/pedidos';
        header("Location: $urlDestino");
    }

    public function moreUser($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $verUsuario = new \App\adm\Models\User();
            $this->dados['dados_usuario'] = $verUsuario->verUsuario($this->id);
            $botao = ['list_usuario' => true, 'edit_usuario' => true, 'edit_senha' => true, 'del_usuario' => true];
            $this->dados['botao'] = $botao;
            $carregarView = new \Config\ConfigView("user/moreUser", $this->dados);
            $carregarView->renderizarAdm();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não encontrado!</div>";
            $urlDestino = URL.'adm-user/index';
            header("Location: $urlDestino");
        }
    }

    public function morePedido($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $verPedido = new \App\adm\Models\User();
            $this->dados['dados_pedido'] = $verPedido->verPedido($this->id);
            $botao = ['list_pedido' => true, 'del_pedido' => true];
            $this->dados['botao'] = $botao;
            $carregarView = new \Config\ConfigView("pedidos/morePedido", $this->dados);
            $carregarView->renderizarAdm();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Pedido não encontrado!</div>";
            $urlDestino = URL.'adm-user/pedidos';
            header("Location: $urlDestino");
        }
    }

}
