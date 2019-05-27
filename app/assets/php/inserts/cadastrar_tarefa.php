<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();
    
    if($_POST)
    {
        $nome = $_POST['nome'];
        $data = inverteData($_POST["data"]);
        $status = 'pendente';

        try{
            
            $stmt = $dbh->prepare("INSERT INTO tarefa(nome, data, status) VALUES(:nome, :data, :status)");
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":data", $data, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);        

            if($stmt->execute())
            {

                $last_id = $dbh->lastInsertId();
                echo '<tr>
                        <td><button class="btn btn-warning btn-fill" style="font-size: 30px;padding: 0 15px;"><i class="pe-7s-stopwatch"></i></button></td>
                        <td>'.$nome.'</td>
                        <td>'.inverteData($data).'</td>
                        <td>
                            <button type="button" id="'.$last_id.'" data-name="'.$nome.'" data-data="'.$data.'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
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
    function inverteData($data_inverte){
        if(count(explode("/",$data_inverte)) > 1){
            return implode("-",array_reverse(explode("/",$data_inverte)));
        }elseif(count(explode("-",$data_inverte)) > 1){
            return implode("/",array_reverse(explode("-",$data_inverte)));
        }
    }

?>