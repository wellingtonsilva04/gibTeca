<?php 
require_once 'config.php';

session_start();

if(isset($_GET['id'])):
	$id = mysqli_escape_string($link, $_GET['id']);
	$sql = "SELECT * FROM gibis WHERE id = '$id'";
	$resultado = mysqli_query($link, $sql);
	$dados = mysqli_fetch_array($resultado);
endif;

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