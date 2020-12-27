<?php

namespace App\Site\controllers;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class QuemSomos {

	private $dados;

	public function index() {
		$listar = new \App\Site\models\QuemSomos();
		$this->dados['quemsomos'] = $listar->listar();
		$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
		if (!empty($search)) {
			$pesquisa = new \App\site\Models\Carousel();
			$pesquisado = $pesquisa->pesquisa($search);
			$carregarView = new \Config\ConfigView("pesquisa/index", $pesquisado);
			$carregarView->renderizar();
			exit;
		}
		$carregarView = new \Config\ConfigView("quem-somos/index", $this->dados);
		$carregarView->renderizar();
	}

}
