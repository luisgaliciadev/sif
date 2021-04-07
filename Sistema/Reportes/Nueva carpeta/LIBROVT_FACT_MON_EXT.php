<?php
$Nivel = "../../";
include($Nivel."includes/PHP/funciones.php");
session_start();
header("Content-type: text/html; charset=utf8");
$conector=Conectar();

require_once 'PHPExcel/PHPExcel.php';
//PARAMETROS
$Localidad=$_GET["puerto"];
$rangofecha = $_GET["RangoFecha"];

$fechas = explode("-",$rangofecha);

$objPHPExcel = new PHPExcel();

$tituloReporte = "LIBRO DE VENTAS FACTURAS MONEDA EXTRANJERA (Sin Retenciones)";


$titulosColumnas = array ('NRO','TIPO DOCUMENTO','LOCALIDAD','SERIE','NRO. CONTROL','NRO. DOCUMENTO','ESTATUS','FECHA EMISION','RIF','RAZON SOCIAL','DOC. AFECTADO','FECHA DE ANULACION','MONEDA DEL DOCUMENTO','CONDICION DE PAGO','MONEDA BASE','VALOR CAMBIO BS.','MONTO GRAVADO BASE','MONTO GRAVADO','MONTO NO GRAVADO','SUB-TOTAL MONEDA BASE','SUB-TOTAL','ALICUOTA IVA','MONTO IVA','MONTO TOTAL','MONTO TOTAL MONEDA BASE (BS)');

$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A1:Y1');

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1'  ,$tituloReporte);

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
//->setCellValue('Z3',  $titulosColumnas[25]);

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
        'color'	=> array('argb' => '6699ff')
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

$estiloTituloColumnas = array(
    'font' => array(
        'name'      => 'Arial',
		'bold'      => true,
        'size' =>10,                         
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' 	=> array(
        'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation'   => 90,
        'startcolor' => array(
            'rgb' => '6699ff'
        ),
        'endcolor'   => array(
            'argb' => 'bdbdbd'
        )
    )
    
    );
        
   $vSQL = "SELECT * FROM [dbo].[FN_RPT_LIBRO_VENTA_MONEDA_BASE_DIVISA] ($Localidad, '$fechas[0]','$fechas[1]')"; 
   $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    $i = 4; 
    $j = 1;
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
            ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'TIPO_DOCUMENTO')))
            ->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'NB_LOCALIDAD')))
            ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'NB_SERIE')))
            ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'NRO_CONTROL')))
            ->setCellValue('F'.$i, utf8_encode(odbc_result($resul,'NRO_DOCUMENTO')))
            ->setCellValue('G'.$i, utf8_encode(odbc_result($resul,'DS_ESTATUS')))
            ->setCellValue('H'.$i, utf8_encode(odbc_result($resul,'F_EMISION')))
            ->setCellValue('I'.$i, utf8_encode(odbc_result($resul,'RIF_CLIENTE')))
            ->setCellValue('J'.$i, utf8_encode(odbc_result($resul,'NOMBRE_CLIENTE')))
            ->setCellValue('K'.$i, utf8_encode(odbc_result($resul,'DOC_AFECTADO')))
            ->setCellValue('L'.$i, utf8_encode(odbc_result($resul,'F_ANULACION')))
            ->setCellValue('M'.$i, utf8_encode(odbc_result($resul,'MONEDA_DOCUMENTO')))
            ->setCellValue('N'.$i, utf8_encode(odbc_result($resul,'NB_CONDICION_PAGO')))
            ->setCellValue('O'.$i, utf8_encode(odbc_result($resul,'MONEDA_BASE')))
            ->setCellValue('P'.$i, utf8_encode(odbc_result($resul,'VALOR_CAMBIO')))
            ->setCellValue('Q'.$i, utf8_encode(odbc_result($resul,'MTO_GRAVADO_BASE')))
            ->setCellValue('R'.$i, utf8_encode(odbc_result($resul,'MTO_GRAVADO')))
            ->setCellValue('S'.$i, utf8_encode(odbc_result($resul,'MTO_NOGRAVADO')))
            ->setCellValue('T'.$i, utf8_encode(odbc_result($resul,'SUB_TOTA_BASE')))
            ->setCellValue('U'.$i, utf8_encode(odbc_result($resul,'SUB_TOTAL')))
            ->setCellValue('V'.$i, utf8_encode(odbc_result($resul,'PORC_IVA')))
            ->setCellValue('W'.$i, utf8_encode(odbc_result($resul,'MTO_IVA')))
            ->setCellValue('X'.$i, utf8_encode(odbc_result($resul,'MTO_TOTAL_BASE')))
            ->setCellValue('Y'.$i, utf8_encode(odbc_result($resul,'MTO_TOTAL')));
            //->setCellValue('Z'.$i, utf8_encode(odbc_result($resul,'')))
			
            
          
            $i ++;
            $j ++;
		}

        // CONSULTAR RESUMEN 
           $vSQL = "SELECT * FROM [dbo].[FN_RPT_RESUM_LIBRO_VENTA_MONEDA_BASE] ($Localidad, '$fechas[0]','$fechas[1]')";  
           $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
            $i= $i+2;
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
                    ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'NB_RESUMEN')))
                    ->setCellValue('C'.$i, (odbc_result($resul,'VALUE_RESUMEN')));
                    
                    $i ++;
                    $j ++;
                }
            }
    }    
    else{

    }
    
    $estiloInformacion = new PHPExcel_Style();
	
    $estiloInformacion->applyFromArray
    (array(
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
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:Y3')->applyFromArray($estiloTituloColumnas);
      
    for($i = 'A'; $i <= 'Y'; $i++)
    {
        $objPHPExcel->setActiveSheetIndex(0)			
            ->getColumnDimension($i)->setAutoSize(TRUE);
    }

    $objPHPExcel->getActiveSheet()->setTitle('LIBRO_VENTAS_EXT');

    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
    
    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="REPORTE_LIBROVT_EXT.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
    ob_start();
    $objWriter->save('php://output');
    exit;
   
?>