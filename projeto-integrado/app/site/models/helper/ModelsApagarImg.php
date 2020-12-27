<?php

namespace App\site\models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelsApagarImg {

    private $nomeImg;
    private $diretorio;

    public function apagarImg($nomeImg, $diretorio = null) {
        $this->nomeImg = (string) $nomeImg;
        $this->diretorio = (string) $diretorio;
        $this->excluirImagem();
        if (!empty($this->diretorio)) {
            $this->excluirDiretorio();
        }
    }

    private function excluirImagem() {
        if (file_exists($this->nomeImg)) {
            unlink($this->nomeImg);
        }
    }

    private function excluirDiretorio() {
        if (file_exists($this->diretorio)) {
            rmdir($this->diretorio);
        }
    }
    
}
