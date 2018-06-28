<?php 
session_start();

?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title> Sistema de cadastro de clientes</title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
        <div class="row">
			<div class="col s12 m6 push-m3">
				<h3 class="light"> Novo Gibi </h3>

				<form action="crudGibi/createGibi.php" method="POST">
					<div class="input-field col s12">
						<input type="text" name="titulo" id="titulo">
						<label for="titulo">Titulo</label>
					</div>

					<div class="input-field col s12">
						<input type="text" name="editora" id="editora">
						<label for="editora">Editora</label>
					</div>

					<div class="input-field col s12">
						<input type="text" name="preco" id="preco">
						<label for="preco">Preço</label>
					</div>

					<div class="input-field col s12">
						<input type="text" name="quantidade" id="quantidade">
						<label for="quantidade">Quantidade</label>
					</div>

					<button type="submit" name="btn-cadastrar" class="btn"> Cadastrar </button>
					<a href="../welcome.php" class="btn green"> Listar de Gibis </a>
				</form><!--Fim Form -->
				
			</div>
      <!--JavaScript at end of body for optimized loading-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

      <script>
      	 M.AutoInit();
      </script>
      
    </body>
  </html>