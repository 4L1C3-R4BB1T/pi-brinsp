<?php

namespace App\Site\controllers;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Cadastro {
	
	private $dados;

	public function index(){
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
		if (!empty($search)) {
			$pesquisa = new \App\site\Models\Carousel();
			$pesquisado = $pesquisa->pesquisa($search);
			$carregarView = new \Config\ConfigView("pesquisa/index", $pesquisado);
			$carregarView->renderizar();
			unset($search);
			exit;
		}
		if (!empty($this->dados['formAddUsuario'])) {
			unset($this->dados['formAddUsuario']);
			$addUsuario = new \App\Site\Models\Cadastro();
			$addUsuario->addUsuario($this->dados);
			if (!$addUsuario->getResult()) {
				$this->dados['formRetorno'] = $this->dados;
			} else {
				$this->dados['formRetorno'] = null;
			}
		}
		$carregarView = new \Config\ConfigView("cadastro/index", $this->dados);
		$carregarView->renderizar();
	}

}
