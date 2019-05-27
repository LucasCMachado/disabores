<?php
	require_once './_connect/connect_pdo.php';
	$dbh = Database::conexao();

	$uf = $_REQUEST['uf'];

	$stmt = $dbh->prepare('SELECT id, nome FROM cidade WHERE uf="'.$uf.'" ORDER BY nome');
    $stmt->execute();

	$cidades = array();
	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $cidades[] = array(
			'nome'			=> $row['nome']
		);
    }

	echo( json_encode( $cidades ) );