$('.fornecedor-gastos-periodo').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	//Insere os valores no modal
	var dataInicial=$('#dataGastosInicial1').val();
	var dataFinal=$('#dataGastosFinal1').val();
	if (dataInicial == null || dataInicial =="") {
		swal(
		  'Ooopa!',
		  'A data inicial não pode estar em branco!',
		  'warning',
		)
	}else if (dataFinal == null || dataFinal =="") {
		swal(
		  'Ooopa!',
		  'A data final não pode estar em branco!',
		  'warning',
		)
	} else{
		$('#form-fornecedor-gastos-periodo').submit();
	}
});

$('.gastos-periodo').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	//Insere os valores no modal
	var dataInicial=$('#dataGastosInicial2').val();
	var dataFinal=$('#dataGastosFinal2').val();
	if (dataInicial == null || dataInicial =="") {
		swal(
		  'Ooopa!',
		  'A data inicial não pode estar em branco!',
		  'warning',
		)
	}else if (dataFinal == null || dataFinal =="") {
		swal(
		  'Ooopa!',
		  'A data final não pode estar em branco!',
		  'warning',
		)
	} else{
		$('#form-gastos-periodo').submit();
	}
});