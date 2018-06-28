<?php
// Initialize the session
// Conexão
require_once 'config.php';
// Message
//include_once 'crudGibi/message.php';

session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
$id = $_SESSION['id'];

?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../public/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<body>
	<header>
		<div class = "row">
			<p class = "col s6 center-align"><a class = "btn" href = "welcome.php">Home</a><p>
			<p class = "col s6 center-align"><a href="logout.php" class="btn-small waves-effect waves-light red">Sair</a></p>
		</div>
	</header>
  <div class="container valign-wapper">

  	<h3 class = "center-align">Olá, <b><?php echo htmlspecialchars($_SESSION['username']); ?> </b>. Bem vindo ao seu Site.</h3>  
  
	</div><!-- Fim container-->
	
<div class="row">
	<div class="col s12 m8 push-m2">
		<h3 class="light"> Meus Gibis </h3>
		<table class="striped">
			<thead>
				<tr>
					<th>titulo:</th>
					<th>editora:</th>
					<th>preco:</th>
					<th>quantidade:</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$sql = "SELECT * FROM gibis WHERE usuarios_id = $id";
				$resultado = mysqli_query($link, $sql);
               
          if(mysqli_num_rows($resultado) > 0):

				while($dados = mysqli_fetch_array($resultado)):
				?>
				<tr>
					<td><?php echo $dados['titulo']; ?></td>
					<td><?php echo $dados['editora']; ?></td>
					<td><?php echo $dados['preco']; ?></td>
					<td><?php echo $dados['quantidade']; ?></td>
					<td><a href="editarGibi.php?id=<?php echo $dados['id']; ?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>
					<td>
					<form action="../app/crudGibi/deleteGibi.php" method="POST">
					  <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
							<button name  = "btn-deletar"class="btn-floating red modal-trigger" type="submit" >
								<i class="material-icons">delete</i>
							</button>
		      </form><!--fimForm-->
					</td>
				
			   <?php 
				endwhile;
				else: ?>

				<tr>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>

			   <?php 
				endif;
			   ?>

			</tbody>
		</table>
		<br>
		<a href="adicionarGibi.php" class="btn">Adicionar Gibi</a>
	</div>
</div>


  <!--JavaScript at end of body for optimized loading-->
  <script type="text/javascript" src="../public/js/materialize.min.js"></script>
	
</body>

</html>
