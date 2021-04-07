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
                    totales = {}
                    totales = Arreglo['TOTALES'];
                    saldo = totales[0].total
                    $('#fg_base').val(totales[0].fg_base)
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

                    pagos = {}
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
                                $('#actual').val(1)
                                $('#agre_pago').prop("disabled", false)
                                if ($('#fg_base').val() == 1) {
                                    $('#agre_reten').prop("disabled", false)
                                }
                            }
                        });
                    }

                    //crear_tabla(pagos)
                    saldos()
                    consultar_saldo()
                }
            }
        }
    });
} // FIN DE CONSULTA DE PAGOS//


// ELIMINAR PAGOS//
function eliminarpago(id_mov) {

    if ($('#id_facturacion').val() != '') {
        MostrarMensaje("Rojo", "Disculpe, no puede eliminar el pago porque ya fue asociada a una factura");
        return false
    }
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

//CONSULTAR PORCEN. DE RETENCIONES//
function tipo_mov_listado(clasif) {
    Parametros = "clasif=" + clasif;
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/consultas/ScriptConsultarTipomov.php",
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
                    $('#tp_mov').html(Arreglo['COMBO']);
                    $('#moneda').html(Arreglo['COMBO2']);
                }
            }
        }
    });

} //FIN DE CONSULTA DE  PORCEN. RETEN//


//CONSULTAR CUENTA BANCARIA RECAUDADORA//
function buscar_cta_rec_inter() {
    banco = $('#banco_inter_reca').val();
    moneda = $('#moneda').val();
    if (banco == '') {} else {
        Parametros = "banco=" + banco + "&moneda=" + moneda;
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "Sistema/Facturacion/consultas/ScriptConsultarctaRecauda.php",
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
                        $('#cta_recaudadora').html(Arreglo['COMBO']);

                    }
                }
            }
        });
    }
} //FIN DE CONSULTA DE  CUENTA BANCARIA RECAUDADORA//


//CONSULTAR BANCO RECAUDADOR INTERNACIONAL//
function buscar_banco_rec_inter() {
    moneda = $('#moneda').val();
    if (moneda == '') {} else {
        Parametros = "moneda=" + moneda;
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "Sistema/Facturacion/consultas/ScriptConsultarbancoiner.php",
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
                        $('#banco_inter_reca').html(Arreglo['COMBO']);
                        $('#banco').html(Arreglo['COMBO']);
                        $('#banco_inter').html(Arreglo['COMBO2']);
                    }
                }
            }
        });
    }
} //FIN DE CONSULTA DE  BANCO RECAUDADOR INTERNACIONAL//

//CONSULTAR CUENTA BANCARIA RECAUDADORA//
function buscar_cta_interme() {
    banco = $('#banco_inter_reca').val();
    moneda = $('#moneda').val();
    if (banco == '') {} else {
        Parametros = "banco=" + banco + "&moneda=" + moneda;
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "Sistema/Facturacion/consultas/ScriptConsultarctaRecauda.php",
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
                        $('#cta_recaudadora').html(Arreglo['COMBO']);

                    }
                }
            }
        });
    }
} //FIN DE CONSULTA DE  CUENTA BANCARIA RECAUDADORA//

//CONSULTAR CUENTA BANCARIA INTERMEDIARIA//
function buscar_cta_interme() {
    banco = $('#banco_inter_reca').val();
    moneda = $('#moneda').val();
    cta_recaudadora = $('#cta_recaudadora').val();
    if (banco == '') {} else {
        Parametros = "banco=" + banco + "&moneda=" + moneda + "&cta_recaudadora=" + cta_recaudadora;
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "Sistema/Facturacion/consultas/ScriptConsultarctainterm.php",
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
                        $('#cta_intermediaria').html(Arreglo['COMBO']);

                    }
                }
            }
        });
    }
} //FIN DE CONSULTA DE  CUENTA BANCARIA INTERMEDIARIA//

//CONSULTAR EL VALOR DE LA MONEDA//
function consulta_moneda() {
    fecha_inter = $('#fecha_inter').val();
    moneda = $('#moneda').val();
    cta_recaudadora = $('#cta_recaudadora').val();
    if (banco == '') {} else {

        if ($('#documento').val() == '') {
            Parametros = "fecha_inter=" + fecha_inter + "&moneda=" + moneda + "&id_pre=" + totales[0].id_preliquidacion + "&id_moneda=" + totales[0].id_moneda;
            urls = "Sistema/Facturacion/consultas/ScriptConsultarValorMoneda.php"
        } else {
            documento = $('#documento').val()
            id_moneda = $('#id_moneda').val()
            Parametros = "fecha_inter=" + fecha_inter + "&moneda=" + moneda + "&documento=" + documento + "&id_moneda=" + id_moneda;
            urls = "Sistema/pagosdocumento/insert/ScriptConsultarValorMoneda.php"
        }

        $.ajax({
            type: "POST",
            dataType: "html",
            url: urls,
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

                        if (Arreglo['ID'] == 1) {
                            MostrarMensaje("verde", Arreglo['MENSAJE']);
                            $('#titulos').html("Total a Pagar en Moneda Extranjera ( " + $("#moneda option:selected").text() + ")")
                            $('#tasa_cambio').val(Arreglo['CAMBIO_MONEDA_MOV'])
                            $('#mto_pagar').val(Arreglo['MTO_CANCEL'])
                            $('#div_banco_inter_reca').show()
                            $('#div_cta_inter_reca').show()
                            $('#div_banco_interme').show()
                            $('#div_cta_inter').show()
                            $('#div_referencia').show()
                            $('#div_monto').show()
                            $('#div_fecha').show()
                            $('#div_monto_usado').show()
                            $('#div_observacion').show()
                            $('#div_cambio').show()
                            $('#div_mto_pagar').show()
                        } else {
                            MostrarMensaje("Rojo", Arreglo['MENSAJE']);
                        }

                    }
                }
            }
        });
    }
} //FIN DE CONSULTA EL VALOR DE LA MONEDA//

//CONSULTAR EL VALOR DE LA MONEDA//
function consulta_aviso(Paremetros) {
    referencia = $('#referencia').val();
    moneda = $('#moneda').val();
    tp_mov = $('#tp_mov').val();
    if (($('#id_documento').val() == '') || ($('#id_documento').val() === undefined)) {
        Parametros = "referencia=" + referencia + "&id_cliente=" + totales[0].id_cliente + "&moneda=" + moneda + "&tp_mov=" + tp_mov;
    } else {
        id_cliente = $('#id_cliente').val()
        Parametros = "referencia=" + referencia + "&id_cliente=" + id_cliente + "&moneda=" + moneda + "&tp_mov=" + tp_mov;
    }

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/consultas/ScriptconsultarAviso.php",
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
                    if (Arreglo['ID'] != 0) {
                        MostrarMensaje("verde", Arreglo['MENSAJE']);
                        $('#div_monto').show()
                        $('#div_monto_usado').show()

                        $('#monto').val(Arreglo['DATOS'][0].monto)
                        $('#monto_usado').val(Arreglo['DATOS'][0].saldo)
                        id_movimiento = Arreglo['DATOS'][0].id
                        $('#monto').focusout()
                    } else {
                        MostrarMensaje("Rojo", Arreglo['MENSAJE']);
                    }

                }
            }
        }
    });

} //FIN DE CONSULTA EL VALOR DE LA MONEDA//


function consultar_saldo() {
    Parametros = "id_pre=" + totales[0].id_preliquidacion;
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/consultas/ScriptconsultarSaldo.php",
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
                    $('#abonado').html(Arreglo['MONTO_ABONADO'])
                    $('#saldoss').html(Arreglo['SALDO_PRELIQ'])
                    $('#afavor').html(Arreglo['SALDOAFAVOR'])
                    if (Arreglo['SALDO_PRELIQ'] == 0) {
                        $('#visualizar').prop("disabled", false)
                        $('#factura').prop("disabled", false)
                    } else {
                        $('#visualizar').prop("disabled", true)
                        $('#factura').prop("disabled", true)
                    }

                }
            }
        }
    });
}