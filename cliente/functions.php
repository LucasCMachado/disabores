<?php

date_default_timezone_set('America/Sao_Paulo');

function somaPagamentoParcialAtual($dbh,$id_usuario){
    $dataLocal = date('Y-m');
    $id = $id_usuario;
    $valor_total=0;
    $stmt = $dbh->prepare('SELECT SUM(valor_pago) as valorTotal FROM pagamentos_parciais LEFT JOIN cliente ON cliente.id=pagamentos_parciais.id_cliente WHERE pagamentos_parciais.id_cliente=:id_cliente && pagamentos_parciais.data LIKE "'.$dataLocal.'%"');
    $stmt->bindParam(":id_cliente", $id, PDO::PARAM_INT);
    $stmt->execute();
    $totalVenda = $stmt->fetch();

    if ($totalVenda['valorTotal']>0) {
        echo 'R$ '.$totalVenda['valorTotal'];
    }else{
        echo 'Nenhum pagamento';
    }
}

function totalFaturaAtual($dbh,$id_usuario){
	$dataLocal = date('Y-m');
	$id = $id_usuario;
    $mes_atual = $dataLocal;
    $valor_total=0;

    $stmt = $dbh->prepare('SELECT venda.valor_total as "valor" FROM venda LEFT JOIN cliente ON cliente.id=venda.id_cliente WHERE venda.id_cliente=:id_cliente && venda.data_venda LIKE "'.$mes_atual.'%"');
    $stmt->bindParam(":id_cliente", $id, PDO::PARAM_INT);
    $stmt->execute();

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

        $valor_total += $row["valor"];
    }
    echo $valor_total;
}

function faturaAtual($dbh,$id_usuario){
    $dataLocal = date('Y-m');
    $id = $id_usuario;

    $mes_atual = $dataLocal;
    $valor_total=0;

    $stmt = $dbh->prepare('SELECT venda.id as "idVenda", venda.data_venda as "dataVenda", venda.valor_total as "valor", periodo.nome as "nomePeriodo" FROM venda LEFT JOIN cliente ON cliente.id=venda.id_cliente LEFT JOIN periodo ON periodo.id=venda.id_periodo WHERE venda.id_cliente=:id_cliente && venda.data_venda LIKE "'.$mes_atual.'%" ORDER BY venda.data_venda');
    $stmt->bindParam(":id_cliente", $id, PDO::PARAM_INT);
    $stmt->execute();

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

        $idVenda = $row['idVenda'];

        $stmt1 = $dbh->prepare("SELECT * FROM produto LEFT JOIN vendas_produtos ON vendas_produtos.id_produto=produto.id WHERE vendas_produtos.id_venda=:id_venda");

        $stmt1->execute(array(':id_venda'=>$idVenda));                      

        $stmt1->execute();

        while($row2=$stmt1->fetch(PDO::FETCH_ASSOC)){
            $lista_produtos[] = $row2['nome'];
        }
        echo '<tr>
                <td>'.$row["idVenda"].'</td>
                <td>'.$row["nomePeriodo"].'</td>
                <td>'.inverteData($row["dataVenda"]).'</td>
                <td>'.implode(", ", $lista_produtos).'</td>
                <td>R$ '.$row["valor"].'</td>
            </tr>';
        $valor_total = $valor_total+$row["valor"];

        unset($lista_produtos);

    }
}

// Lista faturas Antigas
function listarFaturas($dbh,$id_usuario){

    $dataLocal = date('Y-m');
    $id = $id_usuario;

    $mes_atual = $dataLocal;
    $valor_total=0;

    $stmt = $dbh->prepare('SELECT faturas.id as idFatura, faturas.data as dataFatura, faturas.valor_total as valor, faturas.status as status FROM faturas LEFT JOIN cliente ON cliente.id=faturas.id_cliente WHERE faturas.id_cliente=:id_cliente ORDER BY faturas.id DESC');
    $stmt->bindParam(":id_cliente", $id, PDO::PARAM_INT);
    $stmt->execute();

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

        echo '
            <tr>
                <td>'.$row["idFatura"].'</td>
                <td>'.inverteData($row["dataFatura"]).'</td>
                <td>R$ '.$row["valor"].'</td>
                <td>';if($row['status']=='PENDENTE'){echo '<span class="label label-warning">PENDENTE</span>';}else{echo '<span class="label label-success">PAGO</span>';}
                echo'</td>
                <td><a href="fatura-'.$row["idFatura"].'" class="btn btn-inverse btn-rounded m-b-5">Visualizar</a></td>
            </tr>';
    }
}

// Exibe Fatura

function dataFatura($dbh,$idFatura){
    $stmt = $dbh->prepare('SELECT data FROM faturas WHERE id=:idFatura');
    $stmt->bindParam(":idFatura", $idFatura, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch();

    return inverteData($data["data"]);
}

function statusFatura($dbh,$idFatura){
	$stmt = $dbh->prepare('SELECT status FROM faturas WHERE id=:idFatura');
    $stmt->bindParam(":idFatura", $idFatura, PDO::PARAM_INT);
    $stmt->execute();
    $status = $stmt->fetch();

    if ($status["status"]=='PENDENTE') {
        echo '<span class="label label-warning">PENDENTE</span>';
    }else{
        echo '<span class="label label-success">PAGO</span>';
    }
}

function ValorFatura($dbh,$idFatura){
    $stmt = $dbh->prepare('SELECT valor_total, multa, juros FROM faturas WHERE id=:idFatura');
    $stmt->bindParam(":idFatura", $idFatura, PDO::PARAM_INT);
    $stmt->execute();
    $valor = $stmt->fetch();

    $total = $valor["valor_total"]+$valor["multa"]+$valor["juros"];

    echo $total;
}

function valorTotalMulta($dbh,$idFatura){
    $stmt = $dbh->prepare('SELECT multa FROM faturas WHERE id=:idFatura');
    $stmt->bindParam(":idFatura", $idFatura, PDO::PARAM_INT);
    $stmt->execute();
    $valor = $stmt->fetch();

    echo "R$ ".$valor["multa"];
}

function valorTotalJuros($dbh,$idFatura){
    $stmt = $dbh->prepare('SELECT juros FROM faturas WHERE id=:idFatura');
    $stmt->bindParam(":idFatura", $idFatura, PDO::PARAM_INT);
    $stmt->execute();
    $valor = $stmt->fetch();

    echo "R$ ".$valor["juros"];
}

function faturaSelecionada($dbh,$id_usuario,$dataFatura){

    $dataLocal = inverteData($dataFatura);
    $id = $id_usuario;

    $mes_atual = substr($dataLocal, 0, -3);
    $valor_total=0;

    $stmt = $dbh->prepare('SELECT venda.id as "idVenda", venda.data_venda as "dataVenda", venda.valor_total as "valor", periodo.nome as "nomePeriodo" FROM venda LEFT JOIN cliente ON cliente.id=venda.id_cliente LEFT JOIN periodo ON periodo.id=venda.id_periodo WHERE venda.id_cliente=:id_cliente && venda.data_venda LIKE "'.$mes_atual.'%" ORDER BY venda.data_venda');
    $stmt->bindParam(":id_cliente", $id, PDO::PARAM_INT);
    $stmt->execute();

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

        $idVenda = $row['idVenda'];

        $stmt1 = $dbh->prepare("SELECT * FROM produto LEFT JOIN vendas_produtos ON vendas_produtos.id_produto=produto.id WHERE vendas_produtos.id_venda=:id_venda");

        $stmt1->execute(array(':id_venda'=>$idVenda));                      

        $stmt1->execute();

        while($row2=$stmt1->fetch(PDO::FETCH_ASSOC)){
            $lista_produtos[] = $row2['nome'];
        }
        echo '<tr>
                <td>'.$row["idVenda"].'</td>
                <td>'.$row["nomePeriodo"].'</td>
                <td>'.inverteData($row["dataVenda"]).'</td>
                <td>'.implode(", ", $lista_produtos).'</td>
                <td>R$ '.$row["valor"].'</td>
            </tr>';

        unset($lista_produtos);
    }
}

function valorTotalFaturaSelecionada($dbh,$id_usuario,$dataFatura){

    $dataLocal = inverteData($dataFatura);
    $id = $id_usuario;

    $mes_atual = substr($dataLocal, 0, -3);
    $valor_total=0;

    $stmt = $dbh->prepare('SELECT venda.valor_total as "valor" FROM venda LEFT JOIN cliente ON cliente.id=venda.id_cliente WHERE venda.id_cliente=:id_cliente && venda.data_venda LIKE "'.$mes_atual.'%"');
    $stmt->bindParam(":id_cliente", $id, PDO::PARAM_INT);
    $stmt->execute();

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

         $valor_total = $valor_total+$row["valor"];
    }

    echo $valor_total;
}

function somaPagamentoParcial($dbh,$id_usuario,$dataFatura){
    $dataLocal = inverteData($dataFatura);
    $dataLocal = substr($dataLocal, 0, -3);
    $id = $id_usuario;
    $valor_total=0;
    $stmt = $dbh->prepare('SELECT SUM(valor_pago) as valorTotal FROM pagamentos_parciais LEFT JOIN cliente ON cliente.id=pagamentos_parciais.id_cliente WHERE pagamentos_parciais.id_cliente=:id_cliente && pagamentos_parciais.data LIKE "'.$dataLocal.'%"');
    $stmt->bindParam(":id_cliente", $id, PDO::PARAM_INT);
    $stmt->execute();
    $totalVenda = $stmt->fetch();

    if ($totalVenda['valorTotal']>0) {
        echo 'R$ '.number_format($totalVenda['valorTotal'],2,",","");
    }else{
        echo 'Nenhum pagamento';
    }
}

#Funções

function inverteData($data_inverte){
	if(count(explode("/",$data_inverte)) > 1){
	    return implode("-",array_reverse(explode("/",$data_inverte)));
	}elseif(count(explode("-",$data_inverte)) > 1){
	    return implode("/",array_reverse(explode("-",$data_inverte)));
	}
}
?>