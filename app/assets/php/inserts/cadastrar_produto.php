<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();
    
    if($_POST)
    {
        $nome = $_POST['nome'];
        $valor = $_POST["valor"];
        
        try{
            
            $stmt = $dbh->prepare("INSERT INTO produto(nome, valor) VALUES(:nome,:valor)");
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

            if($stmt->execute())
            {
                $last_id = $dbh->lastInsertId();
                echo '<tr>
                        <td>'.$nome.'</td>
                        <td>R$ '.$valor.'</td>
                        <td>
                            <button type="button" id="'.$last_id.'" data-name="'.$nome.'" data-value="'.$valor.'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" id="'.$last_id.'" data-name="'.$nome.'" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs delete-link">
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