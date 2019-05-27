<?php
require_once '../_connect/connect_pdo.php';
require_once './functions.php';
$dbh = Database::conexao();

switch ($_POST['op']) {
	case 2:
			//Update
			$nome = $_POST['nome'];
			$cnpj = preg_replace("/[^0-9]/", "", $_POST['cnpj']);
			$telefone = preg_replace("/[^0-9]/", "", $_POST['telefone']);
			$id = $_POST['id'];

			$stmt = $dbh->prepare("UPDATE conta SET nome=:nome, telefone=:telefone, cnpj=:cnpj WHERE id=:id");
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
			//Pagar
			$id=$_POST['id'];
			$status=0;
			$stmt = $dbh->prepare("UPDATE conta SET status=:status WHERE id=:id");
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
			//Delete
			$id=$_POST['id'];
			$stmt = $dbh->prepare("DELETE FROM conta WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);

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
			$valor = str_replace('.', '', $_POST['valor']);
			$valor = str_replace(',', '.', $valor);
			$data_entrada = inverteData($_POST['data_entrada']);
			$data_vencimento = inverteData($_POST['data_vencimento']);
			$tipo = $_POST['tipo'];
			$id_fornecedor = $_POST['id_fornecedor'];
			$status = 1;
			
			$stmt = $dbh->prepare("INSERT INTO conta(nome, valor, data_entrada, data_vencimento, tipo, status, id_fornecedor) VALUES(:nome, :valor, :data_entrada, :data_vencimento, :tipo, :status, :id_fornecedor)");
			$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->bindParam(":data_entrada", $data_entrada, PDO::PARAM_STR);
			$stmt->bindParam(":data_vencimento", $data_vencimento, PDO::PARAM_STR);
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":id_fornecedor", $id_fornecedor, PDO::PARAM_INT);

			if($stmt->execute()){
				echo 'sucesso';
			}
			else{
				echo 'erro';
			}
		break;
}


?>