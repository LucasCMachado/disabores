<!doctype html>
<html lang="en">
<head>
<?php 
include("_head.html");    
?>
</head>
<body>

<div class="wrapper">
<?php
$page = 'periodo';
include("_sidebar.php");
?>

<div class="main-panel">

<?php 
include("_navbar.php");
?>            

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">Periodos</h4>
            </div>
            <div class="content">
                <div class="row">
                <?php include_once 'menu_periodos.php'; 
                /*A conexão do banco se encontra aqui*/?>
                </div>
                <div class="row" id="forms_manha" >
                <div class="col-md-12">
                <!-- Vendas -->
                    <form method='post' id='manha-SaveForm' action="#" role="form">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="cliente">Cliente: *</label>                                        
                            <select class="form-control select2" name="cliente" id="cliente" required="">
                            <option value="" disabled="" selected=""></option>
                                <?php
                                
                                $stmt=$dbh->prepare("SELECT * FROM cliente ORDER BY nome ASC");
                                $stmt->execute();  
                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                    $conta='';

                                    if ($row['status_conta']>0) {
                                        
                                    }else{
                                        $conta='style="color:red!important;"';
                                    }

                                    echo '<option '.$conta.' value="'.$row['id'].'">'.$row['nome'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">       
                        <div class="form-group">
                        <label for="cliente">Produtos *</label> 
                            <select class="multipleSelect form-control" name="produto[]" id="produto" multiple="multiple" style="height: 40px" required="">
                                <?php                                
                                    $stmt=$dbh->prepare("SELECT * FROM produto ORDER BY nome ASC");
                                    $stmt->execute();
                                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                        echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>                                                                  
                    </div>
                    <?php
                    
                    $stmt=$dbh->prepare("SELECT * FROM periodo WHERE status='aberto'");
                    $stmt->execute();
                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        if ($row['nome']=='Almoço') {                           
                        echo '
                        <div class="col-md-4 extra-fields">
                            <div class="form-group"> 
                              <label class="control-label">Valor do almoço *</label> 
                              <input type="text" name="valor" id="valor" class="form-control money" placeholder="Insira o valor do almoço"> 
                            </div>
                        </div>';
                        }else{
                        echo '
                        <div class="col-md-4 extra-fields">
                            <div class="form-group"> 
                              <label class="control-label">Valor do peso do produto *</label> 
                              <input type="text" name="valor_kg" id="valor_kg" class="form-control money" placeholder="Insira o valor do produto"> 
                            </div>
                        </div>';
                        }
                    }
                    ?>
                    <div class="col-md-4 multiple-fields" style="display: none;">
                        <div class="form-group"> 
                          <label class="control-label">Número de itens</label> 
                          <input type="text" name="num_item" id="num_item" class="form-control money" placeholder="Insira a quantidade de itens"> 
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" id="envia_compra" class="btn btn-info btn-fill pull-left">Salvar</button>
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="javascript:void(0);" class="extra-fields" id="multiplos">Vendas Multiplas</a>
                            <a href="javascript:void(0);" class="multiple-fields" id="simples" hidden>Vendas Simples</a>
                        </div> 
                    </div>                 
                    </form>

                <!-- /Vendas -->
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="lista_vendas" class="card">
                <div class="header">
                    <h4 class="title">Vendas</h4>
                    <p class="category">Vendas Realizadas no periodo aberto.</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Cliente</th>
                            <th>Produtos</th>
                            <th>Valor</th>
                            <th>Opções</th>
                        </thead>
                        <tbody id="tabela">
                            <?php
                           
                            // Verifica o periodo aberto
                            try{
                            $stmt=$dbh->prepare("SELECT id FROM periodo WHERE status = 'aberto'");
                            $stmt->execute();  
                            $row=$stmt->fetch(PDO::FETCH_ASSOC);
                            $id_periodo = $row["id"];
                            
                            // Lista as 
                            date_default_timezone_set('America/Sao_Paulo');
                            // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
                            $data = date("Y/m/d");


                            $stmt1 = $dbh->prepare('SELECT venda_temp.id as "idVenda", venda_temp.valor_total as "valor", cliente.nome as "nomeCliente" FROM venda_temp LEFT JOIN cliente ON cliente.id=venda_temp.id_cliente WHERE venda_temp.id_periodo=:id_periodo AND venda_temp.data_venda=:data ORDER BY venda_temp.id DESC');
                            $stmt1->bindParam(":id_periodo", $id_periodo, PDO::PARAM_STR);
                            $stmt1->bindParam(":data", $data, PDO::PARAM_STR);
                            $stmt1->execute();                           

                            foreach ($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row1) {

                                $idVenda = $row1['idVenda'];

                                $stmt2 = $dbh->prepare("SELECT * FROM produto LEFT JOIN vendas_produtos_temp ON vendas_produtos_temp.id_produto=produto.id WHERE vendas_produtos_temp.id_venda=:id_venda");
                                $stmt2->execute(array(':id_venda'=>$idVenda));                      
                                $stmt2->execute();
                                while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
                                {
                                    $lista_produtos[] = $row2['nome'];
                                }

                                echo '
                                <tr>
                                    <td>'.$row1["nomeCliente"].'</td>
                                    <td>'.implode(", ", $lista_produtos).'</td>
                                    <td>R$'.$row1["valor"].'</td>
                                    <td>
                                        <button type="button" id="'.$row1["idVenda"].'" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs delete-link">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>';
                                unset($lista_produtos);
                            }

                            }
                            catch(PDOException $e){
                                echo $e->getMessage();
                            }
                                
                            ?>            
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container-fluid">
     <p class="copyright pull-right">
        &copy; 2016 <a href="http://www.uorksis.com">Uorksis</a>
    </p>
</div>
</footer>

</div>
</div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/select2/js/select2.full.min.js"></script>
<script>
    $('.multipleSelect').select2();
    $('select').select2();
</script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>

<!-- Sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/sweetalert2/6.6.1/sweetalert2.min.js"></script>

<!-- Forms -->
<script id="script_forms" src="assets/forms/manha_form.js"></script>

<!-- Forms -->
<script src="assets/js/notify.js"></script>

<script>
    jQuery(document).ready(function($) {
        $('.money').mask('000.00', {reverse: true});
        $('.num').mask('0000');
    });
    $(document).on('click', '#multiplos', function(event) {
        $('#manha-SaveForm').attr('id', 'multiplos-SaveForm');
        $('.extra-fields').fadeOut();
        $('.multiple-fields').delay(1000).fadeIn();
        $(this).fadeOut();
    });
    $(document).on('click', '#simples', function(event) {
        $('#multiplos-SaveForm').attr('id', 'manha-SaveForm');
        $('.extra-fields').delay(1000).fadeIn();
        $('.multiple-fields').fadeOut();
        $(this).fadeOut();
    });
</script>

</html>
