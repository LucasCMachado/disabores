<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

    
    if($_POST)
    {
        $nome_contratante = $_POST['nome_contratante'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $estado = $_POST['cod_estados'];
        $cidade = $_POST['cod_cidades'];
        $data_entrada = inverteData($_POST['data_entrada']);
        $data_entrega = inverteData($_POST['data_entrega']);
        $endereco = $_POST['endereco'];
        $complemento = $_POST['complemento'];
        $descricao = $_POST['descricao'];
        $valor = preg_replace('/\s+/', '', $_POST['valor']);
        $status = 'PENDENTE';
        
        try{
            
            $stmt = $dbh->prepare("INSERT INTO orcamentos(nome_contratante, email, telefone, estado, cidade, endereco, complemento, data_entrada, data_entrega, descricao, valor, status) VALUES (:nome_contratante, :email, :telefone, :estado, :cidade, :endereco, :complemento, :data_entrada, :data_entrega, :descricao, :valor, :status)");

            $stmt->bindParam(":nome_contratante", $nome_contratante, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmt->bindParam(":cidade", $cidade, PDO::PARAM_STR);
            $stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
            $stmt->bindParam(":complemento", $complemento, PDO::PARAM_STR);
            $stmt->bindParam(":data_entrada", $data_entrada, PDO::PARAM_STR);
            $stmt->bindParam(":data_entrega", $data_entrega, PDO::PARAM_STR);            
            $stmt->bindParam(":descricao", $descricao, PDO::PARAM_STR);
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);

            if($stmt->execute())
            {

                echo 'sucesso';
            }
            else{
                echo "erro";
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