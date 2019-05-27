<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

	// Fecha vendas

	$stmt0 = $dbh->prepare('SELECT * FROM venda WHERE data_venda = "2018-09-11"');
    $stmt0->execute();                           

    foreach ($stmt0->fetchAll(PDO::FETCH_ASSOC) as $row1) {                       

	        $idVenda = $row1['id'];
	        $valor_total = $row1['valor_total'];
	        //echo "ID Venda: ".$idVenda."</br>";

	        if ($valor_total=='') {
	        	//ajustaVendaProdutos($dbh, $idVenda); 
	        	updateAlmoco($dbh, $idVenda);
	        }
	        
	       // deletaVenda($dbh, $idVenda);
    }

    function ajustaVendaProdutos($dbh, $idVenda){
		
		$stmt2 = $dbh->prepare('SELECT * FROM vendas_produtos WHERE id_venda=:idVenda AND id_produto != 85');
		$stmt2->bindParam(":idVenda", $idVenda, PDO::PARAM_INT);
	    $stmt2->execute();                           

	    foreach ($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row2) {                       

		        $idVendaProduto = $row2['id'];
		        $idProdutoVenda = $row2['id_produto'];
		        echo "ID Venda Produto: ".$idVendaProduto."</br>";
		        echo "Valor: ".precoProduto($dbh, $idProdutoVenda);
		        $valor = precoProduto($dbh, $idProdutoVenda);
		        updateValor($dbh, $idVenda, $valor);
		        
	    }
	}

	function updateValor($dbh, $idVenda, $valor){
		
		$stmt3 = $dbh->prepare('UPDATE venda SET valor_total=:valor WHERE id=:idVenda');
		$stmt3->bindParam(":idVenda", $idVenda, PDO::PARAM_INT);
		$stmt3->bindParam(":valor", $valor, PDO::PARAM_STR);
	    $stmt3->execute();


	}

	function updateAlmoco($dbh, $idVenda){

		$valor=85;
		
		$stmt3 = $dbh->prepare('UPDATE venda SET valor_total=:valor WHERE id=:idVenda');
		$stmt3->bindParam(":idVenda", $idVenda, PDO::PARAM_INT);
		$stmt3->bindParam(":valor", $valor, PDO::PARAM_STR);
	    $stmt3->execute();


	}

	function precoProduto($dbh, $idProduto){
    	$stmt4 = $dbh->prepare('SELECT valor FROM produto WHERE id=:idProduto');
		$stmt4->bindParam(":idProduto", $idProduto, PDO::PARAM_INT);
	    $stmt4->execute();

	    $preco=$stmt4->fetch(PDO::FETCH_ASSOC);
	    return $preco['valor'];
    }
    
?>