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
$page = 'relatorios';
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
                <h4 class="title">Relatórios de vendas</h4>
            </div>
            <div class="content">
                <div class="row" id="forms_relatorios" >
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <form method='post' action="relatorios-venda-mensal" role="form">     
                        <p>Vendas mensais</p>  
                            <div class="form-group">
                              <label class="control-label">Indique o mês</label> 
                              <input type="text" name="data_mensal" id="data_mensal" class="form-control date" placeholder="Ex.: 01/2017">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-fill">Pesquisar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <form method='post' action="relatorios-venda-cliente" role="form">
                            <p>Vendas por cliente</p>       
                            <div class="form-group">
                            <label for="cliente">selecione o cliente: *</label>                                        
                                <select class="form-control select2" name="cliente" id="cliente">
                                <option value="" disabled="" selected=""></option>
                                    <?php
                                    require_once './_connect/connect_pdo.php';
                                    $dbh = Database::conexao();
                                    $stmt=$dbh->prepare("SELECT * FROM cliente ORDER BY nome");
                                    $stmt->execute();  
                                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

                                        echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-fill">Pesquisar</button>
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h4 class="title">Relatórios de Clientes</h4>
            </div>
            <div class="content">
                <div class="row" id="forms_relatorios" >
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <form method='post' action="relatorios-inadimplentes" role="form">     
                        <p>Clientes inadimplentes</p>  
                            <div class="form-group">
                              <label class="control-label">Indique o mês e o ano desejados</label> 
                              <input type="text" name="mes_desejado" id="mes_desejado" class="form-control date" placeholder="Ex.: 01/2017">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-fill">Pesquisar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <form method='post' action="relatorios-faturas" role="form">
                        <p>Todas as faturas</p>       
                            <div class="form-group"> 
                              <label class="control-label">Indique o mês e o ano desejados</label> 
                              <input type="text" name="data_fatura" id="data_fatura" class="form-control date" placeholder="Ex.: 04/2017">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-fill">Pesquisar</button>
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h4 class="title">Relatórios de Pordutos</h4>
            </div>
            <div class="content">
                <div class="row" id="forms_relatorios" >
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <form method='post' action="relatorios-produtos-periodos" role="form">     
                        <p>Vendas de produtos por período</p>  
                            <div class="form-group">
                              <label class="control-label">Indique a data inicial da pesquisa</label> 
                              <input type="text" name="dataInicial" id="dataInicial" class="form-control date-full" placeholder="Ex.: 01/01/2017">
                            </div>
                            <div class="form-group">
                              <label class="control-label">Indique a data final da pesquisa</label> 
                              <input type="text" name="dataFinal" id="dataFinal" class="form-control date-full" placeholder="Ex.: 31/12/2017">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-fill">Pesquisar</button>
                            </div>
                        </form>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="footer">
    <div class="container-fluid">
     <p class="copyright">
        &copy; 2016 <a href="http://www.uorksis.com">Uorksis</a>
    </p>
</div>
</footer>

</div>
</div>
</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Forms -->
<script src="assets/forms/relatorios_form.js"></script>

<!-- Forms -->
<script src="assets/mask/dist/jquery.mask.min.js"></script>

<script>
    jQuery(document).ready(function($) {
        $('.date').mask('00/0000');
        $('.date-full').mask('00/00/0000');
        $('.bloco').on('click', function(event) {
        $('form').css('display', 'none');
        var RelatorioSolicitado = $(this).data('relatorio');
        $('#'+RelatorioSolicitado+'-SaveForm').toggle( "slow" );
        });
    });
</script>

</html>
