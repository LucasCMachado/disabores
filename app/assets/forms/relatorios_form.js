// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#mensal-SaveForm', function() {
	  	  
	   $.postJSON('assets/php/relatorios/mensal.php',{data_mensal: data_mensal, ajax: 'true'}, function(j){
        	var options = '';	
			for (var i = 0; i < j.length; i++) {
					options += '<tr>'+
				'<td>' + j[i].cliente + '</td>'+
				'<td>' + j[i].valor + '</td>'+
				'<td>' + j[i].periodo + '</td>'+
				'<td>' + j[i].data + '</td>'+
				'</tr>';	
			}
			$('tbody > tr').remove().show('slow');
			$('tbody').html(options);
    });   
	     return false;
    }); 
	/* Data Insert Ends Here */
	});