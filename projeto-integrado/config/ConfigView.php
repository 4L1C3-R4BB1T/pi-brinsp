<?php

namespace Config;

class ConfigView {

	private $nome;
	private $dados;

	public function __construct($nome, array $dados = null) {
		$this->nome = (string) $nome;
		$this->dados = $dados;
	}

	public function renderizar() {
		if (file_exists("app/site/views/{$this->nome}.php")) {
			include_once('app/site/views/includes/header.php');
			include_once('app/site/views/includes/menu.php');
			include_once("app/site/views/{$this->nome}.php");
			include_once('app/site/views/includes/footer.php');
		} else {
			echo "Erro ao carregar a página: {$this->nome}";
		}
	}

	public function renderizarAdm() {
		if (file_exists("app/adm/views/{$this->nome}.php")) {
			include_once('app/adm/views/includes/header.php');
			include_once('app/adm/views/includes/menu.php');
			include_once("app/adm/views/{$this->nome}.php");
			include_once('app/adm/views/includes/footer.php');
		} else {
			echo "Erro ao carregar a página: {$this->nome}";
		}
	}

}
