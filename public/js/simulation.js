$(function() {
	
	$('#table-left').find('tr > td > .form-controlt').each(function(){
		console.log('input', $(this));
	})

	var c1 = $('#c1'); var c2 = $('#c2'); var c3 = $('#c3'); var c4 = $('#c4'); var c5 = $('#c5');
	var c6 = $('#c6'); var c7 = $('#c7'); var c8 = $('#c8'); var c9 = $('#c9'); var c10 = $('#c10');
	var c11 = $('#c11'); var c12 = $('#c12'); var c13 = $('#c13'); var c14 = $('#c14'); var c15 = $('#c15');
	var c16 = $('#c16'); var c17 = $('#c17'); var c18 = $('#c18'); var c19 = $('#c19'); var c20 = $('#c20');
	var c21 = $('#c21'); var c22 = $('#c22'); var c23 = $('#c23'); var c24 = $('#c24'); var c25 = $('#c25');
	var c26 = $('#c26'); var c27 = $('#c27'); var c28 = $('#c28'); var c29 = $('#c29'); var c30 = $('#c30');
	var c31 = $('#c31');

	c1.on('change',function(){
	let url = 'pools/poolInfo/'+c1.val();
	$.get(url,function(resp){
		 poolInfo = resp.poolInfo;
		 balancedInfo = resp.balancedInfo;
		 c2.val(poolInfo[0].planted_at);
		 c3.val(poolInfo[0].size);
		 c4.val("Precio ponderado")
		 c5.val(poolInfo[0].planted_larvae)
		 c6.val(125);
		 c7.val((c3.val()*c5.val()*c6.val()/1000).toFixed(3));
		 c8.val(20);
		 c9.val(232);
		 c10.val((7 * c9.val()/c8.val()).toFixed(2));
		 console.log(t);
	});
	})
	

});