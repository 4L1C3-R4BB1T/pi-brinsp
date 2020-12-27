<?php

namespace App\Site\controllers;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class User {

	private $dados;
	private $user;

	public function visualizar($user = null) {
		$botao = ['edit_usuario' => true,];
		$this->dados['botao'] = $botao;
		$this->user = (int) $user;
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->dados['destinatario'] = $this->user;
		if (!empty($this->dados['EnviarCom'])) {
			unset($this->dados['EnviarCom']);
			$addCom = new \App\Site\Models\User();
			$addCom->addCom($this->dados);
			if (!$addCom->getResult()) {
				$this->dados['formRetorno'] = $this->dados;
			} else {
				$this->dados['formRetorno'] = null;
			}
		}
		$visualizarUser = new \App\Site\models\User();
		$this->dados['user'] = $visualizarUser->visualizarUser($this->user);
		$this->dados['com'] = $visualizarUser->visualizarCom($this->user);
		$carregarView = new \Config\ConfigView("user/visualizar", $this->dados);
		$carregarView->renderizar();
	}

	public function upUser($dadosId = null) {
		$this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$this->dadosId = (int) $dadosId;
		if (!empty($this->dadosId)) {
			$this->upUserPriv();
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Usuário não encontrado!\", });</script>";
			$urlDestino = URL.'home/index';
			header("Location: $urlDestino");
		}
	}

	private function upUserPriv() {
		if (!empty($this->dados['editUsuario'])) {
			unset($this->dados['editUsuario']);
			$this->dados['imagem_nova'] = ($_FILES['imagem_nova'] ? $_FILES['imagem_nova'] : null);
			$editarUsuario = new \App\site\models\User();
			$editarUsuario->altUsuario($this->dados);
			if ($editarUsuario->getResult()) {
				$_SESSION['msg'] = "<script>swal({ icon: \"success\",  title: \"Usuário editado com sucesso!\", });</script>";
				$urlDestino = URL.'user/visualizar/'.$this->dados['id'];
				header("Location: $urlDestino");
			} else {
				$this->dados['form'] = $this->dados;
				$this->upUserViewPriv();
			}
		} else {
			$verUsuario = new \App\site\models\User();
			$this->dados['form'] = $verUsuario->visualizarUser($this->dadosId);
			$this->upUserViewPriv();
		}
	}

	private function upUserViewPriv() {
		if ($this->dados['form']) {
			$carregarView = new \Config\ConfigView("user/upUser", $this->dados);
			$carregarView->renderizar();
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Usuário não encontrado!\", });</script>";
			$UrlDestino = URL.'user/visualizar';
			header("Location: $UrlDestino");
		}
	}

}
