$(document).ready(function(){
	//Button Options User Config
	$(".btn-options-config").click(function(){
		$.get("/options/config", function(data){
			$("body").append(data);
			$(".modal").modal("toggle");
		});
    });
    //Update User Config
    $(document).on("click", ".btn-update-config",function(){
        var formData = $("#FormModal").serialize();
		$.ajax({
			type:"POST",
			url:"options/config",
			data: formData,
			dataType: 'json',
			success:function(data){
				$('.modal').modal('hide');
				swal("Sucesso", data.message, "success")
			},
			error: function(data){
				var errors = data.responseJSON.errors;
				swal("Erro", errors[Object.keys(errors)[0]][0], "error")
			}
		});
    });

    //Button Options Help
    $(".btn-options-help").click(function(){
        $.get("/options/help", function(data){
            $("body").append(data);
            $(".modal").modal("toggle");
        });
    });
	//Button Options About
	$(".btn-options-about").click(function(){
		$.get("/options/about", function(data){
			$("body").append(data);
			$(".modal").modal("toggle");
		});
    });
	//Button Options Change Password - Show Modal
	$(".btn-options-password").click(function(){
		$.get("/options/password", function(data){
			$("body").append(data);
			$(".modal").modal("toggle");
		});
    });
    //Button Options Change Password - Update
    $(document).on("click", ".btn-update-password",function(){
        var formData = $("#FormModal").serialize();
		$.ajax({
			type:"POST",
			url:"options/password",
			data: formData,
			dataType: 'json',
			success:function(data){
				$('.modal').modal('hide');
				swal("Sucesso", data.message, "success")
			},
			error: function(data){
				var errors = data.responseJSON.errors;
				swal("Erro", errors[Object.keys(errors)[0]][0], "error")
			}
		});
    });
	//Close Modal
	$(document).on("hidden.bs.modal", ".modal", function(){
		$(this).remove();
	});
});