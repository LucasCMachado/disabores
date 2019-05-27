<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

    
    if($_POST)
    {
        $cliente = $_POST['cliente'];
        $produtos = $_POST['produto'];
        $qtd = $_POST['num_item'];
        // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
        date_default_timezone_set('America/Sao_Paulo');
        // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
        $data = date("Y/m/d");
        $hora = date('H:i:s');
        
        try{
            
            $stmt=$dbh->prepare("SELECT id FROM periodo WHERE status=:status");
            $stmt->execute(array(':status'=>'aberto'));  
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
           
            $periodo = $row["id"];

            $stmt2 = $dbh->prepare("INSERT INTO venda(id_periodo, id_cliente, data_venda, hora_venda) VALUES(:periodo, :cliente, :data, :hora)");
            $stmt2->bindParam(":periodo", $periodo, PDO::PARAM_STR);
            $stmt2->bindParam(":cliente", $cliente, PDO::PARAM_STR);
            $stmt2->bindParam(":data", $data, PDO::PARAM_STR);
            $stmt2->bindParam(":hora", $hora, PDO::PARAM_STR);
            $stmt2->execute();

                $id_venda = $dbh->lastInsertId();

                $valor_total = 0;

                foreach ($produtos as $produto) {
                    if ($produto == 'Almoço') {

                        $stmt3 = $dbh->prepare("INSERT INTO vendas_produtos(id_produto, id_venda, valor_almoco, valor_kg) VALUES (:produto, :id_venda, :valor_almoco, :valor_kg)");
                        $stmt3->bindParam(":produto", $produto, PDO::PARAM_INT);
                        $stmt3->bindParam(":id_venda", $id_venda, PDO::PARAM_INT);
                        $stmt3->bindParam(":valor_almoco", $valor_almoco, PDO::PARAM_STR);
                        $stmt3->bindParam(":valor_kg", $valor_kg, PDO::PARAM_STR);
                        $stmt3->execute();
                    }

                    $stmt3 = $dbh->prepare("INSERT INTO vendas_produtos(id_produto, id_venda, valor_almoco, valor_kg) VALUES (:produto, :id_venda, :valor_almoco, :valor_kg)");
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
                    $valor_total = $valor_total + ($row2['valor'] * $qtd);
                }
                
                $valor_total_total = $valor_total + $valor_almoco + $valor_kg;
                $stmt5 = $dbh->prepare("UPDATE venda SET valor_total=:valor_total WHERE id=:id");
                $stmt5->bindParam(":id", $id_venda, PDO::PARAM_INT);
                $stmt5->bindParam(":valor_total", $valor_total_total, PDO::PARAM_STR);
                $stmt5->execute();

                $stmt6 = $dbh->prepare("SELECT nome FROM cliente WHERE id = $cliente");
                $stmt6->execute(array(':id_produto'=>$produto));                      
                $stmt6->execute();
                $row3=$stmt6->fetch(PDO::FETCH_ASSOC);
                

            if($stmt->execute())
            {

                $last_id = $dbh->lastInsertId();
                echo '<tr>
                        <td>'.$row3['nome'].''.$valor_almoco.'</td>
                        <td>'.implode(", ", $lista_produtos).'</td>
                        <td>R$ '.$valor_total_total.'</td>
                        <td>
                            <button type="button" id="'.$last_id.'" data-name="'.$cliente.'" data-produto="'.$produto.'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" id="'.$last_id.'" data-name="'.$cliente.'" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs delete-link">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>';
            }
            else{
                echo "Ouve um problema no cadastro, por favor tente mais tarde.";
            }   
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>