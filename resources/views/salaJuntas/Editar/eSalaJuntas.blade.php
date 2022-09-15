<div class="row">
    <div class="col-md-6">
        <h2>Editar Sala de Juntas</h2>
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
    <h4>Informacion Sala de Juntas</h4>
    <form class="form-horizontal" id="frmSalaJuntas" name="frmSalaJuntas" autocomplete="off" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input type="hidden" name="id_sala" value="{{$salaJunta['id_sala']}}">
            <label for="icono" class="col-md-2 control-label">Nombre</label>
            <div class="col-md-10">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Ej. Sala de Juntas Principal"
                    value="{{$salaJunta['nombre']}}"
                    name="nombre"
                    id="nombre"
                >
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
</div>
<script>
    function guardar() {
        $.ajax({
            data: new FormData($("#frmSalaJuntas")[0]),
            type: 'POST',
            url: 'salaJuntas/actualizar',
            dataType: 'json',
            cache       : false,
            contentType : false,
            processData : false,
            success: function(response) {
                if(response === true){
                    alert('Sala de juntas guardada')
                    detalle('salaJuntas','catalogo');
                }else{
                    alert('Eror')
                }
            }
        });
    }
</script>
