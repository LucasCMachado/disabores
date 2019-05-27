<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

	
	if(!empty($_POST))
	{
		$dia = $_POST['dia'];
		$cardapio = $_POST['cardapio'];
		
		$stmt = $dbh->prepare("UPDATE cardapio SET cardapio=:cardapio WHERE dia=:dia");
		$stmt->bindParam(":cardapio", $cardapio, PDO::PARAM_STR);
        $stmt->bindParam(":dia", $dia);
		
		if($stmt->execute())
		{
			echo "Cadastro editado com sucesso.";
		}
		else{
			echo "Ouve um problema ao realizar a edição do cadastro, por favor tente mais tarde.";
		}
	}

?>