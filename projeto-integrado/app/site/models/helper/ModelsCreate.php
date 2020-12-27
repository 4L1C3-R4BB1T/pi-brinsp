<?php

namespace Site\models\helper;

use PDOException;

if (!defined('URL')) {
    header("location: /");
    exit();
}

class ModelsCreate extends ModelsConn {
   
    private $tabela;
    private $dados;
    private $query;
    private $conn;
    private $msg;
    private $result;

    public function exeCreate($tabela, array $dados) {
        $this->tabela = (string) $tabela;
        $this->dados = $dados;
        $this->getInstrucao();
        $this->executarInstrucao();
    }

    public function getInstrucao() {
        $keys = implode(', ', array_keys($this->dados));
        $values = ':' . implode(', :', array_keys($this->dados));
        $this->query = "INSERT INTO {$this->tabela} ({$keys}) VALUES ({$values})";
    }

    private function executarInstrucao() {
        $this->conexao();
        try {
            $this->query->execute($this->dados);
            $this->result = $this->conn->lastInsertId();
        } catch (PDOException $e) {
            $this->msg = $e->getMessage();
        }
    }

    private function conexao() {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }

    public function getMsg() {
        return $this->msg;
    }

    public function getResult() {
        return $this->result;
    }
    
}
