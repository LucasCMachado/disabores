<!doctype html>
<html lang="en">
<head>
<?php
include("_head.html"); 
?>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
</head>
<body>

<div class="wrapper">
<?php 
$page = 'orcamentos';
include("_sidebar.php");
?>

<div class="main-panel">

<?php 
include("_navbar.php");
?>
<?php 
require_once './_connect/connect_pdo.php';
$dbh = Database::conexao();

$edit_id = $_GET['id'];

$sql = 'SELECT * FROM orcamentos WHERE id=:edit_id';
$sth = $dbh->prepare($sql);
$sth->bindValue(':edit_id', $edit_id);
$sth->execute();
$dadosOrcamento = $sth->fetch();

function inverteData($data_inverte){
    if(count(explode("/",$data_inverte)) > 1){
        return implode("-",array_reverse(explode("/",$data_inverte)));
    }elseif(count(explode("-",$data_inverte)) > 1){
        return implode("/",array_reverse(explode("-",$data_inverte)));
    }
}
?>     

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Editar orçamento</h4>
                    </div>
                    <div class="content"></div>
                </div>
            </div>
        </div>
    <form method='post' id='orcamento-UpdateForm' action="#" role="form">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="header">
                                <h5 class="title">Dados do contratante</h5>
                                <div class="content"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nome contratante *</label>
                                    <input type="text" id="nome_contratante" name="nome_contratante" class="form-control" required="" value="<?php echo $dadosOrcamento['nome_contratante']; ?>">
                                    <input type="text" id="id" name="id" class="form-control" required="" value="<?php echo $dadosOrcamento['id']; ?>" hidden>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">E-mail *</label>
                                    <input type="email" id="email" name="email" class="form-control" required="" value="<?php echo $dadosOrcamento['email']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="telefone">Telefone de contato</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control fone" required="" value="<?php echo $dadosOrcamento['telefone']; ?>">
                                </div>
                            </div>
                            <div class="header">
                                <h5 class="title">Dados do orçamento</h5>
                                <div class="content"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cod_estados">Estado da entrega</label>
                                    <select class="form-control select2" name="cod_estados" id="cod_estados" style="height: 40px" required="">
                                    <?php 
                                        $sql2 = 'SELECT uf, nome FROM estado WHERE uf=:uf';
                                        $sth = $dbh->prepare($sql2);
                                        $sth->bindValue(':uf', $dadosOrcamento['estado']);
                                        $sth->execute();
                                        $estado = $sth->fetch();
                                    ?>
                                    <option value="<?php echo $estado['uf']; ?>"> <?php echo $estado['nome']; ?> </option>

                                        <?php                                        
                                        $stmt=$dbh->prepare("SELECT * FROM estado");
                                        $stmt->execute();
                                        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

                                            echo '<option value="'.$row['uf'].'">'.$row['nome'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <span class="carregando" hidden>Aguarde, carregando...</span>
                                    <label>Cidade da entrega</label>
                                    <select class="form-control select2" name="cod_cidades" id="cod_cidades" required="">
                                        <option value="<?php echo $dadosOrcamento['cidade']; ?>" selected><?php echo $dadosOrcamento['cidade']; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="endereco">Endereço *</label>
                                    <input type="text" id="endereco" name="endereco" class="form-control" required="" value="<?php echo $dadosOrcamento['endereco']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" id="complemento" name="complemento" class="form-control" value="<?php echo $dadosOrcamento['complemento']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="data_entrada">Data entrada *</label>
                                    <input type="text" id="data_entrada" name="data_entrada" class="form-control date" required="" value="<?php echo inverteData($dadosOrcamento['data_entrada']); ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="data_entrega">Data entrega *</label>
                                    <input type="text" id="data_entrega" name="data_entrega" class="form-control date" required="" value="<?php echo inverteData($dadosOrcamento['data_entrega']); ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição do orçamento</label>
                                    <textarea name="descricao" id="<?php echo $page;?>" rows="15" class="form-control" placeholder="Descreva aqui os itens de seu orçamento" required="" value="<?php echo $dadosOrcamento['descricao']; ?>">
                                    <?php echo $dadosOrcamento['descricao']; ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="valor">Valor total *</label>
                                    <input type="text" id="valor" name="valor" class="form-control money" required="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Salvar orçamento</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>                                
                        </div>                                        
                    </div>
                </div>
            </div>           
        </div>
    </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" type="text/javascript"></script>
<script>
    $('.select2').select2();
</script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Forms -->
<script src="assets/forms/orcamento_form.js"></script>

<!-- Sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/sweetalert2/6.6.1/sweetalert2.min.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>

<script>
    jQuery(document).ready(function($) {
        $('.fone').mask('(00) 00000-0000');
        $('.date').mask('00/00/0000');

        $('.money').maskMoney();

        $('.money').on('click mousedown mouseup focus blur keydown change input', function(event) {
            console.log('This Happened:'+ event.type);
        });

        $('.money').val(<?php echo $dadosOrcamento['valor']; ?>);
    });

    
</script>
<script>
jQuery(document).ready(function(){
    $('#cod_estados').change(function(){
        if( $(this).val() ) {
            $('#cod_cidades').hide();
            $('.carregando').show();
            $.getJSON('cidades.ajax.php?search=',{uf: $(this).val(), ajax: 'true'}, function(j){
                var options = '<option value="">Selecione a cidade</option>';   
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].nome + '">' + j[i].nome + '</option>';
                }   
                $('#cod_cidades').html(options).show();
                $('.carregando').hide();
            });
        } else {
            $('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
        }
    });
});
</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( '<?php echo $page;?>' );
</script>

</html>
