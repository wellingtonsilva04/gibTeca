<?php
// Sessão
session_start();
// Conexão
require_once '../../content/config.php';

if(isset($_POST['btn-delatar'])):
	$id =mysqli_escape_string( $link,$_POST['id']);

	$sql = "DELETE FROM gibis WHERE id  = '$id'";

	if(mysqli_query($link, $sql)):
		echo("Deletado com sucesso!");
		header('Location: ../../content/welcome.php');
	else:
		echo("Error description: " . mysqli_error($link));
		header('Location: ../../content/welcome.php');
	endif;
endif;
