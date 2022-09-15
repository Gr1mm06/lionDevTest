<?php

namespace App\Http\Controllers;

use Exception as ExceptionAlias;
use Illuminate\Http\Request;
use App\Models\SalaJuntas;

class SalaJuntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salaJuntas.Nuevo.nSalaJuntas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaJuntas  $salaJuntas
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,SalaJuntas  $salaJuntas)
    {
        $nombre = $request->nombre;
        $this->validate($request,[
            'nombre' => 'required|max:50'
        ]);
        try {
            $salaJuntas::crearSalaJuntas($nombre);
            return json_encode(true);
        } catch (ExceptionAlias $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaJuntas  $salaJuntas
     * @return \Illuminate\Http\Response
     */
    public function show(SalaJuntas $salaJuntas)
    {
        $salas = $salaJuntas::mostrarSalaJunta();
        return view('salaJuntas.Catalogos.cSalaJuntas',compact('salas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaJuntas  $salaJuntas
     * @return \Illuminate\Http\Response
     */
    public function edit($id_sala, SalaJuntas $salaJuntas)
    {
        $salaJunta = $salaJuntas::getSalaJuntaByPK($id_sala);
        return view('salaJuntas.Editar.eSalaJuntas',compact('salaJunta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaJuntas  $salaJuntas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaJuntas $salaJuntas)
    {
        $id_sala = $request->id_sala;
        $nombre = $request->nombre;

        $this->validate($request,[
            'nombre' => 'required|max:50'
        ]);

        try {
            $salaJuntas::actualizarSalaJuntas($id_sala,$nombre);
            return json_encode(true);
        } catch (ExceptionAlias $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaJuntas  $salaJuntas
     * @return \Illuminate\Http\Response
     */
    public function delete($id_sala,SalaJuntas $salaJuntas)
    {
        try {
            $salaJuntas::borrarSalaJuntas($id_sala);
            return json_encode(true);
        } catch (ExceptionAlias $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
}
