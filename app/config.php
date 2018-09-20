<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'inmobiliaria');
 

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($link === false){
    die("ERROR: No es posible conectar. " . mysqli_connect_error());
}

//funcion para el detalle de rol
function DetalleRol($rol_id){
	switch ($rol_id) {
    	case 0:
        	$detalle = "Seleccione";
        	break;
    	case 1:
       		$detalle = "Admin";
        	break;
    	case 2:
        	$detalle = "Supervisor";
        	break;
        case 3:
        	$detalle = "Vendedor";
        	break;
        case 4:
        	$detalle = "DataEntry";
        	break;
        case 5:
        	$detalle = "WebAdmin";
        	break;
    	default:
        	$detalle = "SinRol";
	}
	return $detalle;
}

function Detalletipo($tipoID){
    switch ($tipoID) {
        case 1:
            $detalle = "Departamento";
            break;
        case 2:
            $detalle = "Casa";
            break;
        case 3:
            $detalle = "PH";
            break;
        case 4:
            $detalle = "Lote";
            break;
        case 5:
            $detalle = "Galpon";
            break;
         case 6:
            $detalle = "Campo";
            break;
         case 7:
            $detalle = "Cochera";
            break;        
        default:
            $detalle = "SinDetalle";
    }
    return $detalle;
}


function DetalleOperacion($operacion){
    switch ($operacion) {
        case "V":
            $detalle = "Venta";
            break;
        case "A":
            $detalle = "Alquiler";
            break;
            
        default:
            $detalle = "SinDetalle";
    }
    return $detalle;
}


function DetalleUso($estado){
    switch ($estado) {
        case "N":
            $detalle = "Nuevo";
            break;
        case "U":
            $detalle = "Usado";
            break;
            
        default:
            $detalle = "SinDetalle";
    }
    return $detalle;
}

?>