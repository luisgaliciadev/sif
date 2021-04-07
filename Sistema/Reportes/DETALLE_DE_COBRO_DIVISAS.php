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
$tituloReporte = "DETALLE DE COBRO MONEDA EXTRANJERA, DESDE:".$fechas[0].' HASTA:'.$fechas[1];

/* ------ ACTIVAR PESTAÑA DE EXCEL ------------ */
$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A1:AB1'); /* --- COMBINAR CELDAS ---- */

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
->mergeCells('A3:AJ3'); /* --- COMBINAR CELDAS ---- */

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A3',  $tituloReporte);

 $objPHPExcel->getActiveSheet()->getStyle('A3:AJ3')->applyFromArray($estiloGrupoReporte); /* ASIGNAR EL TITULO DEL REPORTE A LA CELDA ---- */



/*--- NOMBRE DE LAS COLUMNAS ----------- */
$titulosColumnas = array('NRO','LOCALIDAD','RIF CLIENTE','CLIENTE','NRO DOCUMENTO','NRO CONTROL','FECHA DE EMISION FACTURA','CONDICION DE PAGO','SERIE','MONEDA DOCUMENTO','TIPO DE PAGO','MONEDA DE PAGO','BANCO','NRO CUENTA','TIPO DE MOVIMIENTO','REF  PAGO','CUENTA CHEQUE','RESPONSABLE','FECHA DE EMISION','FECHA DE AFECTACION','OBSERVACION DE PAGO','MONTO','MONTO USADO','SALDO','ESTATUS','MONTO AVISO DOCUMENTO','NRO AVISO','MONTO TOTAL AVISO','CONDICION','MONTO TOTAL','MONTO BASE','MONTO USADO BASE','SALDO BASE','LOGIN REGISTRO','VALOR DE PAR CAMBIARIO','VALOR PAGO MONEDA DOCUMENTO');
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
->setCellValue('AA5', $titulosColumnas[26]) 
->setCellValue('AB5', $titulosColumnas[27])
->setCellValue('AC5', $titulosColumnas[28]) 
->setCellValue('AD5', $titulosColumnas[29]) 
->setCellValue('AE5', $titulosColumnas[30]) 
->setCellValue('AF5', $titulosColumnas[31]) 
->setCellValue('AG5', $titulosColumnas[32]) 
->setCellValue('AH5', $titulosColumnas[33]) 
->setCellValue('AI5', $titulosColumnas[34]) 
->setCellValue('AJ5', $titulosColumnas[35]);




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

    /* ---- Consulta SQl ------ */
     $vSQL = "SELECT * FROM [dbo].[FN_RPT_DETALLE_COBRO_DIVISAS] ($Localidad, '$fechas[0]','$fechas[1]') WHERE GRUPO=1";

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
            ->setCellValue('G'.$i, (odbc_result($resul,'F_EMISION_FACTURA')))
            ->setCellValue('H'.$i, utf8_encode(odbc_result($resul,'CONDICION_PAGO')))
            ->setCellValue('I'.$i, utf8_encode(odbc_result($resul,'NB_SERIE')))
            ->setCellValue('J'.$i, utf8_encode(odbc_result($resul,'MONEDA_DOCUMENTO')))
            ->setCellValue('K'.$i, utf8_encode(odbc_result($resul,'TIPO_PAGO')))
            ->setCellValue('L'.$i, utf8_encode(odbc_result($resul,'MONEDA_PAGO')))
            ->setCellValue('M'.$i, utf8_encode(odbc_result($resul,'NB_BANCO')))
            ->setCellValueExplicit('N'.$i,utf8_encode(odbc_result($resul,'NRO_CUENTA')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('O'.$i, utf8_encode(odbc_result($resul,'NB_TP_MOVIMIENTO')))
            ->setCellValueExplicit('P'.$i,utf8_encode(odbc_result($resul,'REF_PAGO')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValueExplicit('Q'.$i,utf8_encode(odbc_result($resul,'CUENTA_CHEQUE')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('R'.$i, utf8_encode(odbc_result($resul,'RESPONSABLE')))
            ->setCellValue('S'.$i, (odbc_result($resul,'F_EMISION')))
            ->setCellValue('T'.$i, (odbc_result($resul,'F_AFECTACION')))
            ->setCellValue('U'.$i, utf8_encode(odbc_result($resul,'OBSERVACION_PAGO')))
            ->setCellValue('V'.$i, (odbc_result($resul,'MONTO')))
            ->setCellValue('W'.$i, (odbc_result($resul,'MONTO_USADO')))
            ->setCellValue('X'.$i, utf8_encode(odbc_result($resul,'SALDO')))
            ->setCellValue('Y'.$i, utf8_encode(odbc_result($resul,'DS_ESTATU_MOVIMIENTO')))
            ->setCellValue('Z'.$i, (odbc_result($resul,'MONTO_AVISO_DOC')))
            ->setCellValue('AA'.$i, utf8_encode(odbc_result($resul,'NRO_AVISO')))
            ->setCellValue('AB'.$i, (odbc_result($resul,'MONTO_TOTAL_AVISO')))
            ->setCellValue('AC'.$i, utf8_encode(odbc_result($resul,'CONDICION')))
            ->setCellValue('AD'.$i, (odbc_result($resul,'MTO_TOTAL')))
            ->setCellValue('AE'.$i, (odbc_result($resul,'MONTO_BASE')))
            ->setCellValue('AF'.$i, (odbc_result($resul,'MONTO_USADO_BASE')))
            ->setCellValue('AG'.$i, utf8_encode(odbc_result($resul,'SALDO_BASE')))
            ->setCellValue('AH'.$i, utf8_encode(odbc_result($resul,'LOGIN_REGISTRO')))
            ->setCellValue('AI'.$i, utf8_encode(odbc_result($resul,'VALOR_PAR_CAMBIARIO')))
            ->setCellValue('AJ'.$i, utf8_encode(odbc_result($resul,'VALOR_PAGO_MONEDA_DOC')));
           
			
			$objPHPExcel->getActiveSheet()->getStyle('V'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('X'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('Z'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AB'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AC'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AD'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AE'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AF'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AG'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AH'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AI'.$i)->getNumberFormat()->setFormatCode('#.##00');
			
			
			
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
        $vSQL = "SELECT * FROM [dbo].[FN_RPT_RESUM_DETALLE_COBRO_DIVISAS] ($Localidad, '$fechas[0]','$fechas[1]') WHERE GRUPO=1";  
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
                    ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'VALUE_A')))
                    ->setCellValue('F'.$i, (odbc_result($resul,'CANTIDAD')));
					
					$objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getNumberFormat()->setFormatCode('#.##00');
                
                
                $i ++;
                $j ++;
            }
        }
		
		
		
		
		/********************************GRUPO 2*/
	$i= $i+1;
	$tituloReporte = "GRUPO: DOCUMENTOS CANCELADOS EN EL RANGO SELECCIONADO, EMITIDOS OTRO PERIODO";

	/* ------ ACTIVAR PESTAÑA DE EXCEL ------------ */
	$objPHPExcel->setActiveSheetIndex(0)
	->mergeCells('A'.$i.':AB'.$i); /* --- COMBINAR CELDAS ---- */

	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$i,  $tituloReporte);

	 $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':AB'.$i)->applyFromArray($estiloGrupoReporte);

	$i= $i+1;
		
		
	/*--- NOMBRE DE LAS COLUMNAS ----------- */
$titulosColumnas = array('NRO','LOCALIDAD','RIF CLIENTE','CLIENTE','NRO DOCUMENTO','NRO CONTROL','FECHA DE EMISION FACTURA','CONDICION DE PAGO','SERIE','MONEDA DOCUMENTO','TIPO DE PAGO','MONEDA DE PAGO','BANCO','NRO CUENTA','TIPO DE MOVIMIENTO','REF  PAGO','CUENTA CHEQUE','RESPONSABLE','FECHA DE EMISION','FECHA DE AFECTACION','OBSERVACION DE PAGO','MONTO','MONTO USADO','SALDO','ESTATUS','MONTO AVISO DOCUMENTO','NRO AVISO','MONTO TOTAL AVISO','CONDICION','MONTO TOTAL','MONTO BASE','MONTO USADO BASE','SALDO BASE','LOGIN REGISTRO','VALOR DE PAR CAMBIARIO','VALOR PAGO MONEDA DOCUMENTO');
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
	->setCellValue('AA'.$i, $titulosColumnas[26]) 
	->setCellValue('AB'.$i, $titulosColumnas[27])
	->setCellValue('AC'.$i, $titulosColumnas[28]) 
	->setCellValue('AD'.$i, $titulosColumnas[29]) 
	->setCellValue('AE'.$i, $titulosColumnas[30]) 
	->setCellValue('AF'.$i, $titulosColumnas[31]) 
	->setCellValue('AG'.$i, $titulosColumnas[32]) 
	->setCellValue('AH'.$i, $titulosColumnas[33]) 
	->setCellValue('AI'.$i, $titulosColumnas[34]) 
	->setCellValue('AJ'.$i, $titulosColumnas[35])
	->setCellValue('AK'.$i, $titulosColumnas[36]);	
		
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':AK'.$i)->applyFromArray($estiloTituloColumnas);
		
	 /* ---- Consulta SQl ------ */
    $vSQL = "SELECT * FROM [dbo].[FN_RPT_DETALLE_COBRO_DIVISAS] ($Localidad, '$fechas[0]','$fechas[1]') WHERE GRUPO=2";

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
            ->setCellValue('G'.$i, FechaNormal(odbc_result($resul,'F_EMISION_FACTURA')))
            ->setCellValue('H'.$i, utf8_encode(odbc_result($resul,'CONDICION_PAGO')))
            ->setCellValue('I'.$i, utf8_encode(odbc_result($resul,'NB_SERIE')))
            ->setCellValue('J'.$i, utf8_encode(odbc_result($resul,'MONEDA_DOCUMENTO')))
            ->setCellValue('K'.$i, utf8_encode(odbc_result($resul,'TIPO_PAGO')))
            ->setCellValue('L'.$i, utf8_encode(odbc_result($resul,'MONEDA_PAGO')))
            ->setCellValue('M'.$i, utf8_encode(odbc_result($resul,'NB_BANCO')))
            ->setCellValueExplicit('N'.$i,utf8_encode(odbc_result($resul,'NRO_CUENTA')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('O'.$i, utf8_encode(odbc_result($resul,'NB_TP_MOVIMIENTO')))
            ->setCellValueExplicit('P'.$i,utf8_encode(odbc_result($resul,'REF_PAGO')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValueExplicit('Q'.$i,utf8_encode(odbc_result($resul,'CUENTA_CHEQUE')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('R'.$i, utf8_encode(odbc_result($resul,'RESPONSABLE')))
            ->setCellValue('S'.$i, (odbc_result($resul,'F_EMISION')))
            ->setCellValue('T'.$i, (odbc_result($resul,'F_AFECTACION')))
            ->setCellValue('U'.$i, utf8_encode(odbc_result($resul,'OBSERVACION_PAGO')))
            ->setCellValue('V'.$i, (odbc_result($resul,'MONTO')))
            ->setCellValue('W'.$i, (odbc_result($resul,'MONTO_USADO')))
            ->setCellValue('X'.$i, utf8_encode(odbc_result($resul,'SALDO')))
            ->setCellValue('Y'.$i, utf8_encode(odbc_result($resul,'DS_ESTATU_MOVIMIENTO')))
            ->setCellValue('Z'.$i, (odbc_result($resul,'MONTO_AVISO_DOC')))
            ->setCellValue('AA'.$i, utf8_encode(odbc_result($resul,'NRO_AVISO')))
            ->setCellValue('AB'.$i, (odbc_result($resul,'MONTO_TOTAL_AVISO')))
            ->setCellValue('AC'.$i, utf8_encode(odbc_result($resul,'CONDICION')))
            ->setCellValue('AD'.$i, (odbc_result($resul,'MTO_TOTAL')))
            ->setCellValue('AE'.$i, (odbc_result($resul,'MONTO_BASE')))
            ->setCellValue('AF'.$i, (odbc_result($resul,'MONTO_USADO_BASE')))
            ->setCellValue('AG'.$i, utf8_encode(odbc_result($resul,'SALDO_BASE')))
            ->setCellValue('AH'.$i, utf8_encode(odbc_result($resul,'LOGIN_REGISTRO')))
            ->setCellValue('AI'.$i, utf8_encode(odbc_result($resul,'VALOR_PAR_CAMBIARIO')))
            ->setCellValue('AJ'.$i, utf8_encode(odbc_result($resul,'VALOR_PAGO_MONEDA_DOC')));
           
			
			$objPHPExcel->getActiveSheet()->getStyle('V'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('X'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('Z'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AB'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AC'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AD'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AE'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AF'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AG'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AH'.$i)->getNumberFormat()->setFormatCode('#.##00');
			$objPHPExcel->getActiveSheet()->getStyle('AI'.$i)->getNumberFormat()->setFormatCode('#.##00');
			
			
			
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
        $vSQL = "SELECT * FROM [dbo].[FN_RPT_RESUM_DETALLE_COBRO_DIVISAS] ($Localidad, '$fechas[0]','$fechas[1]') WHERE GRUPO=2";  
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
                    ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'VALUE_A')))
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
		$vSQL = "SELECT * FROM [dbo].[FN_RPT_AVISOS_GENERADOS] ($Localidad, '$fechas[0]','$fechas[1]',0)";  
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
    $objPHPExcel->getActiveSheet()->getStyle('A1:AJ1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A5:AJ5')->applyFromArray($estiloTituloColumnas);


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
	$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20);

    /* AUTO SIZE A LAS COLUMNAS */     
    
    /* AUTO SIZE A LAS COLUMNAS */     


    /* FIN */

    /* TITULO A LA PESTAÑA ACTIVA */ 
    
    $objPHPExcel->getActiveSheet()->setTitle('COBRO DE DIVISAS');

    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
    
    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DETALLE_DE_COBRO_DIVISAS.xlsx"'); // CAMBIAR EL NOMBRE DEL REPORTE 
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
    ob_start();
    $objWriter->save('php://output');
    exit;

?>