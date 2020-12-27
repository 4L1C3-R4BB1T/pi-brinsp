<?php

namespace App\Site\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Graficas {

	private $result;
	private $tabela = 'graficas';

	public function listar() {
		$listar = new \Site\models\helper\modelsRead();
		$listar->exeRead($this->tabela, "ORDER BY id ASC LIMIT :limit", "limit=6");
		$this->result['graficas'] = $listar->getResult();
		return $this->result['graficas'];
	}
	
}
