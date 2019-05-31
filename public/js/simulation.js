var table_used = $('#table-balanced > tbody');
	var c1 = $('#c1'); var c2 = $('#c2'); var c3 = $('#c3'); var c4 = $('#c4'); var c5 = $('#c5');
	var c6 = $('#c6'); var c7 = $('#c7'); var c8 = $('#c8'); var c9 = $('#c9'); var c10 = $('#c10');
	var c11 = $('#c11'); var c12 = $('#c12'); var c13 = $('#c13'); var c14 = $('#c14'); var c15 = $('#c15');
	var c16 = $('#c16'); var c17 = $('#c17'); var c18 = $('#c18'); var c19 = $('#c19'); var c20 = $('#c20');
	var c21 = $('#c21'); var c22 = $('#c22'); var c23 = $('#c23'); var c24 = $('#c24'); var c25 = $('#c25');
	var c26 = $('#c26'); var c27 = $('#c27'); var c28 = $('#c28'); var c29 = $('#c29'); var c30 = $('#c30');
	var c31 = $('#c31');
	var t1 = $('#t1 ') ; var t2 = $('#t2'); var t3 = $('#t3'); var t4 = $('#t4'); var t5 = $('#t5'); var t6 = $('#t6');
	var p1 = $('#p1');

$(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
//load Data first time
	loadData();

	c1.on('change',function(){
	loadData()
	});

	c6.on('keyup',function(){
		loadData()
	});
	c8.on('keyup',function(){
		loadData()
	});
	c9.on('keyup',function(){
		loadData()
	});
	c11.on('keyup',function(){
		loadData()
	});

	c16.on('keyup',function(){
		loadData()
	});
	c23.on('keyup',function(){
		loadData()
	});
	
	/*$('input[type="text"]').on('change', function(){
		format(this);
	});

	$('input[type="text"]').on('keyup', function(){
		format(this);
	});*/


});

function generatepdf() {
	var html = [];
	$('#simulation').find('.form-control').each(function () {
		if ($(this).attr('id') === 'c1') {
			html.push({ 'id': $(this).attr('id'), 'val': $(this).val(), 'name': $('#c1 option:selected').text() });
		}
		else {
			html.push({ 'id': $(this).attr('id'), 'val': $(this).val() });
		}
	});
	var jsonen = JSON.stringify(html);
	$.ajax({
		type: 'POST',
		url: '/generate-pdf',
		data: { info: jsonen },
		//xhrFields is what did the trick to read the blob to pdf
		xhrFields: {
			responseType: 'blob'
		},
		success: function (response, status, xhr) {
			var filename = "";
			var disposition = xhr.getResponseHeader('Content-Disposition');
			if (disposition) {
				var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
				var matches = filenameRegex.exec(disposition);
				if (matches !== null && matches[1])
					filename = matches[1].replace(/['"]/g, '');
			}
			var linkelem = document.createElement('a');
			try {
				var blob = new Blob([response], { type: 'application/octet-stream' });
				if (typeof window.navigator.msSaveBlob !== 'undefined') {
					//   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
					window.navigator.msSaveBlob(blob, filename);
				}
				else {
					var URL = window.URL || window.webkitURL;
					var downloadUrl = URL.createObjectURL(blob);
					if (filename) {
						// use HTML5 a[download] attribute to specify filename
						var a = document.createElement("a");
						// safari doesn't support this yet
						if (typeof a.download === 'undefined') {
							window.location = downloadUrl;
						}
						else {
							a.href = downloadUrl;
							a.download = filename;
							document.body.appendChild(a);
							a.target = "_blank";
							a.click();
						}
					}
					else {
						window.location = downloadUrl;
					}
				}
			}
			catch (ex) {
				console.log(ex);
			}
		}
	});
}

function loadData(){
	let url = 'pools/poolInfo/'+c1.val();
	$.get(url,function(resp){
		 poolInfo = resp.poolInfo;
		 balancedInfo = resp.balancedInfo;
		 acumKl = 0.0;
		 acumPrice = 0.0;

		 c2.val(poolInfo[0].planted_at);
		 c3.val(poolInfo[0].size);
		 
		 c5.val(poolInfo[0].planted_larvae)
		
		 c7.val((parseFloat(c3.val())*parseFloat(c5.val())*parseFloat(c6.val())/1000).toFixed(2));
		 
		 c10.val((7* parseFloat(c9.val())/parseFloat(c8.val())).toFixed(2));
		 
		 c12.val(((parseFloat(c5.val())*parseFloat(c11.val())*parseFloat(c9.val()))/454).toFixed(2));
		 c13.val((parseFloat(c12.val())*parseFloat(c3.val())).toFixed(2));
		 c14.val((parseFloat(c8.val())*parseFloat(c3.val())).toFixed(2));
		 
		 
		 c17.val((parseFloat(c16.val())*parseFloat(c8.val())).toFixed(2));
		 c18.val(((parseFloat(c12.val())*parseFloat(c15.val())/2.204)*parseFloat(c4.val())).toFixed(2));
		 c19.val((c7.val()/c3.val()).toFixed(2));
		 c20.val( (parseFloat(c17.val()) + parseFloat(c18.val()) + parseFloat(c19.val())).toFixed(2));
		 c21.val((parseFloat(c20.val())*parseFloat(c3.val())).toFixed(2));
		 c22.val((parseFloat(c20.val())/parseFloat(c12.val())).toFixed(2));
		 c24.val((parseFloat(c23.val()/2,2046)).toFixed(2));
		 c25.val((parseFloat(c12.val())*parseFloat(c24.val())).toFixed(2));
		 c26.val((parseFloat(c25.val())*parseFloat(c3.val())).toFixed(2));
		 c27.val((parseFloat(c25.val())-parseFloat(c20.val())).toFixed(2));
		 c28.val((parseFloat(c27.val())*parseFloat(c3.val())).toFixed(2));
		 c29.val((parseFloat(c27.val())/(parseFloat(c8.val())+10)).toFixed(2));
		 c30.val((parseFloat(c26.val())-parseFloat(c21.val())/parseFloat(c22.val())).toFixed(2));
		 c31.val((parseFloat(c24.val())-parseFloat(c22.val())).toFixed(2));

		 table_used.empty();
		 for(let i = 0; i< balancedInfo.length; i++ ){

			table_used.append('<tr><td id=f'+balancedInfo[i].presentation+'>'+balancedInfo[i].presentation_name+'</td>'+
							'<td><input id=g'+balancedInfo[i].presentation+' class="form-control" type="text" value='+balancedInfo[i].price+' readonly> </td>'+
							'<td><input id=h'+balancedInfo[i].presentation+' class="form-control" type="text" value='+balancedInfo[i].presentation_quantity+' readonly> </td>'+
							'<td><input id=i'+balancedInfo[i].presentation+' class="form-control" type="text" value='+(balancedInfo[i].price/balancedInfo[i].presentation_quantity).toFixed(2)+' readonly></td>'+
							'<td><input  id=j'+balancedInfo[i].presentation+' class="form-control" type="text" value='+balancedInfo[i].quantity_used+' readonly> </td>'+
							'<td> <input id=k'+balancedInfo[i].presentation+' class="form-control" type="text" value='+(balancedInfo[i].price/balancedInfo[i].presentation_quantity).toFixed(2) * balancedInfo[i].quantity_used +' readonly> </td></tr>');
			acumKl += parseFloat($('#j'+ balancedInfo[i].presentation).val());
			acumPrice += parseFloat($('#k'+balancedInfo[i].presentation).val()); 
		 }


		 table_used.append('<tr><td></td><td></td><td></td><td></td>'+
		 '<td><input  id=j200 class="form-control" type="text" value='+acumKl+' readonly> </td>'+
		 '<td> <input id=k201 class="form-control" type="text" value='+acumPrice+' readonly> </td></tr>');

		 t1.val(acumPrice);
		 t2.val((acumPrice/c3.val()).toFixed(2));
		 t3.val(acumKl);
		 t4.val((parseFloat(t3.val())*2.2046).toFixed(2));
		 t5.val(c13.val());
		 t6.val((parseFloat(t4.val())/parseFloat(c13.val())).toFixed(2));
		 p1.val((acumPrice/acumKl).toFixed(2));
		 c4.val(p1.val());
		 c15.val(t6.val())
		 console.log(acumKl, acumPrice);
	});
}

function format(input)
{
	var num = input.value.replace(/\./g,'');
	if(!isNaN(num)){
	num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
	num = num.split('').reverse().join('').replace(/^[\.]/,'');
	input.value = num;
	}
	else{ alert('Solo se permiten numeros');
	input.value = input.value.replace(/[^\d\.]*/g,'');
	}
}