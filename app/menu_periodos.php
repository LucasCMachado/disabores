<?php 
require_once './_connect/connect_pdo.php';
$dbh = Database::conexao(); 

    $stmt2=$dbh->prepare("SELECT * FROM periodo");
    $stmt2->execute();
foreach ($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row2) {
    echo '
    <div class="col-md-2">
    <a href="javascript:void(0);" id="'.$row2["id"].'" data-nome="'.$row2["nome"].'"';
      if ($row2["status"] == "aberto") {
        echo 'class="periodo_aberto"><div class="alert alert-success alert-with-icon">';
      } 
      else { 
        echo 'class="periodo"><div class="alert alert-warning alert-with-icon">';
      }
      if ($row2["nome"] == "Manhã") {
         echo '<span data-notify="icon" class="pe-7s-sun"></span>';
      }
      if ($row2["nome"] == "Almoço") {
         echo '<span data-notify="icon" class="pe-7s-wine"></span>';
      }
      if ($row2["nome"] == "Tarde") {
         echo '<span data-notify="icon" class="pe-7s-coffee"></span>';
      }
      if ($row2["nome"] == "Outros Eventos") {
         echo '<span data-notify="icon" class="pe-7s-date"></span>';
      }echo'
            <span>'.$row2["nome"].'</span>
        </div>
    </a>
    </div>';
}
?>