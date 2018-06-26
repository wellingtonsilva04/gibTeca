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

if(isset($_POST['btn-cadastrar'])):
	$titulo = clear($_POST['titulo']);
	$editora = clear($_POST['editora']);
	$preco = clear($_POST['preco']);
	$quantidade = clear($_POST['quantidade']);


	$sql = "INSERT INTO gibis (titulo, editora, preco, quantidade) VALUES ('$titulo', '$editora', '$preco', '$quantidade')";

	if(mysqli_query($link, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: ../welcome.php');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar";
		header('Location: ../welcome.php');
	endif;
endif;
