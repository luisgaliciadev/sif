function ajustar_detalle(id_mov) {
    //detalles[id_mov].afectado = "15"
    window.parent.Cargando(1);
    vModal('Sistema/notascredito/formajuste.php?ID=' + id_mov, 'Ajuste de Notas de Credito');
}

function retornar_num_mask(monto) {

    var monto_aux = monto.split(',')
    var new_monto = monto_aux[0].replace(/\./g, '');

    new_monto = new_monto.replace(/\_/g, '');
    return new_monto + "." + monto_aux[1]


}

function procesar() {
    window.parent.Cargando(1);
    ID = $('#id_documento').val();
    vModal('Sistema/notascredito/seleccionTalonario.php?ID=' + ID, 'Ver Avisos Generados');


}

function guardar_nota_credito() {
    var talonario = $('#talonario').val()
    var motivo = $('#motivo').val()
    ID = $('#id_documento').val();
    aux_total_nota = 0
    detalles.forEach(function(detalle, index) {
        aux_total_nota = parseFloat(aux_total_nota) + parseFloat(detalle.afectado.replace(/\,/g, ''))
        detalle.afectado = detalle.afectado.replace(/\,/g, '')
    });

    if (aux_total_nota == 0) {
        swal("Nota de Credito", "Disculpe, no se puede guardar la nota de credito debido a que no existe items a Ajustar ", "error");
        window.parent.Cargando(0);
        $('#cancelar_talon').click()
        return false
    }

    Parametros = "talonario=" + talonario + "&detalles=" + JSON.stringify(detalles) + "&documento=" + ID + "&motivo=" + motivo + "&afectado=" + aux_total_nota;


    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/NOTASCREDITO/insert/Scriptinsertnota.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.parent.Cargando(1);
        },
        cache: false,
        success: function(result) {
            var Arreglo = jQuery.parseJSON(result);
            var CONEXION = Arreglo['CONEXION'];
            if (CONEXION == "NO") {
                window.parent.Cargando(0);
                var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                window.parent.Cargando(0);
                swal("Error", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.", "error");
            } else {
                var ERROR = Arreglo['ERROR'];

                if (ERROR == "SI") {
                    window.parent.Cargando(0);
                    var MSJ_ERROR = datos_factura['MSJ_ERROR'];
                    window.parent.Cargando(0);
                    swal("Error", "Error, No se puede conectar con el servidor, contacte al personal del departamento de sistemas.", "error");
                } else {

                    if (Arreglo['ID'] == 0) {
                        swal("Nota de Credito", Arreglo['MENSAJE'], "error");
                    } else {
                        swal("Nota de Credito", Arreglo['MENSAJE'], "success");
                        $('#btn-ver-aviso').prop("disabled", false);
                        $('#saldo_favor').val(Arreglo['ID_AVISO']);
                        window.open("sistema/notascredito/notacredito.php?ID_DOCUMENTO=" + Arreglo['ID'])
                        actualizar_detalle()
                        $('#cancelar_talon').click()
                    }

                    window.parent.parent.Cargando(0);
                }
            }


        }
    });

}

function actualizar_detalle() {
    ID_DOCUMENTO = $('#id_documento').val();
    Parametros = "ID_DOCUMENTO=" + ID_DOCUMENTO;
    $.ajax({
        type: "POST",
        dataType: "html",
        url: "Sistema/NOTASCREDITO/insert/Scriptconsultadetalle.php",
        data: Parametros,
        beforeSend: function() {
            window.parent.parent.Cargando(1);
        },
        cache: false,
        success: function(result) {
            var Arreglo = jQuery.parseJSON(result);
            var CONEXION = Arreglo['CONEXION'];
            if (CONEXION == "NO") {
                window.parent.Cargando(0);
                var MSJ_ERROR = Arreglo['MSJ_ERROR'];
                window.parent.Cargando(0);
                MostrarMensaje("Rojo", "Error no se puede conectar al servidor");
            } else {
                var ERROR = Arreglo['ERROR'];

                if (ERROR == "SI") {
                    window.parent.Cargando(0);
                    var MSJ_ERROR = datos_factura['MSJ_ERROR'];
                    window.parent.Cargando(0);
                    MostrarMensaje("Rojo", "Error de sentencia SQL, contacte al personal del departamento de sistemas.");
                } else {
                    window.parent.parent.Cargando(0);
                    detalles = Arreglo['JSON_DETALLE']
                    $('#detalle').html(crear_tabla(detalles))
                }
            }


        }
    });
}