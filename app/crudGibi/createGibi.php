<?php
// Sessão
session_start();
// Conexão
require_once '../config.php';
// Clear
function clear($input) {
	global $link;
	// sql
	$var = mysqli_escape_string($link, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}
$id = $_SESSION['id'];
if(isset($_POST['btn-cadastrar'])):
	echo("enviou");
	$titulo = clear($_POST['titulo']);
	$editora = clear($_POST['editora']);
	$preco = clear($_POST['preco']);
	$quantidade = clear($_POST['quantidade']);


	$sql = "INSERT INTO gibis (titulo, editora, preco, quantidade,usuarios_id) VALUES ('$titulo', '$editora', '$preco', '$quantidade','$id')";

	if(mysqli_query($link, $sql)):
		echo("Cadastrado com sucesso!");
		header('Location: ../content/welcome.php');
	else:
		echo("Erro ao cadastrar");
		echo("Error description: " . mysqli_error($link));
		header('Location: ../content/welcome.php');
	endif;
endif;
