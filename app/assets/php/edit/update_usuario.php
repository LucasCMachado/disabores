<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

	
	if(!empty($_POST))
	{

        $id = $_POST['edit_id'];
        $nome = $_POST['edit_nome'];
        $email = $_POST['edit_email'];
        $senha = $_POST['edit_senha'];
        $senha_hasheada = password_hash($senha, PASSWORD_DEFAULT);
        $status = "ativo";
		
		$stmt = $dbh->prepare("UPDATE usuario SET nome=:nome, email=:email, senha=:senha, status=:status WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":senha", $senha_hasheada, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
		
		if($stmt->execute())
		{
			echo "Cadastro editado com sucesso.";
		}
		else{
			echo "Ouve um problema ao realizar a edição do cadastro, por favor tente mais tarde.";
		}
	}

?>