// FUNCIÓN PARA LLENAR LISTA DE CANDIDATOS
function candidatos(){

	fetch('accesoDatos/mostrarCandidatos.php', {
    	method: 'POST',
    	headers: {
      		'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
    	}
  	})
  	.then(response => response.text())
  	.then(data => document.querySelector("#candidato").innerHTML = data);
};


// FUNCIÓN PARA LLENAR LISTA DE REGIONES
function regiones(){

	fetch('accesoDatos/mostrarRegiones.php', {
    	method: 'POST',
    	headers: {
      		'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
    	}
  	})
  	.then(response => response.text())
  	.then(data => document.querySelector("#region").innerHTML = data);  	
};


// PROCESO PARA LLENAR LISTA DE COMUNAS POR REGIÓN
const $region = document.querySelector("#region");

$region.addEventListener('change', function(){
	//const $value = $region.options[$region.selectedIndex].value; 
	const $value = $region.value;

	if($value!=0){
		const $comuna = document.querySelector("#comuna");
		$comuna.disabled=false;
	}else{
		$comuna.disabled=true;
	}

	function comunas(){
		let id = $value;
	
		fetch('accesoDatos/mostrarComunas.php', {
	    	method: 'POST',
	    	headers: {
	    		'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
	    	body: 'id='+id
	    		
	  	})
	  	.then(response => response.text())
  		.then(data => document.querySelector("#comuna").innerHTML = data);
	}

	comunas();
});


//PROCESO PARA GUARDAR LOS DATOS DEL FORMULARIO
const $buttonVotar = document.querySelector('#btnVotar');
let mensaje = document.querySelector("#mensaje");


$buttonVotar.addEventListener('click', function(e){
	e.preventDefault();

	// VARIABLES FORMULARIO
	const $nombre = document.querySelector('#txtNombre').value;
	const $alias = document.querySelector('#txtAlias').value;
	let $rut = document.querySelector('#txtRut').value;
	const $email = document.querySelector('#txtEmail').value;
	
	const $region = document.querySelector('#region');
	const $comuna = document.querySelector('#comuna');
	const $candidato = document.querySelector('#candidato');

	// VALIDACIÓN DE CAMPOS
	
	if($nombre.length == 0){
		alert('Ingrese un nombre');
		return;
	}
	if($alias.length <= 5){
		alert('El alias debe contener más de 5 carácteres');
		return;
	}
	if(!/^[a-zA-Z0-9]+$/g.test($alias)){
		alert('El alias solo permite carácteres alfanuméricos');
		return;
	}
	if($rut.length == 0){
		alert('Ingrese el rut');
		return;
	}

	$rut = $rut.replaceAll('.','');
	$rut = $rut.replaceAll(' ','');
	if(!validarRut($rut)){
		alert("El rut ingresado no es válido. Verifique el uso del guión");
		return;
	}

	if($email.length == 0){
		alert('Ingrese email');
		return;
	}

	let reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
	if(!reg.test($email)){
		alert('Email incorrecto');
		return;
	}

	const $idRegion = $region.options[$region.selectedIndex].value;
	if($idRegion == 0){
		alert('Seleccione una región');
		return;
	}

	const $idComuna = $comuna.options[$comuna.selectedIndex].value;
	if($idComuna == 0){
		alert('Seleccione una comuna');
		return;
	}

	const $idCandidato = $candidato.options[$candidato.selectedIndex].value;
	if($idCandidato == 0){
		alert('Seleccione un candidato');
		return;
	}

	// obtener lista de checkbox seleccionados y validar que sean dos o más
	$checkbox = document.querySelectorAll('input[name="opciones"]:checked');
	if($checkbox.length<2){
		alert("Debe seleccionar al menos dos opciones");
		return;
	}
	$selected = [];
	$checkbox.forEach((c) => { $selected.push(c.value);	});
	// FIN VALIDACIÓN DE CAMPOS


	// RECOLECCIÓN DE DATOS Y ENVIO
	fetch('accesoDatos/guardarFormulario.php', {
	   	method: 'POST',
	   	headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
	   	body: "info="+[$nombre, $alias, $rut, $email, $idRegion, $idComuna, $idCandidato, $selected]
	    		
	})
	.then(response => response.text())
	.then(data => {
		if(!data){
			document.querySelector("#mensaje").innerHTML = "Ya existe un registro con el rut: "+$rut;
			document.querySelector("#mensaje").style.color = 'orangered';
			console.log("Ya existe un registro con el rut "+$rut);
		}
		else{
			document.querySelector("#mensaje").innerHTML = data;
			document.querySelector("#mensaje").style.color = 'forestgreen';
			console.log(data);
			limpiarCampos();
		}
	});
	
});

	
// FUNCIÓN PARA VALIDAR RUT
function validarRut(rutCompleto) {
		
	if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
		return false;

	if(rutCompleto.startsWith('0')){
		return false;
	}

	let tmp = rutCompleto.split('-');
	let digv = tmp[1]; 
	let rut = tmp[0];

	if ( digv == 'K' ) digv = 'k' ;	
	
	return (dv(rut) == digv);
}
// FUNCIÓN ANEXA VALIDAR RUT (DÍGITO VERIFICADOR)
function dv(T){
	var M=0,S=1;
	
	for(;T;T=Math.floor(T/10))
		S=(S+T%10*(9-M++%6))%11;
	
	return S?S-1:'k';
}


// LIMPIAR CAMPOS FORMULARIO
function limpiarCampos(){
	document.querySelector('#txtNombre').value = "";
	document.querySelector('#txtAlias').value = "";
	document.querySelector('#txtRut').value = "";
	document.querySelector('#txtEmail').value = "";
	
	document.querySelector('#region').value = 0;
	document.querySelector('#comuna').value = 0;
	document.querySelector('#comuna').disabled = true;
	document.querySelector('#candidato').value = 0;

	$checkbox = document.querySelectorAll('input[name="opciones"]:checked');
	$checkbox.forEach((c) => {c.checked=false});
}