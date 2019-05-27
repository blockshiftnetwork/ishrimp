$(function() {
	
	$('#table-left').find('tr > td > .form-controlt').each(function(){
		console.log('input', $(this));
	})

	let c1 = $('#c1');
	let c2 = $('#c2').val();
	let c3 = $('#c3').val();
	let c4 = $('#c4').val();
	let c5 = $('#c5').val();
	let c6 = $('#c6').val();
	let c7 = $('#c7').val();
	let c8 = $('#c8').val();
	let c9 = $('#c9').val();
	let c10 = $('#c10').val();
	let c11 = $('#c11').val();
	let c12 = $('#c12').val();
	let c13 = $('#c13').val();
	let c14 = $('#c14').val();
	let c15 = $('#c15').val();
	let c16 = $('#c16').val();
	let c17 = $('#c17').val();
	let c18 = $('#c18').val();
	let c19 = $('#c19').val();
	let c20 = $('#c20').val();
	let c21 = $('#c21').val();
	let c22 = $('#c22').val();
	let c23 = $('#c23').val();
	let c24 = $('#c24').val();
	let c25 = $('#c25').val();
	let c26 = $('#c26').val();
	let c27 = $('#c27').val();
	let c28 = $('#c28').val();
	let c29 = $('#c29').val();
	let c30 = $('#c30').val();
	let c31 = $('#c31').val();

	c1.on('change',function(){
	let url = 'pools/summary/'+c1.val();
	$.get(url,function(resp){
		console.log(resp)
	});
	})
	

});