<?php

namespace App\Adm\models;

if (!defined('URL')) {
	header("location: /");
	exit();
}

class Evento {

	private $result;
	private $limiteResultado = 40;
	private $id;
	private $dados;

	public function listarEvento() {
		$listarEvento = new \App\adm\Models\helper\ModelsRead();
		$listarEvento->exeReadEspecifico(
			"SELECT e.id, e.nome, e.descricao
			FROM evento e
			ORDER BY e.id DESC 
			LIMIT :limit", "&limit={$this->limiteResultado}");
		$this->result = $listarEvento->getResult();
		return $this->result;
	}

	public function verEvento($id) {
		$this->id = (int) $id;
		$verPerfil = new \App\adm\Models\helper\ModelsRead();
		$verPerfil->exeReadEspecifico(
			"SELECT e.*
            FROM evento e
            WHERE e.id =:id 
			LIMIT :limit", "id={$this->id}&limit=1");
		$this->result = $verPerfil->getResult();
		return $this->result;
	}

	public function apagarEvento($id = null) {
		$this->id = (int) $id;
		$this->confirmarEvento();
		if ($this->dados) {
			$apagarEvento = new \App\adm\Models\helper\ModelsDelete();
			$apagarEvento->exeDelete("evento", "WHERE id =:id", "id={$this->id}");
			if ($apagarEvento->getResult()) {
				$apagarImg = new \App\adm\Models\helper\ModelsDelete();
				$apagarImg->apagarImg('assets/img/evento/'.$this->id.'/'.$this->dados[0]['imagem'], 'assets/img/evento/'.$this->id);
				$_SESSION['msg'] = "<script>swal({ icon: \"success\", title: \"Evento excluído com sucesso!\" });</script>";
				$this->result = true;
			} else {
				$_SESSION['msg'] = "<script>swal({ icon: \"error\", title: \"Erro: Evento não excluído!\" });</script>";
				$this->result = false;
			}
		} else {
			$_SESSION['msg'] = "<script>swal({ icon: \"error\", title: \"Erro: Evento não excluído!\" });</script>";
			$this->result = false;
		}
	}

	public function confirmarEvento() {
		$verEvento = new \App\adm\Models\helper\ModelsRead();
		$verEvento->exeReadEspecifico(
			"SELECT e.imagem 
			FROM evento e
			WHERE e.id = :id 
			LIMIT :limit", "id={$this->id}&limit=1");
		$this->dados = $verEvento->getResult();
	}

}
