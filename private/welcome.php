<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<body>
  <div class="container">
  <div class="row">
	<div class="col s12 m6 push-m3">
		<h3 class="light"> Novo Gibi </h3>
		<form action="php_action/create.php" method="POST">
			<div class="input-field col s12">
				<input type="text" name="titulo" id="titulo">
				<label for="titulo">Titulo</label>
			</div>

			<div class="input-field col s12">
				<input type="text" name="editora" id="editora">
				<label for="editora">Sobrenome</label>
			</div>

			<div class="input-field col s12">
				<input type="text" name="email" id="email">
				<label for="email">Email</label>
			</div>

			<div class="input-field col s12">
				<input type="text" name="idade" id="idade">
				<label for="idade">Idade</label>
			</div>

			<button type="submit" name="btn-cadastrar" class="btn"> Cadastrar </button>
			<a href="index.php" class="btn green"> Lista de clientes </a>
		</form>
		
	</div>
</div>
    <h3>Olá, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Bem vindo ao seu Site.</h3>
  
  <p><a href="logout.php" class="btn-small waves-effect waves-light">Sign Out of Your Account</a></p>
  </div>

  <!--JavaScript at end of body for optimized loading-->
  <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>
</html>