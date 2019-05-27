type = ['','info','success','warning','danger'];
    	
recuperaSenha = {

	showNotification: function(from, align){
		color = 2;
		
		$.notify({
	    	icon: "fa fa-paper-plane-o",
	    	message: "E-mail de recuperação de senha enviado!"
	    	
	    },{
	        type: type[color],
	        timer: 4000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}

contatoEnviado = {

	showNotification: function(from, align){
		color = 2;
		
		$.notify({
	    	icon: "fa fa-paper-plane-o",
	    	message: "Sua mensagem foi enviada, retornaremos assim que possível!"
	    	
	    },{
	        type: type[color],
	        timer: 4000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}

periodoAberto = {

	showNotification: function(from, align){
		color = 2;
		
		$.notify({
	    	icon: "pe-7s-unlock",
	    	message: "Período aberto."
	    	
	    },{
	        type: type[color],
	        timer: 4000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}

fecharPeriodo = {

	showNotification: function(from, align){
		color = 3;
		
		$.notify({
	    	icon: "pe-7s-power",
	    	message: "Existem períodos abertos, feche-os antes de abrir um novo."
	    	
	    },{
	        type: type[color],
	        timer: 4000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}

periodoFechado = {

	showNotification: function(from, align){
		color = 2;
		
		$.notify({
	    	icon: "pe-7s-lock",
	    	message: "Período fechado."
	    	
	    },{
	        type: type[color],
	        timer: 4000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}

problemaCadastro = {

	showNotification: function(from, align){
		color = 4;
		
		$.notify({
	    	icon: "pe-7s-attention",
	    	message: "Ouve um problema ao realizar a edição do cadastro, por favor tente mais tarde."
	    	
	    },{
	        type: type[color],
	        timer: 4000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}

sucessoCadastrousuario = {

	showNotification: function(from, align){
		color = 2;
		
		$.notify({
	    	icon: "pe-7s-smile",
	    	message: "Cadastro realizado com sucesso. Nossa área do cliente ainda não está finalizada, assim que ela estiver completa entraremos em contato no e-mail indicado. Obrigado"
	    	
	    },{
	        type: type[color],
	        timer: 6000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}

loginIncorreto = {

	showNotification: function(from, align){
		color = 3;
		
		$.notify({
	    	icon: "pe-7s-shield",
	    	message: "Login ou senha incorretos."
	    	
	    },{
	        type: type[color],
	        timer: 6000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}

operacaoRealizada = {

	showNotification: function(from, align){
		color = 2;
		
		$.notify({
	    	icon: "pe-7s-check",
	    	message: "Operação realizada com sucesso."
	    	
	    },{
	        type: type[color],
	        timer: 6000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}

operacaoNaoRealizada = {

	showNotification: function(from, align){
		color = 3;
		
		$.notify({
	    	icon: "pe-7s-check",
	    	message: "Houve um problema ao realizar a operação, por gentileza tente novamente."
	    	
	    },{
	        type: type[color],
	        timer: 6000,
	        placement: {
	            from: from,
	            align: align
	        }
	    });
	}
}