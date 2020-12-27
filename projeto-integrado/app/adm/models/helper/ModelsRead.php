<?php

namespace App\adm\models\helper;

use PDO;
use PDOException;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class ModelsRead extends ModelsConn {
	
	private $select;
	private $values;
	private $result;
	private $msg;
	private $query;
	private $conn;

	public function exeRead($tabela, $termos = null, $parseString = null) {
		if (!empty($parseString)) {
			parse_str($parseString, $this->values);
		}
		$this->select = "SELECT * FROM {$tabela} {$termos}";
		$this->executarInstrucao();
	}

	public function exeReadEspecifico($query, $parseString = null) {
		if (!empty($parseString)) {
			parse_str($parseString, $this->values);
		}
		$this->select = (string) $query;
		$this->executarInstrucao();
	}

	private function conexao() {
		$this->conn = parent::getConn();
		$this->query = $this->conn->prepare($this->select);
		$this->query->setFetchMode(PDO::FETCH_ASSOC);
	}

	private function getInstrucao() {
		if ($this->values) {
			foreach ($this->values as $link => $valor) {
				if ($link == 'limit' || $link == 'offset') {
					$valor = (int)$valor;
				}
				$this->query->bindValue(":{$link}", $valor, (is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
			}
		}
	}

	private function executarInstrucao() {
		$this->conexao();
		try {
			$this->getInstrucao();
			$this->query->execute();
			$this->result = $this->query->fetchAll();
		} catch (PDOException $e) {
			$this->result = null;
			$this->msg = "<strong>Erro ao Ler dados:</strong> {$e->getMessage()}";
		}
	}

	public function getResult() {
		return $this->result;
	}

	public function getRowCount() {
		return $this->query->rowCount();
	}

}
