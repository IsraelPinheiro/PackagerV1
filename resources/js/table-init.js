$(document).ready(function(){
	//Inicialização DataTables
	dataTable = $('.datatable').DataTable({
		"pageLength": 10,
		"language": {
			"sEmptyTable": "Nenhum registro encontrado",
			"sInfo": "Exibindo de _START_ à _END_ de _TOTAL_ registros",
			"sInfoEmpty": "Exibindo 0 até 0 de 0 registros",
			"sInfoFiltered": "(Filtrados de _MAX_ registros)",
			"sInfoPostFix": "",
			"sInfoThousands": ".",
			"sLengthMenu": "_MENU_ resultados por página",
			"sLoadingRecords": "Carregando...",
			"sProcessing": "Processando...",
			"sZeroRecords": "Nenhum registro encontrado",
			"sSearch": "Pesquisar",
			"oPaginate": {
				"sNext": "Próximo",
				"sPrevious": "Anterior",
				"sFirst": "Primeiro",
				"sLast": "Último"
			},
			"oAria": {
				"sSortAscending": ": Ordenar colunas de forma ascendente",
				"sSortDescending": ": Ordenar colunas de forma descendente"
			}
		},
		responsive: true,
		pageResize: true,
		columnDefs: [
			{
				targets: "noorder",
				orderable: false
			},
			{
				targets: "noshow",
				visible: false
			}
		],
		"initComplete": function(settings, json){
			$('.dataTables_filter').remove();
			$('.dataTables_length').remove();
		}
    });
	$('.datatable').DataTable();
	$('#Search').keyup(function(){
    	dataTable.search($(this).val()).draw();
	});
});