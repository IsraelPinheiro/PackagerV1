$(document).ready(function(){
    //Button Ajuda
    $(".btn-ajuda").click(function(){
        $.get("/ajuda", function(data){
            $("body").append(data);
            $(".modal").modal("toggle");
        });
    });

    //Button Política de Privacidade
	$(".btn-privacidade").click(function(){
		$.get("/privacidade", function(data){
			$("body").append(data);
			$(".modal").modal("toggle");
		});
    });

	//Button Sobre
	$(".btn-sobre").click(function(){
		$.get("/sobre", function(data){
			$("body").append(data);
			$(".modal").modal("toggle");
		});
    });
    
	//Alterar Senha - Exibir Painel
	$(".btn-senha").click(function(){
		$.get("/opcoes/senha", function(data){
			$("body").append(data);
			$(".modal").modal("toggle");
		});
    });

    //Alterar Senha - Salvar
    $(document).on("click", ".btn-update-senha",function(){
        var formData = $("#FormModal").serialize();
		$.ajax({
			type:"POST",
			url:"opcoes/senha",
			data: formData,
			dataType: 'json',
			success: function(data){
                $("body").append(data);
                $('.modal').modal('hide');
				alertify.notify(data.message, 'success', 2);
			},
			error: function(data){
                var errors = data.responseJSON.errors;
                //alertify.notify(errors[Object.keys(errors)[0]][0], 'error', 2);
                errors[Object.keys(errors)[0]].forEach(function(entry) {
                    alertify.notify(entry, 'error', 2);
                });
			}
		});
    });

	//Close Modal
	$(document).on("hidden.bs.modal", ".modal", function(){
		$(this).remove();
	});
});