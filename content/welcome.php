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
$id = $_SESSION['id'];//id do usuário
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado_usuario = mysqli_query($link, $sql);
$dados_usuario = mysqli_fetch_array($resultado_usuario)

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
	  <ul id="dropdown2" class="dropdown-content ">
	  	<li><a href="#!"><?php echo $dados_usuario['nome']; ?></a></li>
	  	<li><a href="logout.php">logout</a></li>
	  </ul>
      <nav><!--inicio nav cabecalho-->
		<div class="nav-wrapper blue row">
			<form class= "col s4">
				<div class="input-field">
				<input id="search" name="busca" type="search" required>
				<label class="label-icon" for="search"><i class="material-icons">search</i></label>
				<i class="material-icons">close</i>
				</div> 
			</form> -->
			<div class= "nav-wrapper blue">
				
				<a href="../index.php" class="brand-logo">Gibiteca</a>
				<ul class="right hide-on-med-and-down">
					<li><a class="btn dropdown-trigger" href="#!" data-target="dropdown2"><i class="material-icons">account_circle</i></a></li>
				</ul>
		</div><!--       </div> -->
      </nav><!--Fim cabeçalho navbar-->
</header><!--Fim cabeçalho-->
  <div class="container valign-wapper">

  	<h3 class = "center-align">Olá, <b><?php echo htmlspecialchars($_SESSION['username']); ?> </b>. Bem vindo ao seu Site.</h3>  
  
	</div><!-- Fim container-->

	<div class="row">
		<div class="col s12 m8 push-m2">
			<h3 class="light center-align"> Meus Gibis </h3>
			<table class="striped"><!--Tabela-->
				<thead><!--Cabeçaho tabela-->
					<tr><!--linha do cabeçalho da tabela-->
						<th>Título:</th>
						<th>Editora:</th>
						<th>Preco:</th>
						<th>Quantidade:</th>
					</tr>
				</thead><!--Fim Cabeçalhho-->

				<tbody><!--corpo da tabela-->
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
						<td><a href="#modal1<?php echo $dados['id']; ?>" class="modal-trigger btn-floating red"><i class="material-icons">delete</i></a></td>
						<!-- Modal Structure -->
							<div id="modal1<?php echo $dados['id']; ?>" class="modal">
								<div class="modal-content">
									<h4>Opa!</h4>
									<p>Tem certeza que deseja excluir esse Gibi?</p>
								</div>
								<div class="modal-footer">
								<form action="../app/crudGibi/deleteGibi.php" method="POST"><!--Form deletar-->
									<input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
									<button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>
							      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
								</form><!--Fim Form-->
								</div><!--Fim Modal-content-->
							</div>

					</tr>
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

				</tbody><!--Fim Corpo da Tabela-->
			</table><!--Fim tabela-->
			<br>
			<a href="adicionarGibi.php" class="btn">Adicionar Gibi</a>
		</div>
	</div><!--Fim row-->
	
	<!--JavaScript at end of body for optimized loading-->
	<script type="text/javascript" src="../public/js/materialize.min.js"></script>
	<script type="text/javascript">
		M.AutoInit();
	</script>
	
</body>
</html>
