<?php
require_once '../_connect/connect_pdo.php';
$dbh = Database::conexao();

switch ($_POST['op']) {
	case 2:
			//Update
			$nome = $_POST['nome'];
			$cnpj = preg_replace("/[^0-9]/", "", $_POST['cnpj']);
			$telefone = preg_replace("/[^0-9]/", "", $_POST['telefone']);
			$id = $_POST['id'];

			$stmt = $dbh->prepare("UPDATE fornecedor SET nome=:nome, telefone=:telefone, cnpj=:cnpj WHERE id=:id");
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":cnpj", $cnpj, PDO::PARAM_STR);
			$stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);

			if($stmt->execute()){
				echo 'sucesso';
			}
			else{
				echo 'erro';
			}
		break;

	case 3:
			//Desativa
			$id=$_POST['id'];
			$status=0;
			$stmt = $dbh->prepare("UPDATE fornecedor SET status=:status WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);

			if($stmt->execute()){
				echo 'sucesso';
			}
			else{
				echo 'erro';
			}
		break;

	case 4:
			//Reativa
			$id=$_POST['id'];
			$status=1;
			$stmt = $dbh->prepare("UPDATE fornecedor SET status=:status WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);

			if($stmt->execute()){
				echo 'sucesso';
			}
			else{
				echo 'erro';
			}
		break;
	
	default:
			//Insert
			$nome = $_POST['nome'];
			$cnpj = preg_replace("/[^0-9]/", "", $_POST['cnpj']);
			$telefone = preg_replace("/[^0-9]/", "", $_POST['telefone']);
			$status = 1;
			
			$stmt = $dbh->prepare("INSERT INTO fornecedor(nome, telefone, cnpj, status) VALUES(:nome, :telefone, :cnpj, :status)");
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":cnpj", $cnpj, PDO::PARAM_STR);
			$stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);

			if($stmt->execute()){
				echo 'sucesso';
			}
			else{
				echo 'erro';
			}
		break;
}


?>