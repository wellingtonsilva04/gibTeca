<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
// Conexão
include_once 'config.php';
// Message
include_once 'crudGibi/message.php';
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
  <div class="container valign-wapper">
		<p class = "right-align"><a href="logout.php" class="btn-small waves-effect waves-light red">Sair</a></p>

		
	</div>
    <!-- <h3>Olá, <b><?php echo htmlspecialchars($_SESSION['username']); ?> </b>. Bem vindo ao seu Site.</h3> -->
  
  
  
	</div><!-- Fim container-->
	
<div class="row">
	<div class="col s12 m8 push-m2">
		<h3 class="light"> Clientes </h3>
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
				$sql = "SELECT * FROM gibis";
				$resultado = mysqli_query($connect, $sql);
               
                if(mysqli_num_rows($resultado) > 0):

				while($dados = mysqli_fetch_array($resultado)):
				?>
				<tr>
					<td><?php echo $dados['titulo']; ?></td>
					<td><?php echo $dados['editora']; ?></td>
					<td><?php echo $dados['preco']; ?></td>
					<td><?php echo $dados['quantidade']; ?></td>
					<td><a href="editar.php?id=<?php echo $dados['id']; ?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>

					<td><a href="#modal<?php echo $dados['id']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

					<!-- Modal Structure -->
					  <div id="modal<?php echo $dados['id']; ?>" class="modal">
					    <div class="modal-content">
					      <h4>Opa!</h4>
					      <p>Tem certeza que deseja excluir esse cliente?</p>
					    </div>
					    <div class="modal-footer">					     

					      <form action="crud/delete.php" method="POST">
					      	<input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
					      	<button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>

					      	 <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>

					      </form>

					    </div>
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

			</tbody>
		</table>
		<br>
		<a href="adicionarGibi.php" class="btn">Adicionar cliente</a>
	</div>
</div>


  <!--JavaScript at end of body for optimized loading-->
  <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>
</html>
