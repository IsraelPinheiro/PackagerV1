$(document).ready(function(){



	//Button Options User Config
    $(".btn-options-config").click(function(){
        $.get("/options/config", function(data){
            $("body").append(data);
            $(".modal").modal("toggle");
        });
    });

    //Button Ajuda
    $(".btn-options-help").click(function(){
        $.get("/options/help", function(data){
            $("body").append(data);
            $(".modal").modal("toggle");
        });
    });

	//Button Sobre
	$(".btn-options-about").click(function(){
		$.get("/options/about", function(data){
			$("body").append(data);
			$(".modal").modal("toggle");
		});
    });
    
	//Alterar Senha - Exibir Painel
	$(".btn-options-password").click(function(){
		$.get("/options/password", function(data){
			$("body").append(data);
			$(".modal").modal("toggle");
		});
    });

    //Alterar Senha - Salvar
    $(document).on("click", ".btn-update-password",function(){
        var formData = $("#FormModal").serialize();
		$.ajax({
			type:"POST",
			url:"options/password",
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