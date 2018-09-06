
 <?php 
  require_once 'content/config.php';

$id_gibi = $_GET['id_gibi'];
$query_gibi = "SELECT * FROM gibis WHERE id='$id_gibi'";
$resultado_gibi = mysqli_query($link, $query_gibi);
$row_gibi = mysqli_fetch_array($resultado_gibi);

$vendedor_query = "SELECT nome FROM usuarios WHERE id='$id_gibi'";

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="public/css/materialize.min.css">
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel= "stylesheet" href= "public/css/index.css">
		<!-- Compiled and minified JavaScript -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Carrinho de compras</title>
		
	</head>
	<body>
		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1><?php echo $row_gibi['titulo']; ?></h1>
			</div>
			<div>
			  <!-- Tab panes -->
			  <div class="striped">
					<div role="tabpanel" class="tab-pane active" id="home">
						<?php echo $row_gibi['editora']; ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="profile">
						<?php echo $row_gibi['preço']; ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="messages">
						<?php echo $row_gibi['quantidade']; ?>
					</div>
			  </div>
			</div>
			<p><a href="#" class="btn btn-primary" name = 'adicionarCarrinho' role="button">Adicionar ao carrinho</a> </p>
		</div>
		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="public/js/materialize.min.js"></script>
	</body>
</html>