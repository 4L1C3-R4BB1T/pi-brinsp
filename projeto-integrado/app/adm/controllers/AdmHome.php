<?php

namespace App\adm\controllers;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class AdmHome {

    private $dados;

    public function index() {
        $carregarView = new \Config\ConfigView("home/index", $this->dados);
        $carregarView->renderizarAdm();
    }
    
}
