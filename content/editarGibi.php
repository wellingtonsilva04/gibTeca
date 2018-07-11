<?php 
require_once 'config.php';

session_start();

if(isset($_GET['id'])):
	$id = mysqli_escape_string($link, $_GET['id']);
	/*// Validate username
		// Prepare a select statement
		$sql = "SELECT id FROM gibis WHERE id = ?";

		if($stmt = mysqli_prepare($link, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "i", $id);
				
				// Set parameters
				$id = trim($_GET["id"]);
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
						// store result 
						mysqli_stmt_store_result($stmt);
				} else{
						echo "Oops! Something went wrong. Please try again later.";
				}
		}
		// Close statement
		mysqli_stmt_close($stmt);
	}*/



	$sql = "SELECT * FROM gibis WHERE id = '$id'";
	$resultado = mysqli_query($link, $sql);
	$dados = mysqli_fetch_array($resultado);
endif;

/*
// Define as variáveis e as inicialza com valores vazios
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
				echo("Erro ao editar novo Gibi ");
			}
		}
		// Close statement
		mysqli_stmt_close($stmt);
	}
	// Close connection
	mysqli_close($link);
}*/
if(isset($_POST['btn-editar'])):
	$titulo = mysqli_escape_string($link,$_POST['titulo']);
	$editora = mysqli_escape_string($link,$_POST['editora']);
	$preco = mysqli_escape_string($link,$_POST['preco']);
	$quantidade = mysqli_escape_string($link,$_POST['quantidade']);

	$id = mysqli_escape_string($link, $_POST['id']);

	$sql = "UPDATE gibis SET titulo = '$titulo', editora = '$editora', preco = '$preco', quantidade ='$quantidade' WHERE id = '$id'";

	if(mysqli_query($link, $sql)):
		echo("Cadastrado com sucesso!");
		header('Location: welcome.php');
	else:
		echo("Erro ao editar");
		echo("Error description: " . mysqli_error($link));
		header('Location: welcome.php');
	endif;
endif;


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
				<h3 class="light"> Editar Gibi </h3>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<input type="hidden" name="id" value="<?php echo $dados['id'];?>">
					<div class="input-field col s12">
						<input type="text" name="titulo" id="titulo" value="<?php echo $dados['titulo']?>">
						<label for="titulo">Titulo</label>
					</div>

					<div class="input-field col s12">
						<input type="text" name="editora" id="editora" value="<?php echo $dados['editora']?>" >
						<label for="editora">Editora</label>
					</div>

					<div class="input-field col s12">
						<input type="text" name="preco" id="preco" value="<?php echo $dados['preco']?>">
						<label for="preco">Preço</label>
					</div>

					<div class="input-field col s12">
						<input type="text" name="quantidade" id="quantidade" value="<?php echo $dados['quantidade']?>">
						<label for="quantidade">Quantidade</label>
					</div>

					<button type="submit" name="btn-editar" class="btn"> Salvar </button>
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