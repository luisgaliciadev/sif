<?php
error_reporting(E_ERROR | E_PARSE);

session_start();

date_default_timezone_set('America/Caracas');

$SISTEMA_SIGLA = $_SESSION['SISTEMA_SIGLA'];

if (isset($_SESSION[$SISTEMA_SIGLA . "TIEMPO_INICIAL"])) {
	$MINUSTOS = 60;	//minutos para la sesion activa
	$MINUTOS_ACTIVOS = $MINUSTOS * 60;
	$TIEMPO_ACTUAL = time();
	$TIEMPO_INICIAL = $_SESSION[$SISTEMA_SIGLA . 'TIEMPO_INICIAL'];
	$TIEMPO_MAXIMO = $TIEMPO_INICIAL + $MINUTOS_ACTIVOS;

	if ($TIEMPO_ACTUAL > $TIEMPO_MAXIMO or $_SESSION[$SISTEMA_SIGLA . 'BLOQUEADO'] == "SI") {
		$Arreglo["Sesion"] = 1;
	} else {
		$Arreglo["Sesion"] = 0;
	}
} else {
	$Arreglo["Sesion"] = 0;
}

	//$Arreglo["TIEMPO_ACTUAL"] = $TIEMPO_ACTUAL;
	//$Arreglo["TIEMPO_ACTUAL"] = $TIEMPO_ACTUAL;
	//$Arreglo["TIEMPO_MAXIMO"] = $TIEMPO_MAXIMO;

echo json_encode($Arreglo);
?>