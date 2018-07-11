<?php
// Sessão
session_start();
// Conexão
require_once 'config.php';
$id = $_SESSION['id'];

// Define as variáveis e as inicialza com valores vazios
$titulo = $editora = $preco = $quantidade = "";
$err_titulo = $err_editora = $err_preco = $err_quantidade = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	// Checa se o titulo é vazio
	if (empty(trim($_POST["titulo"]))) {
		$err_titulo ='Por favor entre com o título';
	}else{
		$titulo = trim($_POST["titulo"]);
	}
	// Checa se a editora é vazio
	if (empty(trim($_POST["editora"]))) {
		$err_editora ='Por favor entre com a editora';
	}else{
		$editora = trim($_POST["editora"]);
	}
	// Checa se o preço está vazio
	if (empty(trim($_POST["preco"]))) {
		$err_preco ='Por favor entre com o preço';
	}else{
		$preco = trim($_POST["preco"]);
	}
	// Checa se o Quantidade está vazio
	if (empty(trim($_POST["quantidade"]))) {
		$err_quantidade ='Por favor entre com o quantidade';
	}else{
		$quantidade = trim($_POST["quantidade"]);
	}

	if(empty($err_titulo) && empty($err_editora) && empty($err_preco) && empty($err_quantidade)){
		//query into
		$sql = "INSERT INTO gibis (titulo, editora, preco, quantidade,usuarios_id) VALUES (?,?,?,?,?)";
		if($stmt = mysqli_prepare($link,$sql)){
			mysqli_stmt_bind_param($stmt,"sssii",$titulo,$editora,$preco,$quantidade,$id);
			if(mysqli_stmt_execute($stmt)){
				header("location: welcome.php");
			}else{
				echo("Erro ao inserir novo Gibi ");
			}
		}
		// Close statement
		mysqli_stmt_close($stmt);
	}
	// Close connection
	mysqli_close($link);
}

?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title> Sistema de cadastro de Gibis</title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
       <link rel="stylesheet" href="../public/css/materialize.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
        <div class="row">
			<div class="col s12 m6 push-m3">
				<h3 class="light"> Novo Gibi </h3>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<div class="input-field col s12">
						<input type="text" name="titulo" id="titulo">
						<label for="titulo">Titulo</label>
						<span class="helper-text red-text"><?php echo $err_titulo; ?></span>
					</div>

					<div class="input-field col s12">
						<input type="text" name="editora" id="editora">
						<label for="editora">Editora</label>
						<span class="helper-text red-text"><?php echo $err_editora; ?></span>
					</div>

					<div class="input-field col s12">
						<input type="text" name="preco" id="preco">
						<label for="preco">Preço</label>
						<span class="helper-text red-text"><?php echo $err_preco; ?></span>
					</div>

					<div class="input-field col s12">
						<input type="text" name="quantidade" id="quantidade">
						<label for="quantidade">Quantidade</label>
						<span class="helper-text red-text"><?php echo $err_quantidade; ?></span>
					</div>

					<button type="submit" name="btn-cadastrar" class="btn"> Cadastrar </button>
					<a href="welcome.php" class="btn green"> Listar de Gibis </a>
				</form><!--Fim Form -->
				
			</div>
      <!--JavaScript at end of body for optimized loading-->
      <script src="../public/js/materialize.min.js"></script>

      <script>
      	 M.AutoInit();
      </script>
      
    </body>
  </html>