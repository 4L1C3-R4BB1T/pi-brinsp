<?php

namespace App\Site\controllers;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Eventos {

	public function index() {
		$listar = new \App\Site\models\Evento();
		$this->dados['eventos'] = $listar->listar();
		$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
		if (!empty($search)) {
			$pesquisa = new \App\site\Models\Carousel();
			$pesquisado = $pesquisa->pesquisa($search);
			$carregarView = new \Config\ConfigView("pesquisa/index", $pesquisado);
			$carregarView->renderizar();
			exit;
		}
		$carregarView = new \Config\ConfigView("evento/index", $this->dados);
		$carregarView->renderizar();
	}

	public function addEvento() {
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (!empty($this->dados['CadEvento'])) {
			unset($this->dados['CadEvento']);
			$this->dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
			$cadEvento = new \App\site\Models\Evento();
			$cadEvento->cadEvento($this->dados);
			if ($cadEvento->getResult()) {
				$urlDestino = URL . 'eventos/index';
				header("Location: $urlDestino");
			} else {
				$this->dados['form'] = $this->dados;
				$this->addEventoVerPriv();
			}
		} else {
			$this->addEventoVerPriv();
		}
	}

	private function addEventoVerPriv() {
		$carregarView = new \Config\ConfigView("evento/addEvento");
		$carregarView->renderizar();
	}

}
