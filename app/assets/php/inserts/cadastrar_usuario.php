<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

    
    if($_POST)
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if (!empty($senha)) {
           $senha_hasheada = password_hash($senha, PASSWORD_DEFAULT);
        }
        $status = "ativo";
        
        
        try{
            
            $stmt = $dbh->prepare("INSERT INTO usuario(nome, email, senha, status) VALUES(:nome, :email, :senha, :status)");
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":senha", $senha_hasheada, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);

            if($stmt->execute())
            {
                $last_id = $dbh->lastInsertId();

                echo '<tr>
                        <td>'.$nome.'</td>
                        <td>'.$email.'</td>
                        <td>'.$status.'</td>
                        <td>
                            <button type="button" id="'.$last_id.'" data-name="'.$nome.'" data-email="'.$email.'" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs edit-link">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" id="'.$last_id.'" data-name="'.$nome.'" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs delete-link">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>';
            }
            else{
                echo "<tr>Ouve um problema no cadastro, por favor tente mais tarde.</tr>";
            }   
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>