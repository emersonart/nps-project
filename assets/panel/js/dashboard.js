$(document).ready(()=>{
	const table1 = $('#table_answers')
	if(table1.length){
		console.log(base_url + 'assets/plugins/DataTables/i18n/pt-br.js');
		table1.DataTable({
			dom: 'Bfrtip',
			language: {
				url: base_url + 'assets/plugins/DataTables/i18n/pt-br.js'
			},
			"order": [[ 0, 'desc' ]],
			buttons: [
				'copyHtml5',
				{
					extend: 'excelHtml5',
					filename: 'avaliacoes_'+table1.data('initDate')+'_ate_'+table1.data('endDate')+'_'+(new Date().getTime()),
					title: `Avaliações: ${table1.data('initDate').split('_').join('/')} até ${table1.data('endDate').split('_').join('/')}`,
					exportOptions: {
						columns: [0,1,2,3,4]
					}
				},
				{
					extend: 'csvHtml5',
					filename: 'avaliacoes_'+table1.data('initDate')+'_ate_'+table1.data('endDate')+'_'+(new Date().getTime()),
					title: `Avaliações: ${table1.data('initDate').split('_').join('/')} até ${table1.data('endDate').split('_').join('/')}`,
					exportOptions: {
						columns: [0,1,2,3,4]
					}
				},
				{
					extend: 'pdfHtml5',
					filename: 'avaliacoes_'+table1.data('initDate')+'_ate_'+table1.data('endDate')+'_'+(new Date().getTime()),
					title: `Avaliações: ${table1.data('initDate').split('_').join('/')} até ${table1.data('endDate').split('_').join('/')}`,
					exportOptions: {
						columns: [0,1,2,3,4]
					}
				},
			]
		});
	}
	

})
