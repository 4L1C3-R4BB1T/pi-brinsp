<?php

namespace App\adm\models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class User {

    private $result;
    private $limiteResultado = 40;
    private $id;
    private $dados;

    public function listarUsuario() {
        $listarUsuario = new \App\adm\Models\helper\ModelsRead();
        $listarUsuario->exeReadEspecifico(
            "SELECT u.id, u.nome, u.email
            FROM usuario u
            ORDER BY u.id DESC 
            LIMIT :limit", "&limit={$this->limiteResultado}");
        $this->result = $listarUsuario->getResult();
        return $this->result;
    }

    public function listarPedido() {
        $listarPedido = new \App\adm\Models\helper\ModelsRead();
        $listarPedido->exeReadEspecifico(
            "SELECT c.*
            FROM compra c                
			ORDER BY c.id DESC 
            LIMIT :limit", "&limit={$this->limiteResultado}");
        $this->result = $listarPedido->getResult();
        return $this->result;
    }

    public function verUsuario($id) {
        $this->id = (int) $id;
        $verPerfil = new \App\adm\Models\helper\ModelsRead();
        $verPerfil->exeReadEspecifico(
            "SELECT u.*
            FROM usuario u
            WHERE u.id = :id 
            LIMIT :limit", "id={$this->id}&limit=1");
        $this->result = $verPerfil->getResult();
        return $this->result;
    }

    public function verPedido($id) {
        $this->id = (int) $id;
        $verProd = new \App\adm\Models\helper\ModelsRead();
        $verProd->exeReadEspecifico(
            "SELECT c.*, p.descricao
            FROM compra c, pagamento p
            WHERE c.id =:id 
    			AND p.id = c.pagamento 
            LIMIT :limit", "id={$this->id}&limit=1");
        $this->result = $verProd->getResult();
        return $this->result;
    }

    public function apagarUsuario($id = null) {
        $this->id = (int) $id;
        $this->confirmarUser();
        if ($this->dados) {
            $apagarUsuario = new \App\adm\Models\helper\ModelsDelete();
            $apagarUsuario->exeDelete("usuario", "WHERE id =:id", "id={$this->id}");
            if ($apagarUsuario->getResult()) {
                $apagarImg = new \App\adm\Models\helper\ModelsDelete();
                $apagarImg->apagarImg('assets/img/usuario/'.$this->id.'/'.$this->dados[0]['imagem'], 'assets/img/usuario/'.$this->id);
                $_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Usuário excluído com sucesso!\" });</script>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Usuário não excluído!\" });</script>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Usuário não excluído!\" });</script>";
            $this->result = false;
        }
    }

    public function apagarPedido($id = null) {
        $this->id = (int) $id;
        $this->confirmarPedido();
        if ($this->dados) {
            $apagarPedido = new \App\adm\Models\helper\ModelsDelete();
            $apagarPedido->exeDelete("compra", "WHERE id =:id", "id={$this->id}");
            if ($apagarPedido->getResult()) {
                $_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Pedido excluído com sucesso!\" });</script>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Pedido não excluído!\" });</script>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Pedido não excluído!\" });</script>";
            $this->result = false;
        }
    }

    public function confirmarUser() {
        $verUsuario = new \App\adm\Models\helper\ModelsRead();
        $verUsuario->exeReadEspecifico(
            "SELECT u.imagem 
			FROM usuario u
            WHERE u.id = :id 
            LIMIT :limit", "id={$this->id}&limit=1");
        $this->dados = $verUsuario->getResult();
    }

    public function confirmarPedido() {
        $verPedido = new \App\adm\Models\helper\ModelsRead();
        $verPedido->exeReadEspecifico(
            "SELECT c.nome 
			FROM compra c
            WHERE c.id = :id 
            LIMIT :limit", "id={$this->id}&limit=1");
        $this->dados = $verPedido->getResult();
    }

    function getResult() {
        return $this->result;
    }

}
