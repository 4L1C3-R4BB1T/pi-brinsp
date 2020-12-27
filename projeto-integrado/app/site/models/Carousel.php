<?php

namespace App\Site\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Carousel {

	private $result;
	private $tabela = 'carousel';

	public function listar() {
		$listar = new \Site\models\helper\ModelsRead();
		$listar->exeRead($this->tabela, "ORDER BY id ASC LIMIT :limit", "limit=3");
		$this->result['carousel'] = $listar->getResult();
		return $this->result['carousel'];
	}

	public function pesquisa($search = null) {
		$this->search = $search;
		$pesquisa = new \Site\models\helper\modelsRead();
		$pesquisa->exeReadEspecifico(
			"SELECT p.*
            FROM post p   
            WHERE p.titulo LIKE '%{$this->search}%'
			LIMIT :limit", "limit=10");
		$this->result['pesquisaPost'] = $pesquisa->getResult();
		$pesquisa->exeReadEspecifico(
			"SELECT pr.*
            FROM produto pr   
            WHERE pr.titulo LIKE '%{$this->search}%'
			LIMIT :limit", "limit=10");
		$this->result['pesquisaProd'] = $pesquisa->getResult();
		$this->result['resultado'] = array_merge($this->result['pesquisaPost'], $this->result['pesquisaProd']);
		return $this->result['resultado'];
	}
	
}
