<?php
$Nivel = "../../";
include($Nivel."includes/PHP/funciones.php");
session_start();
header("Content-type: text/html; charset=utf8");
$conector=Conectar(); /* conexion a la base de datos */

require_once 'PHPExcel/PHPExcel.php';  /* libreria para expotar a excel */

/* ------------------------- parametros de la consulta del reporte ------------------------*/

$Localidad=$_GET["puerto"];

/* -------------------FIN PARAMETROS ------------------------ */


/* ---------- INICIO DEL OBJETO EXCEL ----------------- */
$objPHPExcel = new PHPExcel();

/*--------- TITULO DEL REPORTE ----------------------------- */
$tituloReporte = "PRELIQUIDACIONES PENDIENTES POR FACTURAR";

/* ------ ACTIVAR PESTAÑA DE EXCEL ------------ */
$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A1:U1'); /* --- COMBINAR CELDAS ---- */

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1',  $tituloReporte); /* --- ASIGNAR EL TITULO DEL REPORTE A LA CELDA ---- */



/*--- NOMBRE DE LAS COLUMNAS ----------- */
$titulosColumnas = array('NRO','NOMBRE DE LA LOCALIDAD','SISTEMA QUE GENERA LA PRELIQUIDACION','TIPO DE SERVICIO','NRO PLANILLA','RIF DEL CLIENTE','NOMBRE DEL CLIENTE','MONEDA','NOMBRE DEL BUQUE','TIPO DE BUQUE','ESLORA','TRB','NACIONALIDAD','RENAVE','TOTAL','TIPO_OPERACION','MUELLE','CAMBIO_MONEDA','FECHA_CAMBIO','FECHA_ATRAQUE','FECHA_ZARPE');     
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
->setCellValue('U3',  $titulosColumnas[20]);








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
     $vSQL = "SELECT * FROM [dbo].[FN_RPT_PRELIQ_PENDIENTE_POR_FACTURAR] ($Localidad)";

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
            ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'LOCALIDAD')))
            ->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'SISTEMA_GENERA')))
            ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'TIPO_SERVICIO')))
            ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'NRO_PLANILLA')))
            ->setCellValue('F'.$i, utf8_encode(odbc_result($resul,'RIF_CLIENTE')))
            ->setCellValue('G'.$i, utf8_encode(odbc_result($resul,'NB_CLIENTE')))
            ->setCellValue('H'.$i, utf8_encode(odbc_result($resul,'NB_MONEDA')))
            ->setCellValue('I'.$i, utf8_encode(odbc_result($resul,'NB_BUQUE')))
            ->setCellValue('J'.$i, utf8_encode(odbc_result($resul,'TIPO_BUQUE')))
            ->setCellValue('K'.$i, utf8_encode(odbc_result($resul,'ESLORA')))
            ->setCellValue('L'.$i, utf8_encode(odbc_result($resul,'TRB')))
            ->setCellValue('M'.$i, utf8_encode(odbc_result($resul,'NACIONALIDAD')))
            ->setCellValue('N'.$i, utf8_encode(odbc_result($resul,'RENAVE')))
            ->setCellValue('O'.$i, (odbc_result($resul,'TOTAL')))
            ->setCellValue('P'.$i, utf8_encode(odbc_result($resul,'TIPO_OPERACION')))
            ->setCellValue('Q'.$i, utf8_encode(odbc_result($resul,'MUELLE')))
            ->setCellValue('R'.$i, (odbc_result($resul,'CAMBIO_MONEDA')))
            ->setCellValue('S'.$i, FechaNormal(odbc_result($resul,'FECHA_CAMBIO')))
            ->setCellValue('T'.$i, FechaNormal(odbc_result($resul,'FECHA_ATRAQUE')))
            ->setCellValue('U'.$i, FechaNormal(odbc_result($resul,'FECHA_ZARPE')));
        
        

            $i ++;
            $j ++;
        }
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
    $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:U3')->applyFromArray($estiloTituloColumnas);
    
    /* AUTO SIZE A LAS COLUMNAS */     


    /* FIN */

    /* TITULO A LA PESTAÑA ACTIVA */ 
    
    $objPHPExcel->getActiveSheet()->setTitle('PENDIENTES POR FACTURAR');

    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
    
    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="PRELIQUIDACIONES_PENDIENTES_POR_FACTURAR.xlsx"'); // CAMBIAR EL NOMBRE DEL REPORTE 
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
    ob_start();
    $objWriter->save('php://output');
    exit;

?>