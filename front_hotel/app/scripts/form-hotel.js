/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function loadCiudades(dep) {
    $.ajax({
        cache: false,
        type: "GET",
        url: APP.data.urlApi + 'list-ciudad/' + dep,
        dataType: 'json',
        success: function (data) {
            let html = ''
            let cidudadSelect = parseInt($('#idCiudad').attr('data-select'));
            if (data.length > 0) {
                html = '<option value=""> - seleccione - </option>'
                data.forEach(element => {
                    let selected = cidudadSelect == element.id ? 'selected="selected"' : '';
                    html += '<option value="' + element.id + '" ' + selected + '>' + element.nombre + '</option>'
                })
            } else {
                html = '<option value="">No se han Cargado datos</option>'
            }
            $('#idCiudad').html(html)
        }, error: function (e) {
            console.log(e)
            alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
        }
    });
}

$(document).ready(function () {

    let deparSelect = parseInt($('#ideDepartamento').val());
    loadCiudades(deparSelect)

    $('#ideDepartamento').change(function () {
        var depar = $(this).val();
        loadCiudades(depar)
    })


    $('#formHotel').validate({
        errorElement: "em",
        rules: {
            nit: {required: true, minlength: 5, maxlength: 15},
            nombre: {required: true, minlength: 3},
            direccion: {required: true, minlength: 3},
            ideDepartamento: {required: true},
            idCiudad: {required: true},
            habitaciones: {required: true, minlength: 1}
        }, errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else {
                error.insertAfter(element);
            }
            $('#msj').html('')
        }, highlight: function (element, errorClass, validClass) {
            $(element).parents(".wrap-input100").addClass("has-error").removeClass("has-success");
        }, unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".wrap-input100").addClass("has-success").removeClass("has-error");
        }, submitHandler: function (form) {
            $('#msj').html('')
            var ide = parseInt($('#id_hotel').val());

            var formData = {
                nit: $('#nit').val(),
                nombre: $('#nombre').val(),
                direccion: $('#direccion').val(),
                id_ciudad: parseInt($('#idCiudad').val()),
                habitaciones:  parseInt($('#habitaciones').val())
            }

            if(ide > 0 ){
                var accion ='hotel/' + ide + '/edit'
                formData.id_hotel = ide;
            }else{
                var accion = 'hotel/add'
            }
            
            console.log(formData)
            $.ajax({
                cache: false,
                type: "POST",
                url: APP.data.urlApi + accion,
                dataType: 'json',
                data: JSON.stringify(formData),
                success: function (data) {
                    var mensaje=''
                    var typeMensaje=''
                    if (data.res === false) {
                        console.log(data.message)
                        if (data.error === 'validation') {
                            typeMensaje='danger';                     
                            (data.message).forEach(elemelt => {
                                mensaje+=elemelt+'<br>'
                            })
                        } else {
                            typeMensaje='warning'
                            mensaje=data.message
                        }
                    } else {
                         typeMensaje='success'
                         mensaje=data.message
                    }
                    
                    $('#msj').html('<div class="alert alert-'+typeMensaje+'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+mensaje+'</div>')
                }, error: function (e) {
                    console.log(e)
                    alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
                }
            });


        }
    });

})