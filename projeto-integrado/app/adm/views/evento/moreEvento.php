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
        if (!empty($this->dados['dados_evento'][0])) {
            extract($this->dados['dados_evento'][0]);
        ?>
            <div class="content p-1">
                <div class="list-group-item">
                    <div class="d-flex">
                        <div class="mr-auto p-2">
                            <h2 class="display-4 titulo">Ver Evento</h2>
                        </div>
                        <div class="p-2">
                            <span class="d-md-block">
                                <?php
                                if ($this->dados['botao']['list_evento']) {
                                    echo "<a href='" . URL . "adm-evento' class='btn btn-outline-info btn-sm mr-2'>Listar</a>";
                                }
                                if ($this->dados['botao']['del_evento']) {
                                    echo "<a href='" . URL . "adm-evento/delEvento/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <dl class="row">
                        <dt class="col-12 col-md-2">Foto</dt>
                        <dd class="col-12 col-md-10">
                            <?php
                            if (!empty($imagem)) {
                                echo "<img src='" . URL . "assets/img/eventos/" . $imagem . "' witdh='150' height='150'>";
                            } else {
                                echo "<img src='" . URL . "assets/img/eventos/evento01.png' witdh='150' height='150'>";
                            }
                            ?>
                        </dd>

                        <dt class="col-12 col-md-2">ID</dt>
                        <dd class="col-12 col-md-10"><?= $id ?></dd>

                        <dt class="col-12 col-md-2">Nome</dt>
                        <dd class="col-12 col-md-10"><?= $nome ?></dd>

                        <dt class="col-12 col-md-2">Descrição</dt>
                        <dd class="col-12 col-md-10"><?= $descricao ?></dd>
                    </dl>
                </div>
            </div>
        <?php
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Usuário não encontrado!</div>";
            $urlDestino = URL . 'adm-user/index';
            header("Location: $urlDestino");
        }
        ?>
    </div>

</main>