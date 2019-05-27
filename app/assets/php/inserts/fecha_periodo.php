<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/loading.css">
    <style type="text/css">
        @font-face {
            font-family: gothamUltra;
            src: url(assets/fonts/Gotham-Ultra.otf);
        }
        @font-face {
            font-family: gothamBold;
            src: url(assets/fonts/Gotham-Bold.otf);
        }
        span{
            position: absolute;
        }
        .azul{
            font-family: "gothamUltra";
            text-transform: uppercase;
            color: #315CA1;
        }
        .cinza{
            font-family: "gothamBold";          
            color: #424343;
        }
        #nomeCliente{
            top: 444px;
            left: 485px;
            max-width: 1120px;
            width: 1112px;
            text-align: center;
            font-size: 53px;
        }
        #assessment{
            top: 601px;
            left: 485px;
            max-width: 1120px;
            width: 1112px;
            text-align: center;
            font-size: 44px;
        }
        #cargaHoraria{
            top: 667px;
            left: 1188px;
            max-width: 250px;
            width: 250px;
            text-align: left;
            font-size: 39px;
        }
        #data{
            top: 720px;
            left: 615px;
            max-width: 810px;
            width: 810px;
            text-align: center;
            font-size: 39px;
        }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    </head>
<body>
<div style="width: 100vw;height: 100vh;position: absolute;background-color: #2062af;z-index: 1">
    <div class="wrap">
        <div class="loading">
            <div class="bounceball"></div>
            <div class="text" style="font-family: gothamUltra;">Fechando período, aguarde...</div>              
        </div>
    </div>
</div>
</body>
</html>';
?>

<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

$id = $_GET['id'];
// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$data_fechamento = date("Y/m/d");
$hora_fechamento = date('H:i:s');
$status = "fechado";

fechaPeriodo($dbh, $id,$data_fechamento,$hora_fechamento,$status);

// Fecha vendas

$stmt = $dbh->prepare('SELECT COUNT(id) as temVenda FROM venda_temp');
$stmt->execute();
$result = $stmt->fetch();

$numVenda=$result['temVenda'];

if ($numVenda > 0) {

    $stmt0 = $dbh->prepare('SELECT * FROM venda_temp ORDER BY id DESC');
    $stmt0->execute();                           

    foreach ($stmt0->fetchAll(PDO::FETCH_ASSOC) as $row1) {                       

            $idPeriodo = $row1['id_periodo'];
            $idCliente = $row1['id_cliente'];
            $dataVenda = $row1['data_venda'];
            $horaVenda = $row1['hora_venda'];
            $valorTotal = $row1['valor_total'];

            $stmt2 = $dbh->prepare("INSERT INTO venda(id_periodo, id_cliente, data_venda, hora_venda, valor_total) VALUES(:periodo, :cliente, :data, :hora, :total)");
            $stmt2->bindParam(":periodo", $idPeriodo, PDO::PARAM_INT);
            $stmt2->bindParam(":cliente", $idCliente, PDO::PARAM_INT);
            $stmt2->bindParam(":data", $dataVenda, PDO::PARAM_STR);
            $stmt2->bindParam(":hora", $horaVenda, PDO::PARAM_STR);
            $stmt2->bindParam(":total", $valorTotal, PDO::PARAM_STR);
            $stmt2->execute();

            $idUltimaVenda = $dbh->lastInsertId();

            $idVenda = $row1['id'];
            $stmt3 = $dbh->prepare('SELECT * FROM vendas_produtos_temp WHERE id_venda=:id_venda');
            $stmt3->bindParam(":id_venda", $idVenda, PDO::PARAM_INT);
            $stmt3->execute();                           

            foreach ($stmt3->fetchAll(PDO::FETCH_ASSOC) as $row2) {

                $produto = $row2['id_produto'];
                $valor_almoco = $row2['valor_almoco'];
                $valor_kg = $row2['valor_kg'];

                $stmt4 = $dbh->prepare("INSERT INTO vendas_produtos(id_produto, id_venda, valor_almoco, valor_kg) VALUES (:produto, :id_venda, :valor_almoco, :valor_kg)");
                $stmt4->bindParam(":produto", $produto, PDO::PARAM_INT);
                $stmt4->bindParam(":id_venda", $idUltimaVenda, PDO::PARAM_INT);
                $stmt4->bindParam(":valor_almoco", $valor_almoco, PDO::PARAM_STR);
                $stmt4->bindParam(":valor_kg", $valor_kg, PDO::PARAM_STR);
                $stmt4->execute();

            }

            deletaVendaProdutos($dbh, $idVenda);
            deletaVenda($dbh, $idVenda);

            header("Location:periodos");
    }
 } else{
   header("Location:periodos");
}

function deletaVendaProdutos($dbh, $idVenda){
        $stmt2 = $dbh->prepare("DELETE FROM vendas_produtos_temp WHERE id_venda=:idVenda");
        $stmt2->bindParam(":idVenda", $idVenda, PDO::PARAM_INT);
        $stmt2->execute();
}

function deletaVenda($dbh, $idVenda){
    $stmt3 = $dbh->prepare("DELETE FROM venda_temp WHERE id=:idVenda");
    $stmt3->bindParam(":idVenda", $idVenda, PDO::PARAM_INT);
    $stmt3->execute();
}

function fechaPeriodo($dbh, $id,$data_fechamento,$hora_fechamento,$status){

        $stmt5 = $dbh->prepare("UPDATE periodo SET status=:status WHERE id=:id");
        $stmt5->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt5->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt5->execute();

        $stmt6 = $dbh->prepare("UPDATE controle_periodo SET data_fechamento=:data_fechamento, hora_fechamento=:hora_fechamento");
        $stmt6->bindParam(":data_fechamento", $data_fechamento, PDO::PARAM_STR);
        $stmt6->bindParam(":hora_fechamento", $hora_fechamento, PDO::PARAM_STR);
        $stmt6->execute();
}
?>