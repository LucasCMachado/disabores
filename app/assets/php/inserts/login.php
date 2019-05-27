<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$email = $_POST['email'];
// Senha digitada pelo usuário
$senha = $_POST['senha'];

$stmt = $dbh->prepare('SELECT * FROM usuario WHERE status="ativo"');
$stmt->bindParam(":email", $email, PDO::PARAM_STR);
$stmt->execute();

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
	$hash = $row["senha"];    
}

if ( $email === $row["email"] and password_verify($senha, $hash)) {

	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)){ session_start();}
	// Salva os dados encontrados na sessão
	$_SESSION['UsuarioID'] = $row['id'];
	$_SESSION['UsuarioNome'] = $row['nome'];
		  
		echo 'login_correto';
	}
		else {
		echo 'login_incorreto';
	}
?>