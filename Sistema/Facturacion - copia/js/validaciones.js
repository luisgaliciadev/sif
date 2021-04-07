function validar_campos_pagos() {

    if ($('#div_banco').is(":visible")) {
        if ($('#banco').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, seleccionar un banco valido");
            return 1
        }
    }

    if ($('#div_cta').is(":visible")) {
        if ($('#cuenta').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, seleccionar una cuenta valida");
            return 1
        }
    }

    if ($('#div_referencia').is(":visible")) {
        if ($('#referencia').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, ingresar una referencia valida");
            return 1
        }
    }

    if ($('#div_monto').is(":visible")) {
        if ($('#monto').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, ingresar un monto valido");
            return 1
        }
    }

    if ($('#div_fecha').is(":visible")) {
        if ($('#fecha').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, debe ingresar una fecha valida");
            return 1
        }
    }

    if ($('#div_transaccion').is(":visible")) {
        if ($('#transaccion').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, ingresar un monto a usar valido");
            return 1
        }
    }

    if ($('#div_cheque').is(":visible")) {
        if ($('#cheque').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, debe ingresar el numero del cheque ");
            return 1
        }
    }

    if ($('#div_cta_cheq').is(":visible")) {
        if ($('#cta_banc_cheq').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, debe ingresar el numero de cuenta bancaria del cheque");
            return 1
        }
    }

    if ($('#div_responsable').is(":visible")) {
        if ($('#responsable').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, ingresar un responsable  de la cuenta valido");
            return false
        }
    }

    if ($('#div_banco_cheq').is(":visible")) {
        if ($('#banco_cheq').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, seleccionar un banco valido");
            return 1
        }
    }

    if ($('#div_monto_usado').is(":visible")) {
        if ($('#monto_usado').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, ingresar un monto a usar valido");
            return 1
        }
    }

    if ($('#rif').is(":visible")) {
        if ($('#rif').val() == '') {
            MostrarMensaje("Rojo", "Disculpe, debe ingresar un rif valido");
            return 1
        }
    }


}

function limpiar_div() {
    $('#div_banco').hide()
    $('#div_cta').hide()
    $('#div_referencia').hide()
    $('#div_monto').hide()
    $('#div_fecha').hide()
    $('#div_transaccion').hide()
    $('#div_cheque').hide()
    $('#div_cta_cheq').hide()
    $('#div_responsable').hide()
    $('#div_banco_cheq').hide()
    $('#div_monto_usado').hide()
    $('#div_rif').hide()

    $('#cheque').val('')
    $('#cta_banc_cheq').val('')
    $('#fecha').val('')
    $('#monto').val('')
    $('#monto_usado').val('')
    $('#banco').val('')
    $('#responsable').val('')
    $('#cuenta').val('')
    $('#referencia').val('')
    $('transaccion').val('')
    $('#rif').val('')

}

function NumCheck(e, field) {
    key = e.keyCode ? e.keyCode : e.which
        // backspace
    if (key == 8) return true
        // 0-9
    if (key > 47 && key < 58) {
        if (field.value == "") return true
        regexp = /.[0-9]{20}$/
        return !(regexp.test(field.value))
    }
    // .
    if (key == 46) {
        if (field.value == "") return false
        regexp = /^[0-9]+$/
        return regexp.test(field.value)
    }
    // other key
    return false

}

function justNumbers(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8))
        return true;

    return /\d/.test(String.fromCharCode(keynum));
}

function retornar_num_mask(monto) {

    var monto_aux = monto.split(',')
    var new_monto = monto_aux[0].replace(/\./g, '');
    new_monto = new_monto.replace(/\_/g, '');
    return new_monto + "." + monto_aux[1]


}