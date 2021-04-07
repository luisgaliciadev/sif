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
                    setTimeout(function() { AbrirModulo("MenDes13", "Facturarción", "Sistema/Facturacion/filtro.php") }, 3000);


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
                    MostrarMensaje("Verde", Arreglo['MENSAJE']);
                    limpiar_div()
                    consultar_pagos(totales[0].id_preliquidacion)

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

                    window.parent.Cargando(0);
                    MostrarMensaje("Verde", Arreglo['MENSAJE']);
                    limpiar_div()
                    consultar_pagos(totales[0].id_preliquidacion)

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

                    window.parent.Cargando(0);
                    MostrarMensaje("Verde", Arreglo['MENSAJE']);
                    limpiar_div()
                    consultar_pagos(totales[0].id_preliquidacion)

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