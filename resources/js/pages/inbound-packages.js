$(document).ready(function(){
    //Button Show
	$(document).on("click", ".btn-inbounds-show",function(event){
		$.get("/inbounds/"+$(event.target).data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

	//Button Download Package
	$(document).on("click", ".btn-inbounds-download",function(event){
		
	});

	//Button Link
	$(document).on("click", ".btn-inbounds-link",function(event){
		const el = document.createElement('textarea');
		el.value = window.location.origin+"/package/"+$(event.target).data("key")
		document.body.appendChild(el);
		el.select();
		el.setSelectionRange(0, 99999); /*For mobile devices*/
		document.execCommand('copy');
		document.body.removeChild(el);
        swal("Sucesso", "Link Direto copiado para a Área de Transferência", "success")
	});
});