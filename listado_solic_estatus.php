<?php
$Nivel = "../../";
include($Nivel."includes/PHP/funciones.php");
session_start();

$conector=Conectar2();

require_once 'PHPExcel/PHPExcel.php';

$rangofecha = $_GET["RangoFecha"];

$fechas = explode("-",$rangofecha);

$objPHPExcel = new PHPExcel();

$tituloReporte = "LISTADO SOLICITUD DE MUELLE ESTATUS";

$titulosColumnas = array('Nro.','NUM. SOLIC','TIPO DE SOLICITUD','NOMBRE DE BUQUE','ESLORA','TRB','CALADO POPA','CALADO PROA','BANDERA','VIAJE','AGENTE','MUELLE','ETA','ESTATUS DE LA SOLICITUD');

$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A1:N1');

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1',  $tituloReporte);

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
->setCellValue('N3',  $titulosColumnas[13]);

//ESTILO DE RESALTAR VERDE
$miestiloverde = new PHPExcel_Style();
$miestiloverde ->applyFromArray(
    array(
        'font' => array(
        'name'      => 'Arial',               
        'color'     => array(
            'rgb' => '330000'
        )
    ),
    'fill' 	=> array(
        'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
        'color'		=> array('argb' => '9ACD32')
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
//FIN VERDE
//ESTILO DE RESALTAR BLANCO
$miestiloblanco = new PHPExcel_Style();
$miestiloblanco ->applyFromArray(
    array(
        'font' => array(
        'name'      => 'Arial',               
        'color'     => array(
            'rgb' => '330000'
        )
    ),
    'fill' 	=> array(
        'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
        'color'		=> array('argb' => 'FFFFFF')
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
//FIN BLANCO
//ESTILO DE RESALTAR AZUL
$miestiloazul = new PHPExcel_Style();
$miestiloazul->applyFromArray(
    array(
        'font' => array(
        'name'      => 'Arial',               
        'color'     => array(
            'rgb' => '330000'
        )
    ),
    'fill' 	=> array(
        'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
        'color'		=> array('argb' => '4169E1')
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
//FIN AZUL
//ESTILO DE RESALTAR ROJO  
$miestilorojo = new PHPExcel_Style();
$miestilorojo ->applyFromArray(
    array(
        'font' => array(
        'name'      => 'Arial',               
        'color'     => array(
            'rgb' => '330000'
        )
    ),
    'fill' 	=> array(
        'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
        'color'		=> array('argb' => 'FF4500')
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
//FIN ROJO
//ESTILO DE RESALTAR AMARILO
$miestiloamarillo = new PHPExcel_Style();
$miestiloamarillo ->applyFromArray(
    array(
        'font' => array(
        'name'      => 'Arial',               
        'color'     => array(
            'rgb' => '330000'
        )
    ),
    'fill' 	=> array(
        'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
        'color'		=> array('argb' => 'FFD700')
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
//FIN AMARILLO
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
        'color'	=> array('argb' => 'bdbdbd')
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
        'color'	=> array('argb' => 'bdbdbd')
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
        'size' =>9,                         
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' 	=> array(
        'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation'   => 90,
        'startcolor' => array(
            'rgb' => 'bdbdbd'
        ),
        'endcolor'   => array(
            'argb' => 'bdbdbd'
        )
    )
    
    );

    $vSQL = "SELECT * FROM [web].[UFT_LISTADO_SOLIC_ESTATUS] (
'$fechas[0]'
,'$fechas[1]')";
    $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    $i =4; 
    $j = 1;
    $CONEXION=$ResultadoEjecutar["CONEXION"];						
    $ERROR=$ResultadoEjecutar["ERROR"];
    $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
    $resul=$ResultadoEjecutar["RESULTADO"];
    if($CONEXION=="SI" and $ERROR=="NO")
    {    
        while ($registro=odbc_fetch_array($resul))
		{ 
 /* SI EXISTE ALGUNA VALIDACION EN LOS REPORTES  */
            if (odbc_result($resul,'ESTATUS') == 'Elaboracion Web')
                {
               $ESTATUS = 0; }

            if (odbc_result($resul,'ESTATUS') == 'Aprobado Ventas')
               {
                   $ESTATUS = 1;}

            if (odbc_result($resul,'ESTATUS') == 'Aprobado Operaciones')
                   {    
                    $ESTATUS = 2;} 
            
            if (odbc_result($resul,'ESTATUS') == 'Anulado')
                {    
                   $ESTATUS = 3;} 

            if (odbc_result($resul,'ESTATUS') == 'Aprobado Administracion')
                   {    
                    $ESTATUS = 4;} 

            if (odbc_result($resul,'ESTATUS') == 'Aprob. Ventas Planif.')
                    {    
                     $ESTATUS = 8;} 
            
             

            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $j)
            ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'NROSOLIC')))
            ->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'TIPO_SOLICITUD')))
            ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'BUQUE')))
            ->setCellValue('E'.$i, odbc_result($resul,'ESLORA'))
            ->setCellValue('F'.$i, utf8_encode(odbc_result($resul,'TRB')))
            ->setCellValue('G'.$i, utf8_encode(odbc_result($resul,'CALADO_POPA')))
            ->setCellValue('H'.$i, utf8_encode(odbc_result($resul,'CALADO_PROA')))
            ->setCellValue('I'.$i, odbc_result($resul,'BANDERA'))
            ->setCellValue('J'.$i, utf8_encode(odbc_result($resul,'NRO_VIAJE')))
            ->setCellValue('K'.$i, $registro['AGENTE'])
            ->setCellValue('L'.$i, $registro['MUELLE'])
            ->setCellValue('M'.$i, $registro['ETA'])
            ->setCellValue('N'.$i, $registro['ESTATUS']);
            
            //CONDICIONES PARA RESALTAR

            if ($ESTATUS == 0) 
                {
                $objPHPExcel->getActiveSheet()->setSharedStyle($miestiloblanco, "N".$i.":N".$i); 
                    }
            if ($ESTATUS == 1) 
                   {
                $objPHPExcel->getActiveSheet()->setSharedStyle($miestiloamarillo, "N".$i.":N".$i); 
                     }
            if ($ESTATUS == 2) 
                     {
                $objPHPExcel->getActiveSheet()->setSharedStyle($miestiloazul, "N".$i.":N".$i); 
                         }
            if ($ESTATUS == 3) 
                         {
                    $objPHPExcel->getActiveSheet()->setSharedStyle($miestilorojo, "N".$i.":N".$i); 
                             }
            if ($ESTATUS == 4) 
                   {
                     $objPHPExcel->getActiveSheet()->setSharedStyle($miestiloamarillo, "N".$i.":N".$i); 
                        }
            if ($ESTATUS == 8) 
                     {
                     $objPHPExcel->getActiveSheet()->setSharedStyle($miestiloverde, "N".$i.":N".$i); 
                         }
                $ESTATUS=0;    
                                  
      
            $i ++;
            $j ++;
        }
    }else{
    }
    

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
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:N3')->applyFromArray($estiloTituloColumnas);
   
    
    for($i = 'A'; $i <= 'N'; $i++)
    {
        $objPHPExcel->setActiveSheetIndex(0)			
            ->getColumnDimension($i)->setAutoSize(TRUE);
    }

    $objPHPExcel->getActiveSheet()->setTitle('LISTADO DE SOLICITUD ESTATUS');

    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
    
    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="REPORTESOLICESTATUS.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
    ob_start();
    $objWriter->save('php://output');
    exit;

?>