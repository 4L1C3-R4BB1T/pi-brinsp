<header>
	<nav class="navbar fixed-top navbar-expand-lg">
		<a class="navbar-brand" href="<?= URL ?>home">
			<img src="<?= URL ?>assets/img/menu/logo.png" alt="logo">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link mr-2" href="<?= URL ?>home">INÍCIO</a>
				<a class="nav-item nav-link mr-2" href="<?= URL ?>galeria">GALERIA</a>
				<a class="nav-item nav-link mr-2" href="<?= URL ?>loja">LOJA</a>
				<a class="nav-item nav-link mr-2" href="<?= URL ?>eventos">EVENTOS</a>
				<a class="nav-item nav-link mr-2" href="<?= URL ?>graficas">GRÁFICAS</a>
				<a class="nav-item nav-link mr-2" href="<?= URL ?>quem-somos">SOBRE</a>
				<a class="nav-item nav-link mr-3" href="<?= URL ?>faq">F.A.Q.</a>
				<form class="form-inline active-purple-4" method="post">
					<input class="form-control form-control-sm mr-1 w-75 ml-3" type="text" placeholder="Pesquise no site" aria-label="Search" name="search">
					<button type="submit" class="search" name="pesquisa">
						<i class="fas fa-search mt-1" aria-hidden="true"></i>
					</button>
				</form>
			</div>
		</div>

		<div class="mt-1">
			<a href="<?= URL ?>loja/indexCart">
				<img class="cart mr-3 mb-2" src="<?= URL ?>assets/img/menu/none.png">
			</a>
			<?php
			if (isset($_SESSION['usuario_nome'])) {
			?>
				<span class="user">
					Olá,
					<div class="dropdown show mr-1">
						<a class="dropdown" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?= $_SESSION['usuario_nome'] ?>!
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="<?= URL ?>user/visualizar/<?= $_SESSION['usuario_id'] ?>">Perfil</a>
							<a class="dropdown-item" href="<?= URL ?>auth/logout">Sair</a>
						</div>
					</div>
				</span>
			<?php
			} else {
			?>
				<a class="option" href="<?= URL ?>cadastro">
					<img class="cad mb-1 mr-1" src="https://img.icons8.com/metro/50/000000/create-new.png">CADASTRE-SE
				</a>
				<a class="option ml-1" href="<?= URL ?>auth/auth">
					<img class="log mb-1 mr-1" src="https://img.icons8.com/windows/32/000000/enter-2.png">ENTRE
				</a>
			<?php
			}
			?>
		</div>
	</nav>
</header>