<?php
    $Nivel="../../";
    include($Nivel."includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	

	
	$buscar = $_POST["buscar"];

    $vSQL="
        SELECT 
            TOP 5
            ID_ClIENTE AS VALUE, 
            NB_CLIENTE AS TEXT
        FROM 
            CLIENTE 
        WHERE 
            
            (NB_CLIENTE LIKE '%".$buscar."%')
        ORDER BY NB_CLIENTE";
	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="NO", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$resultPrin=$ResultadoEjecutar["RESULTADO"];

	if($CONEXION=="SI" and $ERROR=="NO")
	{
        $i = 0;
        while (odbc_fetch_array($resultPrin))
        {
            $VALUE=odbc_result($resultPrin,"VALUE");
            $TEXT=utf8_encode(odbc_result($resultPrin,"TEXT"));

            $json[] = array(
				'id' => $VALUE,
				'text' => $TEXT
            );

            $i++;
        }

        if ($i == 0) {
            $json[] = array(
				'id' => '',
				'text' => 'No se encontraron registros'
            );
        }
        
        $Arreglo["json"]=$json;
	}
	else
	{
        $json[] = array(
            'id' => '',
            'text' => 'Disculpe, ocurrio un error en el servidor'
        );
        
        $Arreglo["json"]=$json;
	}
    
    echo json_encode($Arreglo);
	
	$Conector->Cerrar();
?>