//VISUALIZAR FACTURA//

function visualizar_factura() {
    var condicion_pago = $('#condicion_pago').val().split('%%');
    var cat_serv = $('#cat_serv').val()
    var anio = $('#anio').val()
    var pre = $('#pre').val()
    tipo_serv = $('#tipo_serv').val();
    tipo_serv = tipo_serv.split("%%");
    Parametros = "cat_serv=" + cat_serv + "&anio=" + anio + "&pre=" + pre + "&id_sistema=" + tipo_serv[1] + "&condicion_pago=" + condicion_pago[0];
    window.open("sistema/facturacion/vista_prev_fact.php?" + Parametros)
}


// BUSCAR CATEGORIA DE SERVICIOS //
function buscar_categoria_serv() {

    tipo_serv = $('#tipo_serv').val();
    tipo_serv = tipo_serv.split("%%");

    if (tipo_serv == '') {
        $('#cat_serv').html('<option value ="">Seleccione...</option>')
        $('#cabecera').html('')
        $('#anio').val('')
        $('#pre').val('')
        $('#anio').prop("disabled", false);
    } else {
        if (tipo_serv[2] == 0) {
            $('#anio').prop("disabled", true);
            $('#anio').val(0);
        } else {
            $('#anio').prop("disabled", false);
            $('#anio').val(0);
        }
        Parametros = "tipo_serv=" + tipo_serv[0];
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "Sistema/Facturacion/consultas/ScriptConsultar.php",
            data: Parametros,
            beforeSend: function() {
                window.parent.parent.Cargando(1);
            },
            cache: false,
            success: function(result) {
                window.parent.parent.Cargando(0);

                var Arreglo = jQuery.parseJSON(result);

                var CONEXION = Arreglo['CONEXION'];

                if (CONEXION == "NO") {
                    window.parent.Cargando(0);
                    var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                    window.parent.Cargando(0);
                    MostrarMensaje("Rojo", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.");
                } else {
                    var ERROR = Arreglo['ERROR'];

                    if (ERROR == "SI") {
                        window.parent.Cargando(0);
                        var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                        window.parent.Cargando(0);
                        MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
                    } else {
                        $('#cat_serv').html(Arreglo['COMBO']);
                    }
                }
            }
        });
    }
} // FIN DE BUSQUEDA CATEGORIA DE SERVICIOS //



// BUSCAR PRELIQUIDACION//
function buscarpre() {
    var cat_serv = $('#cat_serv').val()
    var anio = $('#anio').val()
    var pre = $('#pre').val()
    tipo_serv = $('#tipo_serv').val();
    tipo_serv = tipo_serv.split("%%");
    if (tipo_serv[2] == 1) {
        if (anio == '') {
            MostrarMensaje("Rojo", "Disculpe, Debe de ingresar el año de la preliquidacion a consultar");
            return false;

        }
    } else {
        $('#anio').prop("disabled", false);
        $('#anio').val('');
    }
    Parametros = "cat_serv=" + cat_serv + "&anio=" + anio + "&pre=" + pre + "&id_sistema=" + tipo_serv[1];
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/consultas/ScriptConsultarpre.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.parent.Cargando(1);
        },
        cache: false,
        success: function(result) {
            window.parent.parent.Cargando(0);

            var Arreglo = jQuery.parseJSON(result);

            var CONEXION = Arreglo['CONEXION'];

            if (CONEXION == "NO") {
                window.parent.Cargando(0);

                var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                window.parent.Cargando(0);
                MostrarMensaje("Rojo", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.");
            } else {
                var ERROR = Arreglo['ERROR'];

                if (ERROR == "SI") {
                    window.parent.Cargando(0);
                    var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                    window.parent.Cargando(0);
                    MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
                } else {
                    $('#cabecera').html(Arreglo['DATOS'])
                    $('#detalle').html(Arreglo['DETALLE'])
                    totales = Arreglo['TOTALES'];
                    console.log(totales)
                    saldo = totales[0].total
                    consultar_pagos(totales[0].id_preliquidacion)
                }
            }
        }
    });
} // FIN PRELIQUIDACION//


// CONSULTAR PAGOS//
function consultar_pagos(id_pre) {
    Parametros = "id_preliquidacion=" + id_pre
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/consultas/ScriptConsultarPagos.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.parent.Cargando(1);
        },
        cache: false,
        success: function(result) {
            window.parent.parent.Cargando(0);

            var Arreglo = jQuery.parseJSON(result);

            var CONEXION = Arreglo['CONEXION'];

            if (CONEXION == "NO") {
                window.parent.Cargando(0);

                var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                window.parent.Cargando(0);
                MostrarMensaje("Rojo", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.");
            } else {
                var ERROR = Arreglo['ERROR'];

                if (ERROR == "SI") {
                    window.parent.Cargando(0);
                    var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                    window.parent.Cargando(0);
                    MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
                } else {


                    pagos = Arreglo['JSON']

                    if (pagos == null) {
                        saldo = totales[0].total
                        $('#detalle_pagos').html('')
                    } else {
                        saldo = calcular(pagos)
                        if (saldo < 0) {
                            afavor = saldo * -1;
                            saldo = 0
                        }
                        $('#detalle_pagos').html(crear_tabla(pagos))
                        $("#condicion_pago option").each(function() {
                            var fg = $(this).attr('value').split("%%")
                            if (fg[1] == 1) {
                                $(this).attr("selected", "selected");
                                $('#agre_pago').prop("disabled", false)
                                $('#agre_reten').prop("disabled", false)
                            }
                        });
                    }

                    //crear_tabla(pagos)
                    saldos()
                }
            }
        }
    });
} // FIN DE CONSULTA DE PAGOS//


// ELIMINAR PAGOS//
function eliminarpago(id_mov) {

    Parametros = "id_movimiento=" + pagos[id_mov].id_movimiento_pago
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/insert/ScriptEliminarPagos.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.parent.Cargando(1);
        },
        cache: false,
        success: function(result) {
            window.parent.parent.Cargando(0);

            var Arreglo = jQuery.parseJSON(result);

            var CONEXION = Arreglo['CONEXION'];

            if (CONEXION == "NO") {
                window.parent.Cargando(0);

                var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                window.parent.Cargando(0);
                MostrarMensaje("Rojo", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.");
            } else {
                var ERROR = Arreglo['ERROR'];

                if (ERROR == "SI") {
                    window.parent.Cargando(0);
                    var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                    window.parent.Cargando(0);
                    MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
                } else {
                    window.parent.Cargando(0);
                    MostrarMensaje("Verde", Arreglo['MENSAJE']);
                    limpiar_div()
                    consultar_pagos(totales[0].id_preliquidacion)
                }
            }
        }
    });
} // FIN DE ELIMINAR PAGOS//


//CONSULTAR CUENTA BANCARIA RECAUDADORA//
function buscar_cta_rec() {
    banco = $('#banco').val();
    if (banco == '') {} else {
        Parametros = "banco=" + banco;
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "Sistema/Facturacion/consultas/ScriptConsultarCta.php",
            data: Parametros,
            beforeSend: function() {
                window.parent.parent.Cargando(1);
            },
            cache: false,
            success: function(result) {
                window.parent.parent.Cargando(0);

                var Arreglo = jQuery.parseJSON(result);

                var CONEXION = Arreglo['CONEXION'];

                if (CONEXION == "NO") {
                    window.parent.Cargando(0);

                    var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                    window.parent.Cargando(0);
                    MostrarMensaje("Rojo", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.");
                } else {
                    var ERROR = Arreglo['ERROR'];

                    if (ERROR == "SI") {
                        window.parent.Cargando(0);
                        var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                        window.parent.Cargando(0);
                        MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
                    } else {
                        $('#cuenta').html(Arreglo['COMBO']);
                    }
                }
            }
        });
    }
} //FIN DE CONSULTA DE  CUENTA BANCARIA RECAUDADORA//

//CONSULTAR PORCEN. DE RETENCIONES//
function consultar_porce(tipo_reten) {
    Parametros = "tipo_reten=" + tipo_reten;
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/consultas/ScriptConsultarTpReten.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.parent.Cargando(1);
        },
        cache: false,
        success: function(result) {
            window.parent.parent.Cargando(0);

            var Arreglo = jQuery.parseJSON(result);

            var CONEXION = Arreglo['CONEXION'];

            if (CONEXION == "NO") {
                window.parent.Cargando(0);

                var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                window.parent.Cargando(0);
                MostrarMensaje("Rojo", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.");
            } else {
                var ERROR = Arreglo['ERROR'];

                if (ERROR == "SI") {
                    window.parent.Cargando(0);
                    var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                    window.parent.Cargando(0);
                    MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
                } else {
                    $('#porc').html(Arreglo['COMBO']);
                }
            }
        }
    });

} //FIN DE CONSULTA DE  PORCEN. RETEN//