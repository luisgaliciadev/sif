function guardar_factura() {
    var talonario = $('#talonario').val()
    var condicion_pago = $('#condicion_pago').val().split('%%')

    Parametros = "talonario=" + talonario + "&condicion_pago=" + condicion_pago[0] + "&id_preliquidacion=" + totales[0].id_preliquidacion + "&id_moneda=" + totales[0].id_moneda
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/insert/ScriptinsertFact.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.Cargando(1);
        },
        cache: false,
        success: function(result) {
            window.parent.parent.Cargando(0);
            datos_factura = jQuery.parseJSON(result);
            var Arreglo = jQuery.parseJSON(result);
            var CONEXION = Arreglo['CONEXION'];

            if (CONEXION == "NO") {
                window.parent.Cargando(0);

                var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                window.parent.Cargando(0);
                swal("Error", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.", "error");
                //MostrarMensaje("Rojo", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.");
            } else {
                var ERROR = datos_factura['ERROR'];

                if (ERROR == "SI") {
                    window.parent.Cargando(0);
                    var MSJ_ERROR = datos_factura['MSJ_ERROR'];
                    window.parent.Cargando(0);
                    swal("Error", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.", "error");
                } else {

                    $('#factura').prop("disabled", true)
                    $('#agre_pago').prop("disabled", true)
                    $('#agre_reten').prop("disabled", true)
                    $('#visualizar').prop("disabled", true)
                    $('#condicion_pago').prop("disabled", true)
                    $('#ver_factura').prop("disabled", false)
                    id_factura = Arreglo['ID']
                    $('#id_facturacion').val(Arreglo['ID'])
                    swal("Factura", Arreglo['MENSAJE'], "success");
                    $('#cancelar_talon').click()
                    $('#saldoss').html(0.00)
                    $('#afavor').html(0.00)
                    afavor = 0;
                    window.parent.Cargando(0);
                    if (Arreglo['AVISO'] == 1) {
                        $('#aviso').prop("disabled", false)
                    }
                }
            }

        }
    });
}

//INSERTAR CHEQUES DE GENERENCIAS//
function insert_cheq(Parametros) {
    if (saldo == 0) {
        MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la preliquidacion fue cancelada en su totalidad");
        return false
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/insert/ScriptinsertCheq.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.Cargando(1);
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
                    if (Arreglo['ID'] == 0) {
                        MostrarMensaje("Rojo", Arreglo['MENSAJE']);
                    } else {
                        limpiar_div()
                        consultar_pagos(totales[0].id_preliquidacion)
                        $('#cancelar_pagos').click()
                        MostrarMensaje("Verde", Arreglo['MENSAJE']);
                    }
                }
            }
        }
    });
} //FIN DE INSERTAR CHEQUES DE GERENCIAS//

//INSERTAR CHEQUES DE GENERENCIAS//
function insert_pdv(Parametros) {
    if (saldo == 0) {
        MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la preliquidacion fue cancelada en su totalidad");
        return false
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/insert/ScriptinsertPdv.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.Cargando(1);
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

                    if (Arreglo['ID'] == 0) {
                        MostrarMensaje("Rojo", Arreglo['MENSAJE']);
                    } else {
                        limpiar_div()
                        consultar_pagos(totales[0].id_preliquidacion)
                        $('#cancelar_pagos').click()
                        MostrarMensaje("Verde", Arreglo['MENSAJE']);
                    }
                    window.parent.Cargando(0);


                }
            }
        }
    });
} //FIN DE INSERTAR CHEQUES DE GERENCIAS//


//INSERTAR TRANSFERENCIAS Y DEPOSITOS//
function guardar_trans_dep(Parametros) {
    if (saldo == 0) {
        MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la preliquidacion fue cancelada en su totalidad");
        return false
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/insert/ScriptinsertTransDep.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.Cargando(1);
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

                    if (Arreglo['ID'] == 0) {
                        MostrarMensaje("Rojo", Arreglo['MENSAJE']);
                    } else {
                        limpiar_div()
                        consultar_pagos(totales[0].id_preliquidacion)
                        $('#cancelar_pagos').click()
                        MostrarMensaje("Verde", Arreglo['MENSAJE']);
                    }

                    window.parent.Cargando(0);

                }
            }
        }
    });
} //FIN DE INSERTAR TRANSFERENCIAS Y DEPOSITOS//

//INSERTAR RETENCIONES//
function guardar_retenciones(Parametros) {
    if (saldo == 0) {
        MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la preliquidacion fue cancelada en su totalidad");
        return false
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/insert/ScriptinsertReten.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.Cargando(1);
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
} //FIN DE INSERTAR RETENCIONES//

//INSERTAR TRANSFERENCIAS INTERNACIONALES//
function transferencia_internacional(Parametros) {
    if (saldo == 0) {
        MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la preliquidacion fue cancelada en su totalidad");
        return false
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/insert/ScriptinsertTransferenciasinter.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.Cargando(1);
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
                    if (Arreglo['ID'] == 0) {
                        MostrarMensaje("Rojo", Arreglo['MENSAJE']);
                    } else {
                        limpiar_div()
                        consultar_pagos(totales[0].id_preliquidacion)
                        $('#cancelar_pagos').click()
                        MostrarMensaje("Verde", Arreglo['MENSAJE']);
                    }
                }
            }
        }
    });
} //FIN DE INSERTAR RETENCIONES//

//INSERTAR AVISO DE CREDITO//
function guardar_aviso(Parametros) {
    if (saldo == 0) {
        MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la preliquidacion fue cancelada en su totalidad");
        return false
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/Facturacion/insert/ScriptGuardarAviso.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.Cargando(1);
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
                    $('#cancelar_pagos').click()

                }
            }
        }
    });
} //FIN DE AVISO DE CREDITO//