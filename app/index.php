<!doctype html>
<html lang="en">
<head>
<?php 
include("_head.html"); 
?>
<style>
    .ct-label{
        height: 40px!important;
    }
</style>
</head>
<body>

<div class="wrapper">
<?php 
$page = 'inicio';
include("_sidebar.php");
?>

<div class="main-panel">

<?php 
include("_navbar.php");
?>            

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Porcentagem de vendas</h4>
                                <p class="category">Última atualização</p>
                            </div>
                            <div class="content">
                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Manhã
                                        <i class="fa fa-circle text-danger"></i> Almoço
                                        <i class="fa fa-circle text-warning"></i> Tarde
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Dados atualizados a cada refresh
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Quantidade de vendas por hora</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart"></div>
                                <div class="footer">
                                    <div class="legend">
                                        
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Atualizado de hora em hora
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Vendas anuais <?php echo date('Y') ?></h4>
                                <p class="category">Quantidade de vendas executadas em cada mês</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart" style="height: 280px;"></div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check"></i> Atualizado uma vez ao dia
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Tarefas</h4>
                                <p class="category">Clique na caixa para finalizar a tarefa desejada.</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                        <?php 
                                            require_once './_connect/connect_pdo.php';
                                            $dbh = Database::conexao();

                                            $stmt = $dbh->prepare('SELECT * FROM tarefa WHERE status="pendente" ORDER BY data ASC');
                                            $stmt->execute();

                                            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

                                                echo '
                                                <tr>
                                                <td>
                                                    <label class="checkbox concluir-link" data-id="'.$row["id"].'" data-name="'.$row["nome"].'">
                                                        <input type="checkbox" value="concluido" data-toggle="checkbox">
                                                    </label>
                                                </td>
                                                <td>'.$row["nome"].' - Finalizar até: <b>'.inverteData($row["data"]).'</b></td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" id="'.$row["id"].'" data-name="'.$row["nome"].'" title="Remover" class="btn btn-danger btn-simple btn-xs delete-link">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>';
                                            }
                                            function inverteData($data){
                                                if(count(explode("/",$data)) > 1){
                                                    return implode("-",array_reverse(explode("/",$data)));
                                                }elseif(count(explode("-",$data)) > 1){
                                                    return implode("/",array_reverse(explode("-",$data)));
                                                }
                                            }

                                        ?>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i>Atualizado a cada refresh
                                    </div>
                                </div>
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
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!-- Forms -->
    <script src="assets/forms/index_form.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

    <?php include './dashboards/dash_pizza.php'; ?>

    <?php include './dashboards/dash_hora.php'; ?>

    <?php include './dashboards/dash_ano.php'; ?>    

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->	
    <script>
    
        var dataSales = {
          labels: ['9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'],
          series: [
             ['<?php echo $tempo1;?>','<?php echo $tempo2;?>','<?php echo $tempo3;?>','<?php echo $tempo4;?>','<?php echo $tempo5;?>','<?php echo $tempo6;?>','<?php echo $tempo7;?>','<?php echo $tempo8;?>','<?php echo $tempo9;?>','<?php echo $tempo10;?>']
          ]
        };

        var optionsSales = {
          lineSmooth: false,
          low: 0,
          high: 300,
          showArea: true,
          height: "310px",
          axisX: {
            showGrid: true,
          },
          lineSmooth: Chartist.Interpolation.simple({
            divisor: 3
          }),
          showLine: false,
          showPoint: false,
        };

        var responsiveSales = [
          ['screen and (max-width: 640px)', {
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);


        var data = {
          labels: ['Jan - '+'<b><?php echo $totalMes1;?></b>', 'Fev - '+'<b><?php echo $totalMes2;?></b>', 'Mar - '+'<b><?php echo $totalMes3;?></b>', 'Abr - '+'<b><?php echo $totalMes4;?></b>', 'Mai - '+'<b><?php echo $totalMes5;?></b>', 'Jun - '+'<b><?php echo $totalMes6;?></b>', 'Jul - '+'<b><?php echo $totalMes7;?></b>', 'Ago - '+'<b><?php echo $totalMes8;?></b>', 'Set - '+'<b><?php echo $totalMes9;?></b>', 'Out - '+'<b><?php echo $totalMes10;?></b>', 'Nov - '+'<b><?php echo $totalMes11;?></b>', 'Dez - '+'<b><?php echo $totalMes12;?></b>'],
          series: [
            ['<?php echo $totalMes1;?>','<?php echo $totalMes2;?>','<?php echo $totalMes3;?>','<?php echo $totalMes4;?>','<?php echo $totalMes5;?>','<?php echo $totalMes6;?>','<?php echo $totalMes7;?>','<?php echo $totalMes8;?>','<?php echo $totalMes9;?>','<?php echo $totalMes10;?>','<?php echo $totalMes11;?>','<?php echo $totalMes12;?>']
          ]
        };

        var options = {
            seriesBarDistance: 12,
            axisX: {
                showGrid: true
            },
            height: '101%'
        };

        var responsiveOptions = [
          ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
              labelInterpolationFnc: function (value) {
                return value[0];
              }
            }
          }]
        ];

        Chartist.Bar('#chartActivity', data, options, responsiveOptions);

        var dataPreferences = {
            series: [
                [25, 30, 20, 25]
            ]
        };

        var optionsPreferences = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false
            }
        };
    
        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);
        
        Chartist.Pie('#chartPreferences', {
          labels: ['<?php echo number_format($porc_manha,2); ?>%','<?php echo number_format($porc_almoco,2); ?>%','<?php echo number_format($porc_tarde,2); ?>%'],
          series: [<?php echo number_format($porc_manha,2); ?>, <?php echo number_format($porc_almoco,2); ?>, <?php echo number_format($porc_tarde,2); ?>]
        });
    </script>

</html>
