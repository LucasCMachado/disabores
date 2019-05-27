<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

	
	if(!empty($_POST))
	{
		$id = $_POST['edit_id'];
		$nome = $_POST['edit_nome'];
		$status = 'concluido';
        $data = inverteData($_POST["edit_data"]);

		
		$stmt = $dbh->prepare("UPDATE tarefa SET nome=:nome, data=:data, status=:status WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
		$stmt->bindParam(":data", $data, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		
		if($stmt->execute()) 
		{
			echo "Cadastro editado com sucesso.";
		}
		else{
			echo "Ouve um problema ao realizar a edição do cadastro, por favor tente mais tarde.";
		}
	}
	function inverteData($data_inverte){
        if(count(explode("/",$data_inverte)) > 1){
            return implode("-",array_reverse(explode("/",$data_inverte)));
        }elseif(count(explode("-",$data_inverte)) > 1){
            return implode("/",array_reverse(explode("-",$data_inverte)));
        }
    }

?>