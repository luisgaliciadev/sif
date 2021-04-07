<?php
$Nivel = "../../";
include($Nivel."includes/PHP/funciones.php");
session_start();
header("Content-type: text/html; charset=utf8");
$conector=Conectar(); /* conexion a la base de datos */

require_once 'PHPExcel/PHPExcel.php';  /* libreria para expotar a excel */

/* ------------------------- parametros de la consulta del reporte ------------------------*/

$ID_DOCUMENTO = $_GET["ID"];

/* -------------------FIN PARAMETROS ------------------------ */


/* ---------- INICIO DEL OBJETO EXCEL ----------------- */
$objPHPExcel = new PHPExcel();

/*--------- TITULO DEL REPORTE ----------------------------- */
$tituloReporte = "DETALLE DE COBRO";

/* ------ ACTIVAR PESTAÑA DE EXCEL ------------ */
$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A1:Y1'); /* --- COMBINAR CELDAS ---- */

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1',  $tituloReporte); /* --- ASIGNAR EL TITULO DEL REPORTE A LA CELDA ---- */



/*--- NOMBRE DE LAS COLUMNAS ----------- */
$titulosColumnas = array('NRO','ID_DOCUMENTO ','ID_MOVIMIENTO_PAGO ','NB_LOCALIDAD ','NB_TP_PAGO ','NB_TP_MOVIMIENTO ','NB_BANCO ','NRO_CUENTA ','NB_MONEDA  ','REFERENCIA ','F_EMISION ','F_AFECTACION ','MONTO  ','VALOR_BASE  ','MONTO_APLICADO ','STATU ','SALDO  ','PORC_TP_MOVIMIENTO','OBSERVACION_PAGO ','RETENCION ','FG_RET_DEFITITIVA ','ESTATUS_PAGO','DS_ESTATU_MOVIMIENTO ','NRO_DOCUMENTO','NRO_CONTROL');
/*--- FIN NOMBRE DE LAS COLUMNAS ------------ */

/* --- ASIGNAR LOS TITULOS DE LAS COLUMNAS  ---- */
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A3',  $titulosColumnas[0])
->setCellValue('B3',  $titulosColumnas[1])
->setCellValue('C3',  $titulosColumnas[2])
->setCellValue('D3',  $titulosColumnas[3])
->setCellValue('E3',  $titulosColumnas[4])
->setCellValue('F3',  $titulosColumnas[5])
->setCellValue('G3',  $titulosColumnas[6])
->setCellValue('H3',  $titulosColumnas[7])
->setCellValue('I3',  $titulosColumnas[8])
->setCellValue('J3',  $titulosColumnas[9])
->setCellValue('K3',  $titulosColumnas[10])
->setCellValue('L3',  $titulosColumnas[11])
->setCellValue('M3',  $titulosColumnas[12])
->setCellValue('N3',  $titulosColumnas[13])
->setCellValue('O3',  $titulosColumnas[14])
->setCellValue('P3',  $titulosColumnas[15])
->setCellValue('Q3',  $titulosColumnas[16])
->setCellValue('R3',  $titulosColumnas[17])
->setCellValue('S3',  $titulosColumnas[18])
->setCellValue('T3',  $titulosColumnas[19])
->setCellValue('U3',  $titulosColumnas[20])
->setCellValue('V3',  $titulosColumnas[21])
->setCellValue('W3',  $titulosColumnas[22])
->setCellValue('X3',  $titulosColumnas[23]) 
->setCellValue('Y3',  $titulosColumnas[24]); 





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
    $vSQL = "SELECT * FROM [dbo].[FN_RPT_DETALLE_PAGO_DOCUMENTO] '$ID_DOCUMENTO'";

    $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    $CONEXION=$ResultadoEjecutar["CONEXION"];						
    $ERROR=$ResultadoEjecutar["ERROR"];
    $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
    $resul=$ResultadoEjecutar["RESULTADO"];
    /* Fin */
    $i =4; 
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
            ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'ID_DOCUMENTO')))
            ->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'ID_MOVIMIENTO_PAGO')))
            ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'NB_LOCALIDAD')))
            ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'NB_TP_PAGO')))
            ->setCellValue('F'.$i, utf8_encode(odbc_result($resul,'NB_TP_MOVIMIENTO')))
            ->setCellValue('G'.$i, utf8_encode(odbc_result($resul,'NB_BANCO')))
            ->setCellValueExplicit('H'.$i,utf8_encode(odbc_result($resul,'NRO_CUENTA')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('I'.$i, utf8_encode(odbc_result($resul,'NB_MONEDA')))
            ->setCellValueExplicit('J'.$i,utf8_encode(odbc_result($resul,'REFERENCIA')),PHPExcel_Cell_DataType::TYPE_STRING)
            ->setCellValue('K'.$i, FechaNormal(odbc_result($resul,'F_EMISION')))
            ->setCellValue('L'.$i, FechaNormal(odbc_result($resul,'F_AFECTACION')))
            ->setCellValue('M'.$i, (odbc_result($resul,'MONTO')))
            ->setCellValue('N'.$i, utf8_encode(odbc_result($resul,'VALOR_BASE')))
            ->setCellValue('O'.$i, (odbc_result($resul,'MONTO_APLICADO')))
            ->setCellValue('P'.$i, utf8_encode(odbc_result($resul,'STATU')))
            ->setCellValue('Q'.$i, utf8_encode(odbc_result($resul,'SALDO')))
            ->setCellValue('R'.$i, utf8_encode(odbc_result($resul,'PORC_TP_MOVIMIENTO')))
            ->setCellValue('S'.$i, utf8_encode(odbc_result($resul,'OBSERVACION_PAGO')))
            ->setCellValue('T'.$i, utf8_encode(odbc_result($resul,'RETENCION')))
            ->setCellValue('U'.$i, utf8_encode(odbc_result($resul,'FG_RET_DEFITITIVA')))
            ->setCellValue('V'.$i, utf8_encode(odbc_result($resul,'ESTATUS_PAGO')))
            ->setCellValue('W'.$i, utf8_encode(odbc_result($resul,'DS_ESTATU_MOVIMIENTO')))
            ->setCellValue('X'.$i, utf8_encode(odbc_result($resul,'NRO_DOCUMENTO')))
            ->setCellValue('Y'.$i, utf8_encode(odbc_result($resul,'NRO_CONTROL')));
            
   

            $i ++;
            $j ++;
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
    $objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:Y3')->applyFromArray($estiloTituloColumnas);
    
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