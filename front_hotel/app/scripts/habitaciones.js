/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function loadAcomodacion(habitacion) {
    $.ajax({
        cache: false,
        type: "GET",
        url: APP.data.urlApi + 'acomodacion-habit/' + habitacion,
        dataType: 'json',
        success: function (data) {
            let html = ''
            if (data.length > 0) {
                html = '<option value=""> - seleccione - </option>'
                data.forEach(element => {
                    html += '<option value="' + element.id + '">' + element.acomodacion.nombre + '</option>'
                })
            } else {
                html = '<option value="">No se han Cargado datos</option>'
            }
            $('#idAcomodacion').html(html)
        }, error: function (e) {
            console.log(e)
            alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
        }
    });
}

function loadHabitaciones() {

    var ide = parseInt($('#id_hotel').val());

    $.ajax({
        cache: false,
        type: "GET",
        url: APP.data.urlApi + 'habitacion-hotel/' + ide,
        dataType: 'json',
        beforeSend: function (xhr) {
            $('#listHabitaciones').html('<tr><td colspan="4">Cargando informacion...!</td></tr>')
        },
        success: function (data) {
            let html = ''

            if (data.length > 0) {
                data.forEach(element => {
                    html += '<tr>'
                    html += '<td>' + element.habitacion + '</td>'
                    html += '<td>' + element.acomodacion + '</td>'
                    html += '<td>' + element.cantidad + '</td>'
                    html += '<td><button class="btn btn-xs btn-danger btnDelete" data-id="' + element.id + '"><i class="fa fa-times"></i></button></td>'
                    html += '</tr>'
                })
            } else {
                html = '<tr><td colspan="4">Este hotel no tiene habitaciones registradas</td></tr>'
            }
            $('#listHabitaciones').html(html)
        }, error: function (e) {
            console.log(e)
            alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
        }
    });
}

function resetForm() {
    $('#ideHabitacion').prop('selectedIndex', 0)
    $('#idAcomodacion').prop('selectedIndex', 0)
    $('#cantidad').val(0)
}

$(document).ready(function () {

    $('#ideHabitacion').change(function () {
        var habitacion = $(this).val();
        loadAcomodacion(habitacion)
    })

    loadHabitaciones()


    $('#btnCargar').click(function () {
        var ide = parseInt($('#id_hotel').val());
        var habitacion = parseInt($('#ideHabitacion').val());
        var acomodacion = parseInt($('#idAcomodacion').val());
        var cantidad = parseInt($('#cantidad').val());

        if (habitacion > 0 && acomodacion > 0 && cantidad > 0) {

            var formData = {hotel: ide, acomodacion: acomodacion, cantidad: cantidad}

            console.log(formData)
            $.ajax({
                cache: false,
                type: "POST",
                url: APP.data.urlApi + 'habitacion-hotel/add',
                dataType: 'json',
                data: JSON.stringify(formData),
                beforeSend: function (xhr) {
                    $('#btnCargar').attr('disabled', 'true')
                },
                success: function (data) {
                    var mensaje = ''
                    var typeMensaje = ''
                    if (data.res === false) {
                        console.log(data.message)
                        if (data.error === 'validation') {
                            typeMensaje = 'danger';
                            (data.message).forEach(elemelt => {
                                mensaje += elemelt + '<br>'
                            })
                        } else {
                            typeMensaje = 'warning'
                            mensaje = data.message
                        }
                    } else {
                        typeMensaje = 'success'
                        mensaje = data.message
                        resetForm()
                        loadHabitaciones()
                    }

                    $('#msj').html('<div class="alert alert-' + typeMensaje + '"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> ' + mensaje + '</div>')
                }, error: function (e) {
                    console.log(e)
                    alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
                }
            });

        } else {
            $('#msj').html('<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Los datos para registro estan imcompletos!</div>')
        }

        $('#btnCargar').removeAttr('disabled')
    })

    $(document).on('click', '.btnDelete', function () {
        var acomodacion = $(this).attr('data-id');

        $("#dialog-confirm").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Confirmar": function () {
                    $(this).dialog("close");

                    $.ajax({
                        cache: false,
                        type: "GET",
                        url: APP.data.urlApi + 'habitacion-hotel/' + acomodacion + '/delete',
                        dataType: 'json',
                        success: function (data) {
                            var mensaje = ''
                            var typeMensaje = ''
                            if (data.res === false) {
                                console.log(data.message)
                                if (data.error === 'nofound') {
                                    typeMensaje = 'danger';
                                } else {
                                    typeMensaje = 'warning'
                                }
                                mensaje = data.message
                            } else {
                                typeMensaje = 'success'
                                mensaje = data.message
                                resetForm()
                                loadHabitaciones()
                            }
                            $('#msj').html('<div class="alert alert-' + typeMensaje + '"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> ' + mensaje + '</div>')
                
                        }, error: function (e) {
                            console.log(e)
                            alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
                        }
                    });
                },
                Cancelar: function () {
                    $(this).dialog("close");
                }
            }
        });
    })

})