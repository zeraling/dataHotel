/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('#listado').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });


    $(document).on('click', '.btnInfo', function () {
        var hotel = $(this).attr('data-id');

        $.ajax({
            cache: false,
            type: "GET",
            url: APP.data.urlApi + '/hotel/' + hotel + '/detals',
            dataType: 'json',
            success: function (data) {

                $('#txtNit').html(data.hotel.nit);
                $('#txtNombre').html(data.hotel.nombre);
                $('#txtDir').html(data.hotel.direccion);
                $('#txtCiu').html(data.hotel.departamento + ' ' + data.hotel.ciudad);


                let listaHtml = ''
                if (data.habitaciones.length > 0) {
                    data.habitaciones.forEach(element => {
                        listaHtml += '<tr>'
                        listaHtml += '<td>' + element.habitacion + '</td>'
                        listaHtml += '<td>' + element.acomodacion + '</td>'
                        listaHtml += '<td>' + element.cantidad + '</td>'
                        listaHtml += '</tr>'
                    })
                } else {
                    listaHtml = '<tr><td colspan="4">Este hotel no tiene habitaciones registradas</td></tr>'
                }
                $('#listHabitaciones').html(listaHtml)

            }, error: function (e) {
                console.log(e)
                alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
            }
        });

        $("#dialog-info").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                Cerrar: function () {
                    $(this).dialog("close");
                }
            }
        });
    })
});
