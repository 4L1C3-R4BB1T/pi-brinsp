<?php

namespace App\adm\controllers;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class AdmEvento {
    
    private $dados;
    private $id;

    public function index() {
        $botao = ['vis_evento' => true, 'del_evento' => true];
        $this->dados['botao'] = $botao;
        $listarEvento = new \App\adm\models\Evento();
        $this->dados['listEven'] = $listarEvento->listarEvento();
        $carregarView = new \Config\ConfigView("evento/index", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function delEvento($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $apagarEvento = new \App\adm\Models\Evento();
            $apagarEvento->apagarEvento($this->id);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar um evento!</div>";
        }
        $urlDestino = URL.'adm-evento/index';
        header("Location: $urlDestino");
    }

    public function moreEvento($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $verEvento = new \App\adm\Models\Evento();
            $this->dados['dados_evento'] = $verEvento->verEvento($this->id);
            $botao = ['list_evento' => true, 'del_evento' => true];
            $this->dados['botao'] = $botao;
            $carregarView = new \Config\ConfigView("evento/moreEvento", $this->dados);
            $carregarView->renderizarAdm();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Evento não encontrado!</div>";
            $urlDestino = URL.'adm-evento/index';
            header("Location: $urlDestino");
        }
    }

}
