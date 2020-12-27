<?php

namespace App\site\models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Pagina {
   
    private $result;
    private $urlController;
    private $urlMetodo;

    public function listarPaginas($urlController = null, $urlMetodo = null) {
        $this->urlController = (string) $urlController;
        $this->urlMetodo = (string) $urlMetodo;
        $listar = new \Site\models\helper\ModelsRead();
        $listar->exeReadEspecifico(
            "SELECT pag.id, tpg.tipo tipo_tpg
            FROM pagina pag
            INNER JOIN tipo_pagina tpg 
                ON tpg.id = pag.tp_pagina_id                                                
                AND (pag.controller = :controller AND pag.metodo = :metodo)
            LIMIT :limit", "controller={$this->urlController}&metodo={$this->urlMetodo}&limit=1"
        );
        $this->result = $listar->getResult();
        return $this->result;
    }

}
