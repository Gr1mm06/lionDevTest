<select class="form-control col-md-4" id="hora_fin" name="hora_fin">
    @foreach($arrayHorasFin as $listas => $lista)
        <option value="{{$lista['id_hora']}}">{{$lista['hora']}}</option>
    @endforeach
</select>
