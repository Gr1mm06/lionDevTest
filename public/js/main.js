function detalle(folder, view) {
    $('html,body').animate({
        scrollTop: 0
    }, 0);
    $('#detalle').load( '/' + folder + '/' + view );
    mascara();
    $("body").removeClass("sidebar-open");
}

function mascara() {
    $("#mascara").css("display", "block");
    setTimeout(function() {
        $("#mascara").css("display", "none");
    }, 2000);
}

function editar(folder, view, id) {
    $('html,body').animate({
        scrollTop: 0
    }, 0);
    $('#detalle').load( '/' + folder + '/' + view + '/' + id);
    mascara();
    $("body").removeClass("sidebar-open");
}

function eliminar(folder, view, id) {
    //modalConfimarcion();

    $.ajax({
        type: 'get',
        url: '/' + folder + '/' + view + '/' + id,
        dataType: 'json',
        cache       : false,
        contentType : false,
        processData : false,
        success: function(response) {
            if(response === true){
                alert('Reservacion liberada');
                detalle('salaJuntas','catalogo');
            }else{
                alert('Error');
            }
        }
    });
}
