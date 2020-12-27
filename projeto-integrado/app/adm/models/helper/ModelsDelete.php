<?php

namespace App\adm\models\helper;

use Exception;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelsDelete extends ModelsConn {

    private $tabela;
    private $termos;
    private $values;
    private $result;
    private $query;
    private $conn;
    private $nomeImg;
    private $diretorio;
    
    public function exeDelete($tabela, $termos, $parseString) {
        $this->tabela = (string) $tabela;
        $this->termos = (string) $termos;
        parse_str($parseString, $this->values);
        $this->executarIntrucao();
    }

    private function executarIntrucao() {
        $this->query = "DELETE FROM {$this->tabela} {$this->termos}";
        $this->conexao();
        try {
            $this->query->execute($this->values);
            $this->result = true;
        } catch (Exception $ex) {
            $this->result = false;
        }
    }

    private function conexao() {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }

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

    function getResult() {
        return $this->result;
    }

}
