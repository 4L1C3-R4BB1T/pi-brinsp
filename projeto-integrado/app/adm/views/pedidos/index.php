<?php
if (!defined('URL')) {
    header("location: /");
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

    <div class="table-responsive">
        <?php
        if (empty($this->dados['listPed'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                Nenhum pedido encontrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        } else {
        ?>
            <table class="table table-striped table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">Estado</th>
                        <th class="d-none d-sm-table-cell">Cidade</th>
                        <th class="d-none d-sm-table-cell">Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->dados['listPed'] as $pedido) {
                        extract($pedido);
                    ?>
                        <tr>
                            <th><?= $id ?></th>
                            <td><?= $nome ?></td>
                            <td class="d-none d-sm-table-cell"><?= $estado ?></td>
                            <td class="d-none d-sm-table-cell"><?= $cidade ?></td>
                            <td class="d-none d-sm-table-cell"><?= $telefone ?></td>
                            <td>
                                <span class="d-md-block">
                                    <?php
                                    if ($this->dados['botao']['vis_pedido']) {
                                        echo "<a href='" . URL . "adm-user/morePedido/$id' class='btn btn-outline-primary btn-sm mr-2'>Visualizar</a>";
                                    }
                                    if ($this->dados['botao']['del_pedido']) {
                                        echo "<a href='" . URL . "adm-user/delPedido/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </div>

</main>