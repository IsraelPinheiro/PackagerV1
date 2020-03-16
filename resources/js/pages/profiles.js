$(document).ready(function(){
	//Buttons
	//Button New
	$(".btn-profiles-add").click(function(){
		$.get("/profiles/create", function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

	//Button Edit
	$(document).on("click", ".btn-profiles-edit",function(event){
		$.get("/profiles/"+$(event.target).data("id")+"/edit", function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
    });

    //Button Show
	$(document).on("click", ".btn-profiles-show",function(event){
		$.get("/profiles/"+$(event.target).data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

    //Button Store
	$(document).on("click", ".btn-profiles-store",function(){
		var formData = $("#FormModal").serialize();
		$.ajax({
			type:"POST",
			url:"profiles/",
			data: formData,
			dataType: 'json',
			success: function(data){
				$('.modal').modal('hide');
				swal("Sucesso", data.message, "success").then(
					(value) => {
						location.reload();
					}
				);
			},
			error: function(data){
				var errors = data.responseJSON.errors;
				swal("Erro", errors[Object.keys(errors)[0]][0], "error")
			}
		});
	});

    //Button Update
	$(document).on("click", ".btn-profiles-update",function(event){
        var id = $(event.target).data("id")
		var formData = $("#FormModal").serialize();
		$.ajax({
			type:"PUT",
			url:"profiles/"+id,
			data: formData,
			dataType: 'json',
			success: function(data){
				$('.modal').modal('hide');
				swal("Sucesso", data.message, "success").then(
					(value) => {
						location.reload();
					}
				);
			},
			error: function(data){
				var errors = data.responseJSON.errors;
				swal("Erro", errors[Object.keys(errors)[0]][0], "error")
			}
		});
	});

	//Button Deletar
	$(document).on("click", ".btn-profiles-del",function(event){
		swal({
			title: "Deseja excluir o perfil de usuário ?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		  })
		  .then((willDelete) => {if(willDelete){
				var id = $(event.target).data("id")
				$.ajax({
					url: "profiles/"+id,
					type: 'POST',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: {_method: 'delete'},
					success:function(data){
						$(event.target).closest("tr").remove();
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