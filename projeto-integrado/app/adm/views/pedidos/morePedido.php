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
		if (!empty($this->dados['dados_pedido'][0])) {
			extract($this->dados['dados_pedido'][0]);
		?>
			<div class="content p-1">
				<div class="list-group-item">
					<div class="d-flex">
						<div class="mr-auto p-2">
							<h2 class="display-4 titulo">Ver Pedido</h2>
						</div>
						<div class="p-2">
							<span class="d-md-block">
								<?php
								if ($this->dados['botao']['list_pedido']) {
									echo "<a href='" . URL . "adm-user/pedidos' class='btn btn-outline-info btn-sm mr-2'>Listar</a>";
								}
								if ($this->dados['botao']['del_pedido']) {
									echo "<a href='" . URL . "adm-user/delPedido/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
								}
								?>
							</span>
						</div>
					</div>
					<hr>
					<?php
					$this->dados['id'] = explode(",", $id_prod);
					$this->dados['qtd'] = explode(",", $qtd_prod);
					?>
					<dl class="row">
						<dt class="col-12 col-md-3">ID</dt>
						<dd class="col-12 col-md-9"><?= $id; ?></dd>

						<dt class="col-12 col-md-3">Nome</dt>
						<dd class="col-12 col-md-9"><?= $nome; ?></dd>

						<dt class="col-12 col-md-3">CPF</dt>
						<dd class="col-12 col-md-9"><?= $cpf; ?></dd>

						<dt class="col-12 col-md-3">Estado</dt>
						<dd class="col-12 col-md-9"><?= $estado; ?></dd>

						<dt class="col-12 col-md-3">Cidade</dt>
						<dd class="col-12 col-md-9"><?= $cidade; ?></dd>

						<dt class="col-12 col-md-3">Rua</dt>
						<dd class="col-12 col-md-9"><?= $rua; ?></dd>

						<dt class="col-12 col-md-3">Bairro</dt>
						<dd class="col-12 col-md-9"><?= $bairro; ?></dd>

						<dt class="col-12 col-md-3">CEP</dt>
						<dd class="col-12 col-md-9"><?= $cep; ?></dd>

						<dt class="col-12 col-md-3">Telefone</dt>
						<dd class="col-12 col-md-9"><?= $telefone; ?></dd>

						<dt class="col-12 col-md-3">Meio de Pagamento</dt>
						<dd class="col-12 col-md-9"><?= $descricao; ?></dd>

						<dt class="col-12 col-md-3">Valor da Compra</dt>
						<dd class="col-12 col-md-9"><?= "R$" . $valor; ?></dd>

						<?php
						$num = count($this->dados['id']);
						$verProduto = new \App\adm\Models\Produtos();

						for ($i = 0; $i < $num; $i++) {
							$this->dados['dados_produto'][$i] = $verProduto->verProdPed($this->dados['id'][$i]);
							$this->dados['dados_produto'][$i][0]['qtd'] = $this->dados['qtd'][$i];
						}
						?>

						<div class="container mt-4">
							<table class="table table-condensed text-center">
								<thead>
									<tr class="cart_menu">
										<td class="font-weight-bold">Item</td>
										<td class="font-weight-bold"></td>
										<td class="font-weight-bold">Preço</td>
										<td class="font-weight-bold">Qtd</td>
										<td class="font-weight-bold">Total</td>
									</tr>
								</thead>
							</table>
							<?php
							for ($i = 0; $i < $num; $i++) {
								foreach ($this->dados['dados_produto'][$i] as $produto) {
									extract($produto);
							?>
									<table class="table table-condensed">
										<tbody>
											<tr>
												<td class="align-middle">
													<img src="<?= URL . 'assets/img/loja/' . $imagem ?>" width=125 height=125>
												</td>
												<td class="align-middle text-center">
													<p><?= $titulo ?></p>
												</td>
												<td class="align-middle text-center">
													<p>R$<?= $preco ?></p>
												</td>
												<td class="align-middle text-center">
													<p><?= $qtd ?></p>
												</td>
												<?php
												$total = $qtd * (int)$preco;
												?>
												<td class="align-middle text-center">
													<p>R$<?= $total ?></p>
												</td>
											</tr>
										</tbody>
									</table>
							<?php
								}
							}
							?>
						</div>
					</dl>
				</div>
			</div>
		<?php
		} else {
			$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Pedido não encontrado!</div>";
			$urlDestino = URL . 'adm-user/pedidos';
			header("Location: $urlDestino");
		}
		?>
	</div>

</main>