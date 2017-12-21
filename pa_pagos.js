// JavaScript Document

var numFacturas = 0;
var FacturasaPagar = new Array();
var totalAPagar = 0;

function resumen(total,facturas){
$("#resume").html("<div>Numero de facturas: <strong>"+facturas+"</strong></div><div>Total a Pagar: <strong>"+total+"</strong></div>");
}

function loadPagosBox(){

$("body").append('<div id="resume" class="ui-corner-all"></div>');
$("body").append('<div id="tabs">'+
'<ul>'+
'<li><a href="#tabs-1">1. Documentos a Pagar</a></li>'+
'<li><a href="#tabs-2">2. Ir a Pagar</a></li>'+
'</ul>'+
'<div id="tabs-1">'+
'Haga click en Pagar para los documentos que desee.'+
'<table id="facturasPagar" border="0" cellspacing="0"><tr class="header"><td>Tipo</td><td>Consecutivo</td><td>Monto a Pagar</td><td>&nbsp;</td></tr></table>'+
'</div>'+
'<div id="tabs-2">'+
'<form id="envioPago" action="pol_send.php" method="post"><input type="hidden" name="valor" id="formvalor" value=""><input type="hidden" name="documentos" id="formdocumentos" value=""><input type="hidden" name="numdocumentos" id="formnumdocumentos" value=""><input type="hidden" name="montos" id="formmontos" value=""></form>'+
'<div style="text-align:center; float:right;"><a href="#" onclick="resetCookies();$(\'#envioPago\').submit();return false;"><img src="pagar_ahora2.png" border="0"></a></div>'+
'<div><br>Numero de facturas: <span id="pagarnumfacturas">0</span><br><br>'+
'Monto a Pagar: <span id="pagarmontototal">0</span><br></div>'+
'</div>'+
'</div>');

$( "#tabs" ).tabs();
$( "#tabs" ).tabs( "option", "disabled", [ 1 ] );

$("body").append('<div style="display:none;" id="dialog-confirm" title="¿Adicionar Documento para Pagar?">'+
	'<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Adicionar el documento contable <span id="tipopregunta"></span> <span id="consecpregunta"></span><br>Valor:<span id="montopregunta"></span><br><br>Valor a pagar: <input id="monto" name="monto" value="10000" /><br><span style="font-style:italic;">* Para hacer un pago parcial de este documento seleccione un valor diferente.</span></p>'+
	'</div>');

	$( "#monto" ).spinner({
	min: 10000,
	step: 1,
	start: 10000,
	numberFormat: "C",
	incremental: spinincrease,
	culture: "es-CO"
	});
	
	Globalize.culture("es-CO");

}
function spinincrease(num){
	if(num<10){
		return 1;
	}
	if(num<20){
		return 1000;
	}
	if(num<30){
		return 10000;
	}
	if(num<50){
		return 100000;
	}
	return 1000000;
}

function parseValor(num){
	return parseInt(num.replace(/[^0-9]+/g,""));
}


function loadButtons(){
	$(".ewTableHeader").children("td").last().append("Pagar");
	//$(".ewTableHeader").children("td").last().prev().find(".ewTableHeaderBtn tr td").first().html("Días<br>Vcto.");
	$(".ewTableHeader").children("td").first().next().find(".ewTableHeaderBtn tr td").first().html("(*)");
	$(".ewTableHeader").children("td").first().next().next().find(".ewTableHeaderBtn tr td").first().html("Nº. (*)");
	
	$(".ewTableRow , .ewTableAltRow").each(function(index){
		tempId = $(this).children("td").first().children().html();
		tipotemp = $(this).children("td").first().next().children().html();
		consectemp = $(this).children("td").first().next().next().children().html();
		montotemp = parseValor($(this).children("td").first().next().next().next().children().html());
		IDsTemp = $.cookie("FactIDs");
		IDs = IDsTemp ? IDsTemp.split(/,/) : new Array();
		if($.inArray(""+tempId, IDs) != -1){
			tempBut = "<div id='butPag"+tempId+"' title='Pagar' class='butPago desactivado'>Pagar</div>";
		}else{
			tempBut = "<div id='butPag"+tempId+"' title='Pagar' class='butPago' onclick='preguntarPago("+tempId+",\""+tipotemp+"\",\""+consectemp+"\","+montotemp+")'>Pagar</div>";
		}
		
		$(this).children("td").last().append(tempBut);
	});
	
	
}

function checkIraPagar(){
	if(FacturasaPagar.length>0){
		$( "#tabs" ).tabs( "option", "disabled", [  ] );
	}else{
		$( "#tabs" ).tabs( "option", "disabled", [ 1 ] );
	}
	
	tempIDs = new Array();
	for(y=0;y<FacturasaPagar.length; y++){
		tempIDs.push(FacturasaPagar[y][0]);
	}
	$.cookie("FactIDs",tempIDs,{ expires: 1 });
	//FacturasaPagar
}

function removerDocumento(id){
	$.cookie("FactID"+id,"");
	$("#factutemp"+id).remove();
	temp = -1
	for(r=0;r<FacturasaPagar.length; r++){
		if(FacturasaPagar[r][0] == id){
			temp = r;
		}
	}
	
	TempArra = FacturasaPagar[temp];
	$("#butPag"+id).removeClass("desactivado");
	$("#butPag"+id).bind("click", function() {
			preguntarPago(TempArra[0],TempArra[1],TempArra[2],parseInt(TempArra[3]));
	});
	
	FacturasaPagar.splice(temp, 1);
	
	checkIraPagar();
	calcularPago();
}

function resetCookies(){
	$.cookie("numFacturas", 0);
	$.cookie("FactIDs","");
}

function calcularPago(){
	
	$("#pagarnumfacturas").html(FacturasaPagar.length);
	$("#formnumdocumentos").val(FacturasaPagar.length);
	tempval = 0;
	tempdoctos = "";
	tempmontos = "";
	for(r=0;r<FacturasaPagar.length; r++){
		tempval += parseInt(FacturasaPagar[r][3]);
		if(r>0){
			tempdoctos += ",";
			tempmontos += ",";
		}
		tempdoctos += FacturasaPagar[r][0];
		tempmontos += FacturasaPagar[r][3];
	}
	
	$("#formmontos").val(tempmontos);
	$("#formdocumentos").val(tempdoctos);
	$("#formvalor").val(tempval);
	$("#pagarmontototal").html(Globalize.format( tempval, "c" ));
	resumen(Globalize.format( tempval, "c" ),FacturasaPagar.length);
}

function adicionarFactura(id,tipo,consec,monto){
	$("#butPag"+id).removeAttr('onclick');
	$("#butPag"+id).unbind("click");
	$("#butPag"+id).addClass("desactivado");
	
	htmlTemp = '<tr id="factutemp'+id+'"><td>&nbsp;'+tipo+'</td><td>&nbsp;'+consec+'</td><td>&nbsp;'+Globalize.format( parseInt(monto), "c" )+'</td><td><img width="16" height="16" border="0" title="Remover documento" alt="Remover documento" onclick="removerDocumento('+id+')" src="phpimages/delete.gif" onlick="removerDocumento('+id+')"></td></tr>';
	FacturasaPagar.push([id,tipo,consec,monto]);
	
	$.cookie("FactID"+id,[id,tipo,consec,monto],{ expires: 1 });
	$.cookie("numFacturas",FacturasaPagar.length,{ expires: 1 });
	
	$("#facturasPagar").append(htmlTemp);
	
	
	//alert(id + tipo + consec + monto);
	checkIraPagar();
	calcularPago();
}

function initCookies(){
	
	if($.isNumeric($.cookie("numFacturas")) && parseInt($.cookie("numFacturas")) > 0){
		numFacturas = parseInt($.cookie("numFacturas"));
		IDsTemp = $.cookie("FactIDs");
		IDs = IDsTemp ? IDsTemp.split(/,/) : new Array();
		for(t=0;t<IDs.length;t++){
			tempFactTemp = $.cookie("FactID"+IDs[t]);
			tempFact = tempFactTemp ? tempFactTemp.split(/,/) : new Array();
			
			FacturasaPagar.push(tempFact);
			htmlTemp = '<tr id="factutemp'+tempFact[0]+'"><td>&nbsp;'+tempFact[1]+'</td><td>&nbsp;'+tempFact[2]+'</td><td>&nbsp;'+Globalize.format(parseInt(tempFact[3]) ,"c")+'</td><td><img width="16" height="16" border="0" title="Remover documento" alt="Remover documento" onclick="removerDocumento('+tempFact[0]+')" src="phpimages/delete.gif" onlick="removerDocumento('+tempFact[0]+')"></td></tr>';
			$("#facturasPagar").append(htmlTemp);
			$( "#tabs" ).tabs( "option", "disabled", [  ] );
		}
	}else{
		$.cookie("numFacturas", 0);
	}
	calcularPago();

}

function formatSpin(num, places, element){
	return parseInt(num).formatMoney(0, "$ ", ".", ".");
}

function preguntarPago(id,tipo,consec,monto){
	
	$("#montopregunta").html(Globalize.format( monto, "c" ));
	$("#tipopregunta").html(tipo);
	$("#consecpregunta").html(consec);
	
	$( "#monto" ).spinner( "option", "max", monto );
	$( "#monto" ).val(Globalize.format( monto, "c" ));

	$( "#dialog-confirm" ).dialog({
		resizable: false,
		height:140,
		modal: true,
		buttons: {
		"Adicionar factura a Pagos": function() {
			adicionarFactura(id,tipo,consec,$( "#monto" ).val().replace(/[^\d.]/g, ""));
			$( this ).dialog( "close" );
		},
		Cancel: function() {
			$( this ).dialog( "close" );
		}
	}
	});
}
