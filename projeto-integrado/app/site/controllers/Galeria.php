<?php

namespace App\Site\controllers;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Galeria {

	private $dados;
	private $posts;

	public function index() {
		$listar = new \App\Site\models\Galeria;
		$this->dados['imagens'] = $listar->listar();
		$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
		if (!empty($search)) {
			$pesquisa = new \App\site\Models\Carousel();
			$pesquisado = $pesquisa->pesquisa($search);
			$carregarView = new \Config\ConfigView("pesquisa/index", $pesquisado);
			$carregarView->renderizar();
			exit;
		}
		$carregarView = new \Config\ConfigView("galeria/index", $this->dados);
		$carregarView->renderizar();
	}

	public function visualizar($posts = null) {
		$this->posts = (int) $posts;
		$visualizarPost = new \App\Site\models\Galeria();
		$this->dados['post'] = $visualizarPost->visualizarPost($this->posts);
		$visualizarPost = new \App\Site\models\Galeria();
		$this->dados['postRecentes'] = $visualizarPost->postsRecentes();
		$carregarView = new \Config\ConfigView("galeria/visualizar", $this->dados);
		$carregarView->renderizar();
	}

	public function addPost() {
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (!empty($this->dados['CadPost'])) {
			unset($this->dados['CadPost']);
			$this->dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
			$this->dados['tipo_arte'] = intval($this->dados['tipo_arte']);
			$cadPost = new \App\site\Models\Galeria();
			$cadPost->cadPost($this->dados);
			if ($cadPost->getResult()) {
				$urlDestino = URL.'galeria/index';
				header("Location: $urlDestino");
			} else {
				$this->dados['form'] = $this->dados;
				$this->addPostVerPriv();
			}
		} else {
			$this->addPostVerPriv();
		}
	}

	private function addPostVerPriv() {
		$carregarView = new \Config\ConfigView("galeria/addPost");
		$carregarView->renderizar();
	}

	public function listarPorTipo($tipo = null) {
		$this->tipo = (int) $tipo;
		$listar = new \App\Site\models\Galeria();
		$this->dados['imagens'] = $listar->listarPorTipo($tipo);
		$carregarView = new \Config\ConfigView("galeria/index", $this->dados);
		$carregarView->renderizar();
	}

}
