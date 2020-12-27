<?php

namespace App\adm\models\helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class ModelsEmailUnico {

    private $email;
    private $result;
    private $editarUnico;
    private $id;

    public function valEmailUnico($email, $editarUnico = null, $id = null) {
        $this->email = (string) $email;
        $this->editarUnico = $editarUnico;
        $this->id = $id;
        $valEmailUnico = new \App\adm\models\helper\ModelsRead();
        if (!empty($this->editarUnico) and ($this->editarUnico == true)) {
            $valEmailUnico->exeReadEspecifico("SELECT id FROM graficas WHERE email =:email AND id <>:id LIMIT :limit", "email={$this->email}&limit=1&id={$this->id}");
        } else {
            $valEmailUnico->exeReadEspecifico("SELECT id FROM graficas WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
        }
        $this->result = $valEmailUnico->getResult();
        if (!empty($this->result)) {
            $_SESSION['msg'] = "<script>swal({ icon: \"error\",  title: \"Erro: Este e-mail já foi cadastrado!\" });</script>";
            $this->result = false;
        } else {
            $this->result = true;
        }
    }

    function getResult() {
        return $this->result;
    }

}
