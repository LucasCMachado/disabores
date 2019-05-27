<?php
    require_once './_connect/connect_pdo.php';
    $dbh = Database::conexao();

    date_default_timezone_set('America/Sao_Paulo');
    // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $data = date("Y/m/d");

    $sql2 = 'SELECT COUNT(id) AS "totalVendas" FROM venda WHERE data_venda=:data_venda';
    $sth = $dbh->prepare($sql2);
    $sth->bindValue(':data_venda', $data);
    $sth->execute();
    $totalVenda = $sth->fetch();
    

    if (!empty($totalVenda['totalVendas'])) {
        $sql2 = 'SELECT COUNT(id) AS "totalVendas" FROM venda WHERE data_venda=:data_venda';
        $sth = $dbh->prepare($sql2);
        $sth->bindValue(':data_venda', $data);
        $sth->execute();
        $totalVenda = $sth->fetch();

        /*Vendas Manha*/
        $sql2 = 'SELECT COUNT(id) AS "vendasManha" FROM venda WHERE id_periodo=:manha AND data_venda=:data_venda';
        $sth = $dbh->prepare($sql2);
        $sth->bindValue(':manha', 1);
        $sth->bindValue(':data_venda', $data);
        $sth->execute();
        $vendaManha = $sth->fetch();

        /*Vendas Tarde*/
        $sql2 = 'SELECT COUNT(id) AS "vendasAlmoco" FROM venda WHERE id_periodo=:almoco  AND data_venda=:data_venda';
        $sth = $dbh->prepare($sql2);
        $sth->bindValue(':almoco', 2);
        $sth->bindValue(':data_venda', $data);
        $sth->execute();
        $vendaAlmoco = $sth->fetch();

        /*Vendas Noite*/
        $sql2 = 'SELECT COUNT(id) AS "vendasTarde" FROM venda WHERE id_periodo=:tarde  AND data_venda=:data_venda';
        $sth = $dbh->prepare($sql2);
        $sth->bindValue(':tarde', 3);
        $sth->bindValue(':data_venda', $data);
        $sth->execute();
        $vendaTarde = $sth->fetch();

        $porc_manha = porcentagem_xn($vendaManha['vendasManha'], $totalVenda['totalVendas']);
        $porc_almoco = porcentagem_xn($vendaAlmoco['vendasAlmoco'], $totalVenda['totalVendas']);
        $porc_tarde = porcentagem_xn($vendaTarde['vendasTarde'], $totalVenda['totalVendas']);
    }    

    function porcentagem_xn ( $porcentagem, $total ) {
        return ( $porcentagem * 100 ) / $total;
    }
?>