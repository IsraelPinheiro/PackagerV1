$(document).ready(function(){
	//Buttons
	//Button New
	$(".btn-users-add").click(function(){
		$.get("/users/create", function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

	//Button Edit
	$(document).on("click", ".btn-users-edit",function(event){
		$.get("/users/"+$(event.target).data("id")+"/edit", function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
    });

    //Button Show
	$(document).on("click", ".btn-users-show",function(event){
		$.get("/users/"+$(event.target).data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

    //Button Store
	$(document).on("click", ".btn-users-store",function(){
		var formData = $("#FormModal").serialize();
		$.ajax({
			type:"POST",
			url:"users/",
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
	$(document).on("click", ".btn-users-update",function(event){
        var id = $(event.target).data("id")
		var formData = $("#FormModal").serialize();
		$.ajax({
			type:"PUT",
			url:"users/"+id,
			data: formData,
			dataType: 'json',
			success: function(data){
				$('.modal').modal('hide');
				swal("Sucesso", data.message, "success").then(
					(value) => {
						location.reload()
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
	$(document).on("click", ".btn-users-del",function(event){
		swal({
			title: "Deseja excluir o usuário ?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		  })
		  .then((willDelete) => {if(willDelete){
				var id = $(event.target).data("id")
				$.ajax({
					url: "users/"+id,
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
	
	$(document).on("change", "#limitsSwitch",function(event){
		if($("#limitsSwitch").prop('checked')){
			$("#storageLimits").removeClass("d-none")
		}
		else{
			$("#storageLimits").addClass("d-none")
		}
	});
});