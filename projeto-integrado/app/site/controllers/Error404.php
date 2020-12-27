<?php

namespace App\Site\controllers;

if (!defined('URL')) {
    header("location: /");
    exit();
}


class Error404 {

    private $dados;

    public function index() {
        $carregarView = new \Config\ConfigView("error/error404", $this->dados);
        $carregarView->renderizar();
    }

}
