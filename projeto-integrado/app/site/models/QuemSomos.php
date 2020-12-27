<?php

namespace App\Site\models;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class QuemSomos {

    private $result;
    private $tabela = 'quem_somos';

    public function listar() {
        $listar = new \Site\models\helper\modelsRead();
        $listar->exeRead($this->tabela, "ORDER BY id ASC LIMIT :limit", "limit=3");
        $this->result['quemsomos'] = $listar->getResult();
        return $this->result['quemsomos'];
    }
    
}

