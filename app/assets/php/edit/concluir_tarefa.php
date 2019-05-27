<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

	
	if(!empty($_POST))
	{
		$id = $_POST['conclui'];
		$status = "concluida";
		
		$stmt = $dbh->prepare("UPDATE tarefa SET status=:status WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
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