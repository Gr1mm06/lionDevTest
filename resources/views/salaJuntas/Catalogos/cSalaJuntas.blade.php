
<div class="row">
    <div class="col-md-6">
        <h2>Sala de Juntas</h2>
    </div>
    <div class="col-md-6" style="text-align: -webkit-right;">
        <button onclick="detalle('salaJuntas','nuevo')" type="button" class="btn btn-success">
            Agregar
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">Num. Sala</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Acciones</th>
            <th scope="col">Reservar</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($salas as $sala)
                <td>{{$sala->id_sala}}</td>
                <td>{{$sala->nombre}}</td>
                <td>
                    <a aria-current="page" onclick="editar('salaJuntas','editar','{{$sala->id_sala}}');">
                        <i  class="fa-solid fa-pen-to-square pointer"></i>
                    </a>
                    <a aria-current="page" onclick="eliminar('salaJuntas','borrar','{{$sala->id_sala}}');">
                        <i class="fa-solid fa-trash pointer"></i>
                    </a>
                </td>
                <td>
                    <a aria-current="page" onclick="editar('reservacion','crear','{{$sala->id_sala}}');">
                        <i class="fa-solid fa-file-pen"></i>
                    </a>
                </td>
            @endforeach
        </tr>
        </tbody>
    </table>
</div>
