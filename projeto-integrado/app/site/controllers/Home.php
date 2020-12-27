<?php

namespace App\Site\controllers;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Home {

	private $dados;

	public function index() {
		$listar = new \App\Site\models\Carousel();
		$this->dados['carousel'] = $listar->listar();
		$listar_imagens = new \App\Site\models\Imagem();
		$this->dados['imagens'] = $listar_imagens->listar();
		$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
		if (!empty($search)) {
			$pesquisa = new \App\site\Models\Carousel();
			$pesquisado = $pesquisa->pesquisa($search);
			$carregarView = new \Config\ConfigView("pesquisa/index", $pesquisado);
			$carregarView->renderizar();
			exit;
		}
		$carregarView = new \Config\ConfigView("home/index", $this->dados);
		$carregarView->renderizar();
	}
	
}
