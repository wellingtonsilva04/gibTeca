<?php 
 require_once 'config.php';

$busca = $_POST['busca']; 
$busca = $trim($busca);

//botão pesquisar
$result_gibi = "SELECT * FROM mydb.gibis where titulo LIKE '%$busca%'";


$resultado_gibi = mysqli_query($link, $result_gibi);


 if($resultado_gibi) {
	echo "nenhum registro encontrado";
}

while($dados =  mysqli_fetch_assoc($resultado_gibi)){
	echo "id do produto:". $dados['id']. "<br/>";
	echo "Titulo:". $dados['titulo']. "<br/>";
	echo "editora:". $dados['editora']. "<br/>";
	echo "preco:". $dados['preco']. "<br/>";
	echo "quantidade:". $dados['quantidade']. "<br/>";

}