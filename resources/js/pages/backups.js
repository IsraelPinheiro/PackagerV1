$(document).ready(function(){
	//Buttons
	//Button New
	$(".btn-backups-run").click(function(){
		$.get("/backups/create", function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

    //Button Show
	$(document).on("click", ".btn-backups-show",function(event){
		$.get("/backups/"+$(event.target).data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
    });

    //Button Dowload
	$(document).on("click", ".btn-backups-download",function(event){
		$.get("/backups/"+$(event.target).data("id")+"/edit");
    });
    
    //Button Restore
	$(document).on("click", ".btn-backups-restore",function(event){
		swal("Indisponível", "Restauração de Backups indisponível", "warning")
	});

	//Button Deletar
	$(document).on("click", ".btn-backups-del",function(event){
		swal({
			title: "Deseja excluir o Backup ?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		  })
		  .then((willDelete) => {if(willDelete){
				var id = $(event.target).data("id")
				$.ajax({
					url: "backups/"+id,
					type: 'POST',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: {_method: 'delete'},
					success:function(data){
						$(event.target).closest("tr").remove()
						swal("Sucesso", data.message, "success")
					},
					error:function(data){
						var errors = data.responseJSON;
						swal("Erro", errors[Object.keys(errors)[0]], "error")
					}
				});
			}
		});
	});
});