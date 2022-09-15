<div class="row">
    <div class="col-md-6">
        <h2>Reservar sala : </h2>
    </div>
    <div class="col-md-6" style="text-align: -webkit-right;">
        <button onclick="guardar()" type="button" class="btn btn-success">
            Guardar
        </button>
        <button onclick="detalle('salaJuntas','catalogo')" type="button" class="btn btn-danger">
            Cancelar
        </button>
    </div>
</div>
<div class="table-responsive">
    <h4>Informacion de Reservacion</h4>
    <form class="form-horizontal" id="frmReservaciones" name="frmReservaciones" autocomplete="off">
        {!! csrf_field() !!}
        <input type="hidden" name="id_sala" id="id_sala" value="{{$salaJunta['id_sala']}}">
        <div class="form-group">
            <label for="icono" class="col-md-2 control-label">Nombre</label>
            <div class="col-md-10">
                <input
                    type="text"
                    class="form-control"
                    value="{{$salaJunta['nombre']}}"
                    name="nombre"
                    id="nombre"
                    readonly
                >
            </div>
        </div>
        <div class="form-group">
            <label for="icono" class="col-md-2 control-label">Descripcion Reservacion</label>
            <div class="col-md-10">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Ej. Sala de Juntas Principal"
                    name="descripcion"
                    id="descripcion"
                >
            </div>
        </div>
        <div class="form-group">
            <label for="icono" class="col-md-2 control-label">Hora Inicial</label>
            <div class="col-md-4">
                <select onchange="horaFin()" class="form-control col-md-4" id="hora_inicio" name="hora_inicio">
                    <option value="0" selected disabled>Selecciona Hora</option>
                    @foreach($arrayLista as $lista => $l)
                        <option value="{{$l['id_hora']}}">{{$l['hora']}}</option>
                    @endforeach
                </select>
            </div>
            <label for="icono" class="col-md-2 control-label">Hora Final</label>
            <div class="col-md-4" id="divHoraFinal">

            </div>
        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="divTablaReservaciones">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Num. Reservacion</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora Inicio</th>
                <th scope="col">Hora Fin</th>
                <th scope="col">Cancelar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($historialReservacion as $reservacion)
                <tr>
                    <td>{{$reservacion->id_reservacion}}</td>
                    <td>{{$reservacion->descripcion}}</td>
                    <td>{{$reservacion->fecha_reserva}}</td>
                    <td>{{$reservacion->hora_inicio}}</td>
                    <td>{{$reservacion->hora_final}}</td>
                    <td>
                        <a aria-current="page" onclick="eliminar('reservacion','eliminar','{{$reservacion->id_reservacion}}');">
                            <i class="fa-sharp fa-solid fa-circle-xmark pointer delete"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function recargarTabla() {
        id_sala = $('#id_sala').val();
        $('#divTablaReservaciones').load('reservacion/tabla/' + id_sala);
    }

    function horaFin() {
        id_hora = $('#hora_inicio').val();
        id_sala = $('#id_sala').val();
        $('#divHoraFinal').load('horas/' + id_hora + '/' + id_sala);
    }

    function guardar() {
        $.ajax({
            data: new FormData($("#frmReservaciones")[0]),
            type: 'post',
            url: 'reservacion/agregar',
            dataType: 'json',
            cache       : false,
            contentType : false,
            processData : false,
            success: function(response) {
                if(response === true){
                    alert('Registro guardado')
                    recargarTabla();
                }else{
                    alert('Error')
                }
            }
        });
    }

    function eliminar(folder, view, id) {
        var token = '{{csrf_token()}}';
        var dataPost = {
            '_method' : 'DELETE',
            '_token' : token
        };

        $.ajax({
            data: dataPost,
            type: 'DELETE',
            url: '/' + folder + '/' + view + '/' + id,
            dataType: 'json',
            success: function(response) {
                if(response === true){
                    alert('Reservacion liberada');
                    recargarTabla();
                }else{
                    alert('Error');
                }
            }
        });
    }
</script>
