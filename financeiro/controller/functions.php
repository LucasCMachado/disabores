<?php 
function inverteData($data_inverte){
    if(count(explode("/",$data_inverte)) > 1){
        return implode("-",array_reverse(explode("/",$data_inverte)));
    }elseif(count(explode("-",$data_inverte)) > 1){
        return implode("/",array_reverse(explode("-",$data_inverte)));
    }
}

function validaData($data_vencimento){
	$dt_atual       = date("Y-m-d"); // data atual
    $timestamp_dt_atual     = strtotime($dt_atual); // converte para timestamp Unix
     
    $dt_expira      = $data_vencimento; // data de expiração do anúncio
    $timestamp_dt_expira    = strtotime($dt_expira); // converte para timestamp Unix
     
    // data atual é maior que a data de expiração
    if ($timestamp_dt_atual > $timestamp_dt_expira) // true
      return true;
    else // false
      return false;
}
?>