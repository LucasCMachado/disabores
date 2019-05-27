<?php

require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();    

if($_POST){
    
    // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');

    // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $data = date("Y/m/d");
    $hora = date('H:i:s');        

        if (!empty($_POST['produto'])) {

        $cliente = $_POST['cliente'];
        $produtos = $_POST['produto'];

        if (!empty ($_POST['valor'])) {
           $valor_almoco = $_POST['valor'];
        }else{
            $valor_almoco = 0;
        }
        if (!empty ($_POST['valor_kg'])) {
           $valor_kg = $_POST['valor_kg'];
        }else{
            $valor_kg = 0;
        }

        $stmt=$dbh->prepare("SELECT id FROM periodo WHERE status=:status");
        $stmt->execute(array(':status'=>'aberto'));  
        $row=$stmt->fetch(PDO::FETCH_ASSOC);           

        $periodo = $row["id"];

        $stmt2 = $dbh->prepare("INSERT INTO venda_temp(id_periodo, id_cliente, data_venda, hora_venda) VALUES(:periodo, :cliente, :data, :hora)");
        $stmt2->bindParam(":periodo", $periodo, PDO::PARAM_STR);
        $stmt2->bindParam(":cliente", $cliente, PDO::PARAM_STR);
        $stmt2->bindParam(":data", $data, PDO::PARAM_STR);
        $stmt2->bindParam(":hora", $hora, PDO::PARAM_STR);
        $stmt2->execute();

            $id_venda = $dbh->lastInsertId();
            $valor_total = 0;

            foreach ($produtos as $produto) {

            if ($produto == 'Almoço') {

            $stmt3 = $dbh->prepare("INSERT INTO vendas_produtos_temp(id_produto, id_venda, valor_almoco, valor_kg) VALUES (:produto, :id_venda, :valor_almoco, :valor_kg)");
            $stmt3->bindParam(":produto", $produto, PDO::PARAM_INT);
            $stmt3->bindParam(":id_venda", $id_venda, PDO::PARAM_INT);
            $stmt3->bindParam(":valor_almoco", $valor_almoco, PDO::PARAM_STR);
            $stmt3->bindParam(":valor_kg", $valor_kg, PDO::PARAM_STR);
            $stmt3->execute();
            }

            $stmt3 = $dbh->prepare("INSERT INTO vendas_produtos_temp(id_produto, id_venda, valor_almoco, valor_kg) VALUES (:produto, :id_venda, :valor_almoco, :valor_kg)");
            $stmt3->bindParam(":produto", $produto, PDO::PARAM_INT);
            $stmt3->bindParam(":id_venda", $id_venda, PDO::PARAM_INT);
            $stmt3->bindParam(":valor_almoco", $valor_almoco, PDO::PARAM_STR);
            $stmt3->bindParam(":valor_kg", $valor_kg, PDO::PARAM_STR);
            $stmt3->execute();
            }

            foreach ($produtos as $produto) {

            $stmt4 = $dbh->prepare("SELECT nome, valor FROM produto WHERE id=:id_produto");
            $stmt4->execute(array(':id_produto'=>$produto));                   
            $stmt4->execute();
            $row2=$stmt4->fetch(PDO::FETCH_ASSOC);
            $lista_produtos[] = $row2['nome'];
            $valor_total = $valor_total + $row2['valor'];
            }

            $valor_total_total = $valor_total + $valor_almoco + $valor_kg;
            $stmt5 = $dbh->prepare("UPDATE venda_temp SET valor_total=:valor_total WHERE id=:id");
            $stmt5->bindParam(":id", $id_venda, PDO::PARAM_INT);
            $stmt5->bindParam(":valor_total", $valor_total_total, PDO::PARAM_STR);
            $stmt5->execute();

            $stmt6 = $dbh->prepare("SELECT nome FROM cliente WHERE id = $cliente");
            $stmt6->execute(array(':id_produto'=>$produto));                  
            $stmt6->execute();
            $row3=$stmt6->fetch(PDO::FETCH_ASSOC);            

            if($stmt->execute()){
                echo 'sucesso';
            }
        }  

        else{
            echo "Erro: Campo produtos vazio.";
        }  
    }
?>