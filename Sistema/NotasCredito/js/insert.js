//INSERTAR CHEQUES DE GENERENCIAS//
function insert_cheq(Parametros) {
    if ($('#documento').val() == '') {
        if (saldo == 0) {
            MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la preliquidacion fue cancelada en su totalidad");
            return false
        }
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/pagosdocumento/insert/ScriptinsertCheq.php",
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
                        ID_DOCUMENTO = $('#id_documento').val()
                        consultar_pagos_f(ID_DOCUMENTO)
                        $('#cancelar_pagos').click()
                        MostrarMensaje("Verde", Arreglo['MENSAJE']);
                    }
                }
            }
        }
    });
} //FIN DE INSERTAR CHEQUES DE GERENCIAS//

//INSERTAR PUNTO DE VENTA//
function insert_pdv(Parametros) {
    if ($('#documento').val() == '') {
        if (saldo == 0) {
            MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la preliquidacion fue cancelada en su totalidad");
            return false
        }
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/pagosdocumento/insert/ScriptinsertPdv.php",
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
                        ID_DOCUMENTO = $('#id_documento').val()
                        consultar_pagos_f(ID_DOCUMENTO)
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
    if ($('#documento').val() == '') {
        if (saldo == 0) {
            MostrarMensaje("Rojo", "Disculpe, no se pueden agregar nuevos pagos, debido a que la preliquidacion fue cancelada en su totalidad");
            return false
        }
    }
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/pagosdocumento/insert/ScriptinsertTransDep.php",
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
                        ID_DOCUMENTO = $('#id_documento').val()
                        consultar_pagos_f(ID_DOCUMENTO)
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

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/pagosdocumento/insert/ScriptinsertReten.php",
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
                    ID_DOCUMENTO = $('#id_documento').val()
                    consultar_pagos_f(ID_DOCUMENTO)

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
        url: "Sistema/pagosdocumento/insert/ScriptinsertTransferenciasinter.php",
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
                        ID_DOCUMENTO = $('#id_documento').val()
                        consultar_pagos_f(ID_DOCUMENTO)
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
        url: "Sistema/pagosdocumento/insert/ScriptGuardarAviso.php",
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
                    ID_DOCUMENTO = $('#id_documento').val()
                    consultar_pagos_f(ID_DOCUMENTO)
                    $('#cancelar_pagos').click()

                }
            }
        }
    });
} //FIN DE AVISO DE CREDITO//

// ELIMINAR PAGOS//
function eliminarpago_fact(id_mov) {



    ID_DOCUMENTO = $('#id_documento').val()
    Parametros = "id_movimiento=" + pagos[id_mov].id_documento_pago + "&documento=" + ID_DOCUMENTO
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/pagosdocumento/insert/ScriptEliminarPagos.php",
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
                    ID_DOCUMENTO = $('#id_documento').val()
                    console.log(ID_DOCUMENTO)
                    consultar_pagos_f(ID_DOCUMENTO)
                }
            }
        }
    });
} // FIN DE ELIMINAR PAGOS//


//PROCESAR PAGOS 
function procesar_pagos() {


    ID_DOCUMENTO = $('#id_documento').val()
    Parametros = "documento=" + ID_DOCUMENTO

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/pagosdocumento/insert/scriptprocesardatos.php",
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
                    if (Arreglo['ID'] == 0)
                        MostrarMensaje("rojo", Arreglo['MENSAJE']);
                    else {
                        limpiar_div()
                        ID_DOCUMENTO = $('#id_documento').val()
                        consultar_pagos_f(ID_DOCUMENTO)
                        MostrarMensaje("Verde", Arreglo['MENSAJE']);
                        if (Arreglo['AVISO'] == 1) {
                            $('#btn-buscar-aviso').prop("disabled", false);
                            MostrarMensaje("Verde", "Se han generados Avisos de creditos...");
                        }
                    }
                }
            }
        }
    });
} // FIN DE PROCESAR PAGOS//