<?php

namespace App\Site\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Imagem {

	private $result;
	private $tabela = 'post';

	public function listar() {
		$listar = new \Site\models\helper\ModelsRead();
		$listar->exeReadEspecifico(
			"SELECT p.id, p.titulo, p.imagem
			FROM {$this->tabela} p 
			ORDER BY p.data_criacao DESC 
			LIMIT :limit", "limit=4");
		$this->result['imagens'] = $listar->getResult();
		return $this->result['imagens'];
	}
	
}
