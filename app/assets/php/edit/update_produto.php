<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

	
	if(!empty($_POST))
	{
		$id = $_POST['edit_id'];
		$nome = $_POST['edit_nome'];
        $valor = $_POST["edit_valor"];
		
		$stmt = $dbh->prepare("UPDATE produto SET nome=:nome, valor=:valor WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":valor", $valor);
		
		if($stmt->execute())
		{
			echo "Cadastro editado com sucesso.";
		}
		else{
			echo "Ouve um problema ao realizar a edição do cadastro, por favor tente mais tarde.";
		}
	}

?>