<?php
// Sessão
session_start();
// Conexão
require_once '../../content/config.php';



if(isset($_POST['btn-editar'])):
	$titulo = mysqli_escape_string($link,$_POST['titulo']);
	$editora = mysqli_escape_string($link,$_POST['editora']);
	$preco = mysqli_escape_string($link,$_POST['preco']);
	$quantidade = mysqli_escape_string($link,$_POST['quantidade']);

	$id = mysqli_escape_string($link, $_POST['id']);

	$sql = "UPDATE gibis SET titulo = '$titulo', editora = '$editora', preco = '$preco', quantidade ='$quantidade' WHERE id = '$id'";

	if(mysqli_query($link, $sql)):
		echo("Cadastrado com sucesso!");
		header('Location: ../../content/welcome.php');
	else:
		echo("Erro ao editar");
		echo("Error description: " . mysqli_error($link));
		header('Location: ../../content/welcome.php');
	endif;
endif;
