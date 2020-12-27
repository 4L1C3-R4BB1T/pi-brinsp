<?php

namespace App\adm\models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelsCampoVazio {

    private $dados;
    private $result;

    public function validarDados(array $dados) {
        $this->dados = $dados;
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)) {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Necessário preencher todos os campos!\" });</script>";
            $this->result = false;
        } else {
            $this->result = true;
        }
    }

    function getResult() {
        return $this->result;
    }

}
