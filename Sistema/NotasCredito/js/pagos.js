function calcular(pagos) {
    var options = new JsNumberFormatter.formatNumberOptions();
    var saldo = 0
    var total_pagos = 0
    pagos.forEach(function(pago, index) {
        total_pagos = parseFloat(total_pagos) + parseFloat(pago.monto_aplicado2)
    });

    abonado = JsNumberFormatter.formatNumber(total_pagos, options, true)
    abonado = abonado.split(".")

    if (abonado.length == 1) {
        abonado_aux = abonado[0].replace(/\,/g, '.') + ",00";
    } else {
        abonado_aux = abonado[0].replace(/\,/g, '.') + "," + abonado[1];
    }

    $('#abonado').html(abonado_aux)
    aux_saldo = $('#totalf').html().replace(/\./g, '');
    aux_saldo = aux_saldo.replace(',', '.');
    total = aux_saldo

    saldo = (parseFloat(total) - parseFloat(total_pagos)).toFixed(2)
    saldo = JsNumberFormatter.formatNumber(parseFloat(saldo), options, true)
    saldo = saldo.split(".")
    if (saldo.length == 1) {
        saldo_aux = saldo[0].replace(/\,/g, '.') + ",00";
    } else {
        saldo_aux = saldo[0].replace(/\,/g, '.') + "," + saldo[1];
    }

    $('#saldoss').html(saldo_aux)
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
    var input_text = '<input type="text" class="mto_det ">'
    var tabla = `<table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>COD. TARIFA</th>
                            <th>DESCRIPCION</th>
                            <th>BASE CALCULO</th>
                            <th>VALOR CALCULO</th>
                            <th>TASA / TARIFA</th>
                            <th>% DESC.</th>
                            <th>MONTO</th>
                            <th>TOTAL</th>
                            <th>AJUSTE</th>
                            <th>SALDO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>`
    datos.forEach(function(campo, index) {
        tabla = tabla + '<tr><td>' + campo.cod_tarifa + '</td>'
        tabla = tabla + '<td>' + campo.ds_tarifa + '</td>'
        tabla = tabla + '<td>' + campo.base_calculo + '</td>'
        tabla = tabla + '<td>' + campo.valor_calculo + '</td>'
        tabla = tabla + '<td>' + campo.tasa_tarifa + '</td>'
        tabla = tabla + '<td>' + campo.porc_desc + '</td>'
        tabla = tabla + '<td>' + campo.mto_item + '</td>'
        tabla = tabla + '<td>' + campo.total_item + '</td>'
        tabla = tabla + '<td id = "afectados">' + campo.afectado + '</td>'
        tabla = tabla + '<td id = "saldos">' + campo.saldo + '</td>'
        tabla = tabla + "<td><button type='button' class='btn btn-success btn-xs'  onClick='ajustar_detalle(" + index + ");'  data-placement='top' data-toggle='tooltip' data-original-title='Ajustar Detalle'> <i class='fa fa-edit'></i></button></td></tr>"
    });

    tabla = tabla + `</tbody></table>`
    return tabla
}