<?php
if (!defined('URL')) {
    header("location: /");
    exit();
}
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div>
            Bem vindo! | <b>Horário atual:</b> <span id="relogio"></span>
        </div>
    </div>

    <div class="table-responsive text-center"></div>

</main>