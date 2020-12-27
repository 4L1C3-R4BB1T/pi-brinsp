<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div>
            Bem vindo! | <b>Horário atual:</b> <span id="relogio"></span>
        </div>
    </div>

    <div class="table-responsive mb-4">
        <?php
        if (isset($this->dados['form'])) {
            $valorForm = $this->dados['form'];
        }
        if (isset($this->dados['form'][0])) {
            $valorForm = $this->dados['form'][0];
        }
        ?>
        <div class="content pt-3 pb-2">
            <div class="list-group-item p-5">
                <div class="d-flex">
                    <div class="mr-auto">
                        <h2 class="display-4 titulo">Cadastrar Gráfica</h2>
                    </div>
                    <div>
                        <span class="d-md-block">
                            <?php
                            if ($this->dados['botao']['list_grafica']) {
                                echo "<a href='" . URL . "adm-grafica' class='btn btn-outline-info btn-sm'>Listar</a> ";
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <hr>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label><span class="text-danger">*</span> Nome</label>
                            <input name="nome" type="text" class="form-control" placeholder="Digite o nome da gráfica" 
                                value="<?php if (isset($valorForm['nome'])) { echo $valorForm['nome']; } ?>">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label><span class="text-danger">*</span> Telefone</label>
                            <input name="fone" type="text" class="form-control" placeholder="Digite o telefone" 
                                value="<?php if (isset($valorForm['fone'])) { echo $valorForm['fone']; } ?>">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-12 col-md-5">
                            <label><span class="text-danger">*</span> E-mail</label>
                            <input name="email" type="text" class="form-control" placeholder="Digite o e-mail" 
                                value="<?php if (isset($valorForm['email'])) { echo $valorForm['email']; } ?>">
                        </div>
                        <div class="form-group col-12 col-md-7">
                            <label><span class="text-danger">*</span>Endereço</label>
                            <input name="endereco" type="text" class="form-control" id="endereco" placeholder="Digite o endereco" 
                                value="<?php if (isset($valorForm['endereco'])) { echo $valorForm['endereco']; } ?>">
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <div class="form-group col-12 col-md-6">
                            <label><span class="text-danger">*</span> Foto</label>
                            <input name="imagem_nova" type="file" onchange="previewImagem();">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <?php
                            $imagem_antiga = URL . 'assets/img/usuario/preview_img.png';
                            ?>
                            <img src="<?= $imagem_antiga ?>" alt="Imagem da Gráfica" id="preview-user" class="img-thumbnail" style="width: 150px; height: 150px;">
                        </div>
                    </div>
                    <p>
						<span class="text-danger">* </span>Campo obrigatório
					</p>
					<div class="mb-5">
                        <input name="CadGrafica" type="submit" class="btn btn-warning float-right" value="Salvar">
						<a href="<?= URL ?>adm-grafica" class="btn btn-danger float-right mr-2">Cancelar</a>
					</div>
                </form>
            </div>
        </div>
    </div>

</main>