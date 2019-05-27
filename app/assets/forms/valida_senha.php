<?php 

require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

try{

	if (!empty($_POST['senha'])) {
		$id_cl = $_POST['id_cl'];
		$senha = $_POST['senha'];

		$stmt = $dbh->prepare('SELECT senha_compra FROM cliente WHERE id=:id_cl LIMIT 1');
		$stmt->bindParam(":id_cl", $id_cl, PDO::PARAM_STR);
		$stmt->execute();
		$senha_banco = $stmt->fetch();

		if ($senha == 0) {
			echo "sucesso";
		}else{

			if (password_verify($senha, $senha_banco['senha_compra'])) {
				echo "sucesso";
			}
			else {
				echo 'Senha invalida';
			}
		}
	}else {
		echo 'Senha invalida';
	}	

}catch(PDOException $e){

        echo $e->getMessage();

    }

?>