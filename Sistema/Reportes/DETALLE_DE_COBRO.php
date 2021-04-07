<?php
$Nivel = "../../";
include($Nivel."includes/PHP/funciones.php");
session_start();
header("Content-type: text/html; charset=utf8");
$conector=Conectar(); /* conexion a la base de datos */

require_once 'PHPExcel/PHPExcel.php';  /* libreria para expotar a excel */

/* ------------------------- parametros de la consulta del reporte ------------------------*/

$Localidad=$_GET["puerto"];
$rangofecha = $_GET["RangoFecha"];
$fechas = explode("-",$rangofecha);

/* -------------------FIN PARAMETROS ------------------------ */


/* ---------- INICIO DEL OBJETO EXCEL ----------------- */
$objPHPExcel = new PHPExcel();

/*--------- TITULO DEL REPORTE ----------------------------- */
$tituloReporte = "DETALLE DE COBRO MONEDA NACIONAL, DESDE:".$fechas[0].' HASTA:'.$fechas[1];

/* ------ ACTIVAR PESTAÑA DE EXCEL ------------ */
$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A1:AC1'); /* --- COMBINAR CELDAS ---- */

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1',  $tituloReporte); /* --- ASIGNAR EL TITULO DEL REPORTE A LA CELDA ---- */


$estiloGrupoReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
            'color'     => array(
                'rgb' => '000000'
            )
    )
);


$tituloReporte = "GRUPO: DOCUMENTOS EMITIDOS EN EL RANGO SELECCIONADO";

 

/* ------ ACTIVAR PESTAÑA DE EXCEL ------------ */
$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A3:AC3'); /* --- COMBINAR CELDAS ---- */

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A3',  $tituloReporte);

 $objPHPExcel->getActiveSheet()->getStyle('A3:AC3')->applyFromArray($estiloGrupoReporte);


/*--- NOMBRE DE LAS COLUMNAS ----------- */
$titulosColumnas = array('NRO','LOCALIDAD','RIF DEL CLIENTE','NOMBRE DEL CLIENTE','NRO FACTURA','NRO CONTROL','SERIE', 'FECHA FACTURA','CONDICION DE PAGO','TIPO PAGO','NOMBRE DEL BANCO', 'NRO CUENTA', 'TIPO DE MOVIMIENTO', 'REF PAGO', 'CUENTA CHEQUE', 'RESPONSABLE', 'MONEDA', 'FECHA DE EMISION', 'FECHA DE AFECTACION', 'OBSERVACION DE PAGO', 'MONTO', 'MONTO USADO','SALDO','ESTATUS','MONTO AVISO','NRO AVISO','MONTO TOTAL AVISO','CONDICION','TOTAL FACTURA');
/*--- FIN NOMBRE DE LAS COLUMNAS ------------ */

/* --- ASIGNAR LOS TITULOS DE LAS COLUMNAS  ---- */
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A5',  $titulosColumnas[0])
->setCellValue('B5',  $titulosColumnas[1])
->setCellValue('C5',  $titulosColumnas[2])
->setCellValue('D5',  $titulosColumnas[3])
->setCellValue('E5',  $titulosColumnas[4])
->setCellValue('F5',  $titulosColumnas[5])
->setCellValue('G5',  $titulosColumnas[6])
->setCellValue('H5',  $titulosColumnas[7])
->setCellValue('I5',  $titulosColumnas[8])
->setCellValue('J5',  $titulosColumnas[9])
->setCellValue('K5',  $titulosColumnas[10])
->setCellValue('L5',  $titulosColumnas[11])
->setCellValue('M5',  $titulosColumnas[12])
->setCellValue('N5',  $titulosColumnas[13])
->setCellValue('O5',  $titulosColumnas[14])
->setCellValue('P5',  $titulosColumnas[15])
->setCellValue('Q5',  $titulosColumnas[16])
->setCellValue('R5',  $titulosColumnas[17])
->setCellValue('S5',  $titulosColumnas[18])
->setCellValue('T5',  $titulosColumnas[19])
->setCellValue('U5',  $titulosColumnas[20])
->setCellValue('V5',  $titulosColumnas[21])
->setCellValue('W5',  $titulosColumnas[22])
->setCellValue('X5',  $titulosColumnas[23]) 
->setCellValue('Y5',  $titulosColumnas[24]) 
->setCellValue('Z5',  $titulosColumnas[25])
->setCellValue('AA5',  $titulosColumnas[26]) 
->setCellValue('AB5',  $titulosColumnas[27])
->setCellValue('AC5',  $titulosColumnas[28]);


$objPHPExcel->getActiveSheet()->getColumnDimension('A'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('B'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('C'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('D'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('E'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('F'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('G'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('H'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('H'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('I'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('J'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('K'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('L'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('M'.$i)->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('N'.$i)->setAutoSize(false);
/* --- FIN ASIGNAR LOS TITULOS DE LAS COLUMNAS  ---- */

/* -- Estilo del titulo del reporte ---  */
$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
            'color'     => array(
                'rgb' => '000000'
            )
    ),
    'fill' => array(
        'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
        'color'	=> array('argb' => '3399FF')
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE                    
        )
    ), 
    'alignment' =>  array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'rotation'   => 0,
            'wrap'          => TRUE
    )
);




/* -- FIN   ---  */

/* -- Estilo del titulo de las columnas  ---  */

$estiloTituloColumnas = array(
    'font' => array(
        'name'      => 'Arial',
        'bold'      => true,
		'size' =>9,                         
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' 	=> array(
        'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation'   => 90,
        'startcolor' => array(
            'rgb' => '3399FF'
        ),
        'endcolor'   => array(
            'argb' => 'bdbdbd'
        )
    )
    
);

/* -- FIN   ---  */

/*
$vSQL = " select * from view where letra = '$letra'  and numeric = $numerico"; 
$vSQL = " select * from view where letra = '".$letra."'  and numeric =".$numerico; 

    /* ---- Consulta SQl ------ */
    
	

	 $vSQL = "SELECT * FROM [dbo].[FN_RPT_DETALLE_COBRO_MONEDA_BASE] ($Localidad, '$fechas[0]','$fechas[1]') WHERE GRUPO=1";

    $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    $CONEXION=$ResultadoEjecutar["CONEXION"];						
    $ERROR=$ResultadoEjecutar["ERROR"];
    $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
    $resul=$ResultadoEjecutar["RESULTADO"];
    /* Fin */
    $i =6; 
    $j = 1;

    /* Verificar si existe un error en la consulta  */
    if($CONEXION=="SI" and $ERROR=="NO")
    {    
         /* RECORRER LOS RESULTADOS DE LA CONSULTA   */
        while ($registro=odbc_fetch_array($resul))
		{   
            /* SI EXISTE ALGUNA VALIDACION EN LOS REPORTES  */
           
            /* FIN  */

            /* IMPRIMIR LOS VALORES EN LAS CELDAS DEL EXCEL  */
            
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $j)
            ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'NB_LOCALIDAD')))
            ->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'RIF_CLIENTE')))
            ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'NB_CLIENTE')))
            ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'NRO_DOC')))
            ->setCellValue('F'.$i, utf8_encode(odbc_result($resul,'NRO_CONTROL')))
            ->setCellValue('G'.$i, utf8_encode(odbc_result($resul,'NB_SERIE')))
            ->setCellValue('H'.$i, FechaNormal(odbc_result($resul,'F_EMISION_FACTURA')))
            ->setCellValue('I'.$i, utf8_encode(odbc_result($resul,'CONDICION_PAGO')))
            ->setCellValue('J'.$i, utf8_encode(odbc_result($resul,'TIPO_PAGO')))
            ->setCellValue('K'.$i, utf8_encode(odbc_result($resul,'NB_BANCO')))
			->setCellValueExplicit('L'.$i,utf8_encode(odbc_result($resul,'NRO_CUENTA')),PHPExcel_Cell_DataType::TYPE_STRING)
			->setCellValue('M'.$i, utf8_encode(odbc_result($resul,'NB_TP_MOVIMIENTO')))
			->setCellValueExplicit('N'.$i,utf8_encode(odbc_result($resul,'REF_PAGO')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValueExplicit('O'.$i,utf8_encode(odbc_result($resul,'CUENTA_CHEQUE')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('P'.$i, utf8_encode(odbc_result($resul,'RESPONSABLE')))
            ->setCellValue('Q'.$i, utf8_encode(odbc_result($resul,'NB_MONEDA')))
            ->setCellValue('R'.$i, FechaNormal(odbc_result($resul,'F_EMISION')))
            ->setCellValue('S'.$i, FechaNormal(odbc_result($resul,'F_AFECTACION')))
            ->setCellValue('T'.$i, utf8_encode(odbc_result($resul,'OBSERVACION_PAGO')))
         	->setCellValue('U'.$i, (odbc_result($resul,'MONTO')))
            ->setCellValue('V'.$i, (odbc_result($resul,'MONTO_USADO')))
            ->setCellValue('W'.$i, (odbc_result($resul,'SALDO')))
            ->setCellValue('X'.$i, utf8_encode(odbc_result($resul,'DS_ESTATU_MOVIMIENTO')))
            ->setCellValue('Y'.$i, (odbc_result($resul,'MONTO_AVISO_DOC')))
            ->setCellValue('Z'.$i, (odbc_result($resul,'NRO_AVISO')))
            ->setCellValue('AA'.$i, (odbc_result($resul,'MONTO_TOTAL_AVISO')))
            ->setCellValue('AB'.$i, utf8_encode(odbc_result($resul,'CONDICION')))
			->setCellValue('AC'.$i, utf8_encode(odbc_result($resul,'MTO_TOTAL')));

			
			$objPHPExcel->getActiveSheet()->getStyle('U'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('V'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('Y'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AA'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AC'.$i)->getNumberFormat()->setFormatCode('#.##00');
			
			
            $i ++;
            $j ++;
			
			
			
			
        }
		
		$i=$i+1;
		$tituloReporte = "RESUMEN GRUPO: DOCUMENTOS EMITIDOS EN EL RANGO SELECCIONADO";
		
		$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A'.$i.':F'.$i); /* --- COMBINAR CELDAS ---- */

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i,  $tituloReporte);
		 $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':F'.$i)->applyFromArray($estiloTituloColumnas);
        
        $i=$i+1;
        $titulosColumnas = array('NRO','DESCRIPCION','MONEDA ','CONDICION','MONTO','CANTIDAD');
        /*--- FIN NOMBRE DE LAS COLUMNAS ------------ */
        
        /* --- ASIGNAR LOS TITULOS DE LAS COLUMNAS  ---- */
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i,  $titulosColumnas[0])
			
			
			
        ->setCellValue('B'.$i,  $titulosColumnas[1])
        ->setCellValue('C'.$i,  $titulosColumnas[2])
        ->setCellValue('D'.$i,  $titulosColumnas[3])
        ->setCellValue('E'.$i,  $titulosColumnas[4])
        ->setCellValue('F'.$i,  $titulosColumnas[5])
        ->setCellValue('G'.$i,  $titulosColumnas[6])
        ->setCellValue('H'.$i,  $titulosColumnas[7])
        ->setCellValue('I'.$i,  $titulosColumnas[8]);
 
		// CONSULTAR RESUMEN 
			$vSQL = "SELECT * FROM [dbo].[FN_RPT_RESUM_DETALLE_COBRO_MONEDA_BASE] ($Localidad, '$fechas[0]','$fechas[1]') WHERE GRUPO = 1";  
		   $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
			$i= $i+1;
			$j= 1;
			$CONEXION=$ResultadoEjecutar["CONEXION"];						
			$ERROR=$ResultadoEjecutar["ERROR"];
			$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
			$resul=$ResultadoEjecutar["RESULTADO"];
		
		    if($CONEXION=="SI" and $ERROR=="NO") 
 
			{    
				while ($registro=odbc_fetch_array($resul)) 
				{ 

					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, $j)
                    ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'DESCRIPCION')).' ( '.utf8_encode(odbc_result($resul,'NB_TP_MOVIMIENTO')).' )')
                    ->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'MONEDA')))
                    ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'CONDICION')))
                    ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'VALUE_F')))
                    ->setCellValue('F'.$i, (odbc_result($resul,'CANTIDAD')));
					
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode('#.##00');
					
					$i ++;
					$j ++;
				}
			}
		
		
		
		
    }




	/********************************GRUPO 2*/
	$i= $i+1;
	$tituloReporte = "GRUPO: DOCUMENTOS CANCELADOS EN EL RANGO SELECCIONADO, EMITIDOS OTRO PERIODO";

	/* ------ ACTIVAR PESTAÑA DE EXCEL ------------ */
	$objPHPExcel->setActiveSheetIndex(0)
	->mergeCells('A'.$i.':AC'.$i); /* --- COMBINAR CELDAS ---- */

	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,  $tituloReporte);

	 $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':AC'.$i)->applyFromArray($estiloGrupoReporte);

	$i= $i+1;
	/*--- NOMBRE DE LAS COLUMNAS ----------- */
	$titulosColumnas = array('NRO','LOCALIDAD','RIF DEL CLIENTE','NOMBRE DEL CLIENTE','NRO FACTURA','NRO CONTROL','SERIE', 'FECHA FACTURA','CONDICION DE PAGO','TIPO PAGO','NOMBRE DEL BANCO', 'NRO CUENTA', 'TIPO DE MOVIMIENTO', 'REF PAGO', 'CUENTA CHEQUE', 'RESPONSABLE', 'MONEDA', 'FECHA DE EMISION', 'FECHA DE AFECTACION', 'OBSERVACION DE PAGO', 'MONTO', 'MONTO USADO','SALDO','ESTATUS','MONTO AVISO','NRO AVISO','MONTO TOTAL AVISO','CONDICION','TOTAL FACTURA');
	/*--- FIN NOMBRE DE LAS COLUMNAS ------------ */
	

	$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':AC'.$i)->applyFromArray($estiloTituloColumnas);

	
	/* --- ASIGNAR LOS TITULOS DE LAS COLUMNAS  ---- */
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,  $titulosColumnas[0])
	->setCellValue('B'.$i,  $titulosColumnas[1])
	->setCellValue('C'.$i,  $titulosColumnas[2])
	->setCellValue('D'.$i,  $titulosColumnas[3])
	->setCellValue('E'.$i,  $titulosColumnas[4])
	->setCellValue('F'.$i,  $titulosColumnas[5])
	->setCellValue('G'.$i,  $titulosColumnas[6])
	->setCellValue('H'.$i,  $titulosColumnas[7])
	->setCellValue('I'.$i,  $titulosColumnas[8])
	->setCellValue('J'.$i,  $titulosColumnas[9])
	->setCellValue('K'.$i,  $titulosColumnas[10])
	->setCellValue('L'.$i,  $titulosColumnas[11])
	->setCellValue('M'.$i,  $titulosColumnas[12])
	->setCellValue('N'.$i,  $titulosColumnas[13])
	->setCellValue('O'.$i,  $titulosColumnas[14])
	->setCellValue('P'.$i,  $titulosColumnas[15])
	->setCellValue('Q'.$i,  $titulosColumnas[16])
	->setCellValue('R'.$i,  $titulosColumnas[17])
	->setCellValue('S'.$i,  $titulosColumnas[18])
	->setCellValue('T'.$i,  $titulosColumnas[19])
	->setCellValue('U'.$i,  $titulosColumnas[20])
	->setCellValue('V'.$i,  $titulosColumnas[21])
	->setCellValue('W'.$i,  $titulosColumnas[22])
	->setCellValue('X'.$i,  $titulosColumnas[23]) 
	->setCellValue('Y'.$i,  $titulosColumnas[24]) 
	->setCellValue('Z'.$i,  $titulosColumnas[25])
	->setCellValue('AA'.$i,  $titulosColumnas[26]) 
	->setCellValue('AB'.$i,  $titulosColumnas[27])
	->setCellValue('AC'.$i,  $titulosColumnas[28]);

	$vSQL = "SELECT * FROM [dbo].[FN_RPT_DETALLE_COBRO_MONEDA_BASE] ($Localidad, '$fechas[0]','$fechas[1]') WHERE GRUPO=2";

    $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    $CONEXION=$ResultadoEjecutar["CONEXION"];						
    $ERROR=$ResultadoEjecutar["ERROR"];
    $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
    $resul=$ResultadoEjecutar["RESULTADO"];
    /* Fin */
    $i =$i+1; 
    $j = 1;

    /* Verificar si existe un error en la consulta  */
    if($CONEXION=="SI" and $ERROR=="NO")
    {    
         /* RECORRER LOS RESULTADOS DE LA CONSULTA   */
        while ($registro=odbc_fetch_array($resul))
		{   
            /* SI EXISTE ALGUNA VALIDACION EN LOS REPORTES  */
           
            /* FIN  */

            /* IMPRIMIR LOS VALORES EN LAS CELDAS DEL EXCEL  */
            
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $j)
            ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'NB_LOCALIDAD')))
            ->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'RIF_CLIENTE')))
            ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'NB_CLIENTE')))
            ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'NRO_DOC')))
            ->setCellValue('F'.$i, utf8_encode(odbc_result($resul,'NRO_CONTROL')))
            ->setCellValue('G'.$i, utf8_encode(odbc_result($resul,'NB_SERIE')))
            ->setCellValue('H'.$i, FechaNormal(odbc_result($resul,'F_EMISION_FACTURA')))
            ->setCellValue('I'.$i, utf8_encode(odbc_result($resul,'CONDICION_PAGO')))
            ->setCellValue('J'.$i, utf8_encode(odbc_result($resul,'TIPO_PAGO')))
            ->setCellValue('K'.$i, utf8_encode(odbc_result($resul,'NB_BANCO')))
			->setCellValueExplicit('L'.$i,utf8_encode(odbc_result($resul,'NRO_CUENTA')),PHPExcel_Cell_DataType::TYPE_STRING)
			->setCellValue('M'.$i, utf8_encode(odbc_result($resul,'NB_TP_MOVIMIENTO')))
			->setCellValueExplicit('N'.$i,utf8_encode(odbc_result($resul,'REF_PAGO')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValueExplicit('O'.$i,utf8_encode(odbc_result($resul,'CUENTA_CHEQUE')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('P'.$i, utf8_encode(odbc_result($resul,'RESPONSABLE')))
            ->setCellValue('Q'.$i, utf8_encode(odbc_result($resul,'NB_MONEDA')))
            ->setCellValue('R'.$i, FechaNormal(odbc_result($resul,'F_EMISION')))
            ->setCellValue('S'.$i, FechaNormal(odbc_result($resul,'F_AFECTACION')))
            ->setCellValue('T'.$i, utf8_encode(odbc_result($resul,'OBSERVACION_PAGO')))
         	->setCellValue('U'.$i, (odbc_result($resul,'MONTO')))
            ->setCellValue('V'.$i, (odbc_result($resul,'MONTO_USADO')))
            ->setCellValue('W'.$i, (odbc_result($resul,'SALDO')))
            ->setCellValue('X'.$i, utf8_encode(odbc_result($resul,'DS_ESTATU_MOVIMIENTO')))
            ->setCellValue('Y'.$i, (odbc_result($resul,'MONTO_AVISO_DOC')))
            ->setCellValue('Z'.$i, (odbc_result($resul,'NRO_AVISO')))
            ->setCellValue('AA'.$i, (odbc_result($resul,'MONTO_TOTAL_AVISO')))
            ->setCellValue('AB'.$i, utf8_encode(odbc_result($resul,'CONDICION')))
			->setCellValue('AC'.$i, utf8_encode(odbc_result($resul,'MTO_TOTAL')));;

			
			$objPHPExcel->getActiveSheet()->getStyle('U'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('V'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('Y'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AA'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AC'.$i)->getNumberFormat()->setFormatCode('#.##00');
			
			
            $i ++;
            $j ++;
			
			
			
			
        }
		
		$i=$i+1;
		$tituloReporte = "RESUMEN GRUPO: DOCUMENTOS CANCELADOS EN EL RANGO SELECCIONADO, EMITIDOS OTRO PERIODO";
		
		$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A'.$i.':F'.$i); /* --- COMBINAR CELDAS ---- */

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i,  $tituloReporte);
		 $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':F'.$i)->applyFromArray($estiloTituloColumnas);
        
        $i=$i+1;
        $titulosColumnas = array('NRO','DESCRIPCION','MONEDA ','CONDICION','MONTO','CANTIDAD');
        /*--- FIN NOMBRE DE LAS COLUMNAS ------------ */
        
        /* --- ASIGNAR LOS TITULOS DE LAS COLUMNAS  ---- */
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i,  $titulosColumnas[0])
		->setCellValue('B'.$i,  $titulosColumnas[1])
        ->setCellValue('C'.$i,  $titulosColumnas[2])
        ->setCellValue('D'.$i,  $titulosColumnas[3])
        ->setCellValue('E'.$i,  $titulosColumnas[4])
        ->setCellValue('F'.$i,  $titulosColumnas[5])
        ->setCellValue('G'.$i,  $titulosColumnas[6])
        ->setCellValue('H'.$i,  $titulosColumnas[7])
        ->setCellValue('I'.$i,  $titulosColumnas[8]);
 
		// CONSULTAR RESUMEN 
			$vSQL = "SELECT * FROM [dbo].[FN_RPT_RESUM_DETALLE_COBRO_MONEDA_BASE] ($Localidad, '$fechas[0]','$fechas[1]') WHERE GRUPO = 2";  
		   $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
			$i= $i+1;
			$j= 1;
			$CONEXION=$ResultadoEjecutar["CONEXION"];						
			$ERROR=$ResultadoEjecutar["ERROR"];
			$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
			$resul=$ResultadoEjecutar["RESULTADO"];
		
		    if($CONEXION=="SI" and $ERROR=="NO") 
 
			{    
				while ($registro=odbc_fetch_array($resul)) 
				{ 

					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, $j)
                    ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'DESCRIPCION')).' ( '.utf8_encode(odbc_result($resul,'NB_TP_MOVIMIENTO')).' )')
                    ->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'MONEDA')))
                    ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'CONDICION')))
                    ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'VALUE_F')))
                    ->setCellValue('F'.$i, (odbc_result($resul,'CANTIDAD')));
					
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode('#.##00');
					
					$i ++;
					$j ++;
				}
			}
		
		// AVISOS DE CREDITO GENERADOS 
		
        $i=$i+1;
		$tituloReporte = "DETALLE SALDOS A FAVOR GENERADOS";

 		/* ------ ACTIVAR PESTAÑA DE EXCEL ------------ */
		$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A'.$i.':F'.$i); /* --- COMBINAR CELDAS ---- */

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i,  $tituloReporte);

		 $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':I'.$i)->applyFromArray($estiloGrupoReporte);
		
		
        
        $i=$i+1;
        $titulosColumnas = array('NRO','TIPO DE MOVIMIENTO','DOCUM ORIG ','CONTROL ORIG','SERIE','MONEDA','NRO','MONTO','ESTATUS');
        /*--- FIN NOMBRE DE LAS COLUMNAS ------------ */
        
        /* --- ASIGNAR LOS TITULOS DE LAS COLUMNAS  ---- */
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i,  $titulosColumnas[0])
		->setCellValue('B'.$i,  $titulosColumnas[1])
        ->setCellValue('C'.$i,  $titulosColumnas[2])
        ->setCellValue('D'.$i,  $titulosColumnas[3])
        ->setCellValue('E'.$i,  $titulosColumnas[4])
        ->setCellValue('F'.$i,  $titulosColumnas[5])
        ->setCellValue('G'.$i,  $titulosColumnas[6])
        ->setCellValue('H'.$i,  $titulosColumnas[7])
		->setCellValue('I'.$i,  $titulosColumnas[8]);

		
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i,  $tituloReporte);
		 $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':I'.$i)->applyFromArray($estiloTituloColumnas);
		
		// CONSULTAR RESUMEN 
		$vSQL = "SELECT * FROM [dbo].[FN_RPT_AVISOS_GENERADOS] ($Localidad, '$fechas[0]','$fechas[1]',1)";  
		$ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
		$i= $i+1;
		$j= 1;
		$CONEXION=$ResultadoEjecutar["CONEXION"];						
		$ERROR=$ResultadoEjecutar["ERROR"];
		$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
		$resul=$ResultadoEjecutar["RESULTADO"];
		
		  if($CONEXION=="SI" and $ERROR=="NO") 
 
			{    
				while ($registro=odbc_fetch_array($resul)) 
				{ 

					$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, $j)
                    ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'NB_TP_MOVIMIENTO')))
                    ->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'NRO_DOCUMENTO')))
                    ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'NRO_CONTROL')))
                    ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'NB_SERIE')))
                    ->setCellValue('F'.$i, (odbc_result($resul,'NB_MONEDA')))
					->setCellValue('G'.$i, (odbc_result($resul,'NRO_AVISO')))
					->setCellValue('H'.$i, (odbc_result($resul,'MONTO')))
					->setCellValue('I'.$i, utf8_encode(odbc_result($resul,'DS_ESTATU_MOVIMIENTO')));
					
					$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getNumberFormat()->setFormatCode('#.##00');
					
					$i ++;
					$j ++;
				}
			}
		
		
		
		
    }
	
	else{

    }
    
    /* ESTILO DE LOS DATOS A IMPRIMIR  */
    $estiloInformacion = new PHPExcel_Style();
	
	$estiloInformacion->applyFromArray(
		array(
			'font' => array(
			'name'      => 'Arial',               
			'color'     => array(
				'rgb' => 'bdbdbd'
			)
		),
		'fill' 	=> array(
			'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
			'color'		=> array('argb' => 'bdbdbd')
		),
		'borders' => array(
			'left'     => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN ,
				'color' => array(
					'rgb' => 'ffffff'
				)
			)             
		)
    ));
    /* FIN */

    /* ASIGNACION DE LOS ESTILOS TITULOS DE LOS REPORTE */
    $objPHPExcel->getActiveSheet()->getStyle('A1:AC1')->applyFromArray($estiloTituloReporte);
	
    $objPHPExcel->getActiveSheet()->getStyle('A5:AC5')->applyFromArray($estiloTituloColumnas);
 	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
    /* AUTO SIZE A LAS COLUMNAS */     


    /* FIN */

    /* TITULO A LA PESTAÑA ACTIVA */ 
    
    $objPHPExcel->getActiveSheet()->setTitle('DETALLE DE COBRO');

    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
    
    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DETALLE_DE_COBRO.xlsx"'); // CAMBIAR EL NOMBRE DEL REPORTE 
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
    ob_start();
    $objWriter->save('php://output');
    exit;

?>