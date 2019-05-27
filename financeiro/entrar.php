<?php
// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['email']) OR empty($_POST['senha']))) {
  header("Location: inicio"); exit;
}

require_once './_connect/connect_pdo.php';
$dbh = Database::conexao();

$email = $_POST['email'];
// Senha digitada pelo usuário
$senha = $_POST['senha'];
$status = 'ATIVO';

try{

	$stmt = $dbh->prepare('SELECT * FROM usuario WHERE email=:email LIMIT 1');
	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
	$stmt->execute();

	$count = $stmt->rowCount();

	if ($count != 1) {
		// Redireciona o visitante
		header("Location: inicio#login-erro"); exit;
	}
		else {

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		if (password_verify($senha, $resultado["senha"])) {

		// Se a sessão não existir, inicia uma
		if (!isset($_SESSION)) session_start();

		// Salva os dados encontrados na sessão

		$_SESSION['UsuarioID'] = $resultado['id'];
		$_SESSION['UsuarioNome'] = $resultado['nome'];
		$_SESSION['UsuarioEmail'] = $resultado['email'];
		$_SESSION['UsuarioToken'] = $resultado['token'];

		// Redireciona o visitante
		header("Location: inicio"); exit;
		}
		else{
		header("Location: inicio#login-erro"); exit;
		}

	}
}
catch(PDOException $e){
	echo $e->getMessage();
}

?>