<?php
require_once '../../../_connect/connect_pdo.php';
$dbh = Database::conexao();

    
    if($_POST)
    {
        $id = $_POST['id'];
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
        $valor = str_replace(',', '', $valor);
        
        try{
            
            $stmt = $dbh->prepare("UPDATE orcamentos SET nome_contratante=:nome_contratante, email=:email, telefone=:telefone, estado=:estado, cidade=:cidade, endereco=:endereco, complemento=:complemento, data_entrada=:data_entrada, data_entrega=:data_entrega, descricao=:descricao, valor=:valor WHERE id=:id");

            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
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