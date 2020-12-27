<?php
if (!defined('URL')) {
	header("location: /");
	exit();
}
?>

<main role="main">

	<?php
	if (!isset($_SESSION['orcamento'])) {
	?>
		<section class="mt-5">
			<div class="container">
				<div>
					<h4 class="mb-5">Seu carrinho de compras está vazio!</h4>
				</div>
			</div>
		</section>
	<?php
	} else {
	?>
		<section id="cart_items">
			<div class="container">
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td>Item</td>
								<td></td>
								<td>Preço</td>
								<td>Quantidade</td>
								<td>Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<?php
							$total = $valor = 0;
							foreach ($_SESSION['orcamento'] as $produto) {
								extract($produto);
							?>
								<tr>
									<input name="id" type="hidden" value="<?= $id ?>">
									<td class="cart_product mt-3">
										<a href="<?= URL . 'loja/visualizar/' . $id ?>">
											<img src="<?= URL . 'assets/img/loja/' . $imagem ?>">
										</a>
									</td>
									<td class="cart_description">
										<a href="<?= URL . 'loja/visualizar/' . $id ?>">
											<p><?= $titulo ?></p>
										</a>
									</td>
									<td class="cart_price">
										<p>R$<?= $preco ?></p>
									</td>
									<td class="cart_price">
										<p><?= $qtd ?></p>
									</td>
									<?php
									$total = $qtd * (int)$preco;
									?>
									<td class="cart_total">
										<p class="cart_total_price">R$<?= $total ?></p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete" href="<?= URL . 'loja/delProd/' . $id ?>">
											<i class="fa fa-times"></i>
										</a>
									</td>
								</tr>
							<?php
								$valor = $valor + $total;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	<?php
	}
	?>

	<div class="text-center mb-5">
		<a href="<?= URL ?>loja/index">
			<button type="button" class="sell">Adicione mais Produtos!</button>
		</a>
	</div>

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Pronto para finalizar a compra?</h3>
			</div>
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="chose_area">
						<form name="calcFrete" method="post">
							<ul class="user_info ml-3">
								<p class="ml-4">Informe seu CEP abaixo para calcular o frete.</p>
								<li class="single_field zip-field">
									<input name="CepDestino" type="text" class="ml-4">
									<div class="ml-4 mt-4">
										<?php
										if (isset($this->dados['frete'])) {
											echo "Valor: R$" . $this->dados['frete'] . "</br>";
											echo "Prazo: " . $this->dados['prazo'] . " dias";
										}
										?>
									</div>
								</li>
							</ul>
							<button type="submit" class="btn btn-default update">Calcular Frete</button>
						</form>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="total_area">
						<ul class="list-unstyled ml-5 mr-2">
							<li>Total produtos
								<span>R$
									<?php
									if (isset($_SESSION['orcamento'])) {
										echo $valor;
										$_SESSION['valor'] = $valor;
									} else {
										echo "0";
									}
									?>
								</span>
							</li>
							<li>Frete
								<span>R$
									<?php
									if (isset($this->dados['frete'])) {
										echo $this->dados['frete'];
									} else {
										echo "0";
									}
									?>
								</span>
							</li>
							<li>Total
								<span>R$
									<?php
									if (isset($_SESSION['orcamento'])) {
										if (isset($this->dados['frete'])) {
											echo (float)$valor + (float)$this->dados['frete'];
										} else {
											echo $valor;
										}
									} else {
										echo "0";
									}
									?>
								</span>
							</li>
						</ul>
						<a class="btn btn-default update ml-5" href="
							<?php
							if (isset($_SESSION['orcamento'])) {
								echo URL . "loja/checkout";
							} else {
								echo URL . "loja/indexCart";
							}
							?>
							">Confirmar Compra
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>