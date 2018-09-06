<?php 
 require_once './content/config.php';
//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

if(!empty(isset($_POST['btn-pesquisar']))){
 


}

//Selecionar todos os gibis da tabela
$result_gibi = "SELECT count id as numbergibi FROM gibis";
$resultado_gibi = mysqli_query($link, $result_gibi);

//Contar o total de gibis
$total_gibis = $resultado_gibi;

//Seta a quantidade de gibis por pagina
$quantidade_pg = 6;

//calcular o número de pagina necessárias para apresentar os gibis
$num_pagina = ceil($total_gibis/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os gibis a serem apresentado na página
$result_gibis = "SELECT * FROM gibis limit $incio, $quantidade_pg";
$resultado_gibis = mysqli_query($link, $result_gibis);
$total_gibis = mysqli_num_rows($resultado_gibis);
?>
<!DOCTYPE html>
<html>
<head>
<title> GIBTECA </title>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="public/css/materialize.min.css">
<!--Import Google Icon Font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel= "stylesheet" href= "public/css/index.css">
<!-- Compiled and minified JavaScript -->
</head>
	<body
		background="imgs/a.PNG" bgproperties="fixed">
    <header>
      <nav>
        <div class="nav-wrapper blue row">
          <div class="col s4">
          <a href="index.php" class="brand-logo">Gibiteca</a>
          </div>


            <form action="content/buscar.php" method="post" class= "col s4">
            <div class="input-field"><!-- BOTAO PROCURAR -->
              <input type="search" name="busca" required>
              <label class="label-icon" for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
            </div> <!-- FIM BOTAO PROCURAR-->
          </form>

          <div class= "col s4">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href= "content/welcome.php"><i class="material-icons">account_circle</i></a></li>
            </ul>
          </div>
          
        </div>
      </nav><!--Fim cabeçalho navbar-->
    </header><!--Fim cabeçalho-->
    <div class = 'container'>
			<div class="page-header">
				<h1>Gibis</h1>
			</div>
			<div class="row">
				<?php while($rows_gibis = mysqli_fetch_assoc($resultado_gibis)){ ?>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<div class="caption text-center">
								<a href="detalhes.php?id_gibi=<?php echo $rows_gibis['id']; ?>"><h3><?php echo $rows_gibis['titulo']; ?></h3></a>
								<p><a href="#" class="btn btn-primary" role="button">Comprar</a> </p>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php
				//Verificar a pagina anterior e posterior
				$pagina_anterior = $pagina - 1;
				$pagina_posterior = $pagina + 1;
			?>
			<nav class="text-center">
				<ul class="pagination">
					<li>
						<?php
						if($pagina_anterior != 0){ ?>
							<a href="index.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&laquo;</span>
					<?php }  ?>
					</li>
					<?php 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li><a href="index.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php } ?>
					<li>
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="index.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
								<span aria-hidden="true">&raquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&raquo;</span>
					<?php }  ?>
					</li>
				</ul>
			</nav>
		</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>


