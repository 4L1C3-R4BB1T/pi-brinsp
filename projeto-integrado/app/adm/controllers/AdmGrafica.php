<?php

namespace App\adm\controllers;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class AdmGrafica {

    private $dados;
    private $id;

    public function index() {
        $botao = ['cad_grafica' => true, 'vis_grafica' => true, 'del_grafica' => true];
        $this->dados['botao'] = $botao;
        $listarGrafica = new \App\adm\models\Grafica();
        $this->dados['listGraf'] = $listarGrafica->listarGrafica();
        $carregarView = new \Config\ConfigView("graficas/index", $this->dados);
        $carregarView->renderizarAdm();
    }

    public function delGrafica($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $apagarGrafica = new \App\adm\Models\Grafica();
            $apagarGrafica->apagarGrafica($this->id);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário selecionar uma gráfica!</div>";
        }
        $urlDestino = URL . 'adm-grafica/index';
        header("Location: $urlDestino");
    }

    public function moreGrafica($id = null) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $verGrafica = new \App\adm\Models\Grafica();
            $this->dados['dados_grafica'] = $verGrafica->verGrafica($this->id);
            $botao = ['list_grafica' => true, 'del_grafica' => true];
            $this->dados['botao'] = $botao;
            $carregarView = new \Config\ConfigView("graficas/moreGrafica", $this->dados);
            $carregarView->renderizarAdm();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Gráfica não encontrada!</div>";
            $urlDestino = URL.'adm-grafica/index';
            header("Location: $urlDestino");
        }
    }

    public function addGrafica() {
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dados['CadGrafica'])) {
            unset($this->dados['CadGrafica']);
            $this->dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
            $cadGrafica = new \App\adm\Models\Grafica();
            $cadGrafica->cadGrafica($this->dados);
            if ($cadGrafica->getResult()) {
                $urlDestino = URL.'adm-grafica/index';
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dados;
                $this->addGrafVerPriv();
            }
        } else {
            $this->addGrafVerPriv();
        }
    }

    private function addGrafVerPriv() {
        $botao = ['list_grafica' => true];
        $this->dados['botao'] = $botao;
        $carregarView = new \Config\ConfigView("graficas/addGrafica", $this->dados);
        $carregarView->renderizarAdm();
    }

}
