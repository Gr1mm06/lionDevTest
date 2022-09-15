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
