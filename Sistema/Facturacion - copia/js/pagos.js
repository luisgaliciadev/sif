function calcular(pagos) {
    var options = new JsNumberFormatter.formatNumberOptions();
    var saldo = 0
    var total_pagos = 0
    pagos.forEach(function(pago, index) {
        total_pagos = parseFloat(total_pagos) + parseFloat(pago.monto)
    });
    $('#abonado').html(JsNumberFormatter.formatNumber(total_pagos, options, true))

    saldo = parseFloat(totales[0].total) - parseFloat(total_pagos)
    return saldo
}

function saldos() {


    $('#sub_total').html(totales[0].sub_total)
    $('#base_imponible').html(totales[0].monto_gravado)
    $('#exento').html(totales[0].monto_nogravado)
    $('#iva').html(totales[0].monto_iva)
    $('#total').html(totales[0].total2)
    $('#saldoss').html(saldo)
    $('#afavor').html(afavor)

    if (saldo == 0) {
        $('#visualizar').prop("disabled", false)
        $('#factura').prop("disabled", false)
    } else {
        $('#visualizar').prop("disabled", true)
        $('#factura').prop("disabled", true)
    }
}


function crear_tabla(datos) {
    var tabla = '';

    var tabla = `<table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Tipo Mov.</th>
                            <th>Banco</th>
                            <th>Cuenta</th>
                            <th>Moneda</th>
                            <th>F. Emision</th>
                            <th>Monto</th>
                            <th>Monto Usado</th>
                            <th>Saldo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>`
    datos.forEach(function(campo, index) {
        tabla = tabla + '<tr><td>' + campo.nro + '</td>'
        tabla = tabla + '<td>' + campo.nb_tp_movimiento + '</td>'
        tabla = tabla + '<td>' + campo.nb_banco + '</td>'
        tabla = tabla + '<td>' + campo.cuenta + '</td>'
        tabla = tabla + '<td>' + campo.nb_moneda + '</td>'
        tabla = tabla + '<td>' + campo.f_emision + '</td>'
        tabla = tabla + '<td>' + campo.monto2 + '</td>'
        tabla = tabla + '<td>' + campo.monto_usado + '</td>'
        tabla = tabla + '<td>' + campo.saldo2 + '</td>'
        tabla = tabla + "<td><button type='button' class='btn btn-danger btn-xs'  onClick='eliminarpago(" + index + ");'  data-placement='top' data-toggle='tooltip' data-original-title='Eliminar'> <i class='fa fa-trash'></i></button></td></tr>"
    });

    tabla = tabla + `</tbody></table>`
    return tabla
}