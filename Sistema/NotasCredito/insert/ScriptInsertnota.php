<?php 
$Nivel="../../../";
include($Nivel."includes/PHP/funciones.php");
$Conector=Conectar();
session_start();
$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
$ID_LOCALIDAD=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_LOCALIDAD'];	
$ID_USER=$_SESSION[$_SESSION['SISTEMA_SIGLA'].'ID_USUARIO'];

$detalles = json_decode($_POST["detalles"]);
$talonario = $_POST["talonario"];
$documento = $_POST["documento"];
$motivo = $_POST["motivo"];
$afectado= $_POST["afectado"];



$vSQL="EXEC [dbo].[SP_GENERAR_NOTA_CREDITO] '$documento',$ID_USER,'$motivo','$talonario',$afectado";
$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
$CONEXION=$ResultadoEjecutar["CONEXION"];
$ERROR=$ResultadoEjecutar["ERROR"];
$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
$resultado=$ResultadoEjecutar["RESULTADO"];

if($CONEXION=="SI" and $ERROR=="NO")
{		
    while (odbc_fetch_array($resultado))
    {
        $ID=odbc_result($resultado,"ID");
		$ID_AVISO=odbc_result($resultado,"ID_AVISO");
        $MENSAJE=odbc_result($resultado,"MENSAJE");

        foreach( $detalles  as $r){
            if ($r->afectado <> '000'){
                 $vSQL="EXEC [dbo].[SP_GENERAR_NOTA_CREDITO_DET] '$ID','$r->id_detalle_documento',$r->afectado,'$documento'";
                $ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                $CONEXION=$ResultadoEjecutar["CONEXION"];
                $ERROR=$ResultadoEjecutar["ERROR"];
                $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
            }
            
        }
       
        $Arreglo["ID"]=$ID;
        $Arreglo["MENSAJE"]=$MENSAJE;
		$Arreglo["ID_AVISO"]=$ID_AVISO;

        $Arreglo["CONEXION"]=$CONEXION;	
        $Arreglo["ERROR"]=$ERROR;
        
    }
}
else
{
    $Arreglo["CONEXION"]=$CONEXION;
    $Arreglo["ERROR"]=$ERROR;
    $Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
}

echo json_encode($Arreglo);

$Conector->Cerrar();
?>