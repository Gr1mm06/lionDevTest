<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaJuntas;
use App\Models\Reservaciones;
use App\Models\Horas;
use Exception as ExceptionAlias;

class ReservacionController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservaciones  $reservaciones
     * @param  \App\Models\SalaJuntas  $salaJuntas
     * @param  \App\Models\Horas  $horas
     * @return \Illuminate\Http\Response
     */
    public function show($id_sala ,Reservaciones  $reservaciones,SalaJuntas  $salaJuntas,Horas  $horas)
    {
        try {
            $fecha = date("Y-m-d");
            $salaJunta = $salaJuntas::getSalaJuntaByPK($id_sala);
            $historialReservacion = $reservaciones::getReservacionByIDSala($id_sala);
            $horasReservadas = $reservaciones::getHorasReservaByIDSala($id_sala,$fecha);
            $listaHora = $horas::getHoras();

            /*En este bloque la finalidad es la de comparar las horas que ya estan apartas y evitar
             que se muestran en la visata al momento de querer efectuar una reserva*/
            if ($horasReservadas->isEmpty()) {
                $arrayHoras = array();
            } else {
                $arrayHoras = $this->_arrayHoras($horasReservadas,$horas);
            }
            $arrayLista = $this->_arrayLista($listaHora,$arrayHoras);

            return view(
                'reservaciones.Nuevo.nReservaciones',
                compact(
                    'salaJunta',
                    'historialReservacion',
                    'fecha',
                    'arrayLista'
                )
            );
        } catch (ExceptionAlias $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservaciones  $reservaciones
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Reservaciones  $reservaciones)
    {
        $id_sala = $request->id_sala;
        $descripcion = $request->descripcion;
        $fecha = date("Y-m-d");
        $hora_inicio = $request->hora_inicio;
        $hora_fin = $request->hora_fin;
        $this->validate(
            $request,
            [
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
            ]
        );

        try {

            $reservaciones::crearReservacion($id_sala,$fecha,$hora_inicio,$hora_fin,$descripcion);
            return json_encode(true);
        } catch (ExceptionAlias $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservaciones  $reservaciones
     * @return \Illuminate\Http\Response
     */
    public function delete($id_reservacion,Reservaciones  $reservaciones)
    {
        try {
            $reservaciones::borrarReservacion($id_reservacion);
            return json_encode(true);
        } catch (ExceptionAlias $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservaciones  $reservaciones
     * @return \Illuminate\Http\Response
     */

    public function recargarTablaReservaciones($id_sala, Reservaciones  $reservaciones)
    {
        try {
            $historialReservacion = $reservaciones::getReservacionByIDSala($id_sala);
            return view('reservaciones.Nuevo.tablaReservaciones',compact('historialReservacion'));
        } catch (ExceptionAlias $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horas  $horas
     * @param  \App\Models\Reservaciones  $reservaciones
     * @return \Illuminate\Http\Response
     */

    public function horasFinal($id_hora, $id_sala, Reservaciones  $reservaciones, Horas  $horas)
    {
        try {
            $fecha = date("Y-m-d");
            $horasReservadas = $reservaciones::getHorasReservaByIDSala($id_sala,$fecha);
            $horasFin = $horas::getHorasFin($id_hora);

            /*En este bloque la finalidad es la de comparar las horas que ya estan apartas y evitar
             que se muestran en la visata al momento de querer efectuar una reserva*/
            if ($horasReservadas->isEmpty()) {
                $arrayHoras = array();
            } else {
                $arrayHoras = $this->_arrayHoras($horasReservadas,$horas);
            }
            $arrayHorasFin = $this->_arrayLista($horasFin, $arrayHoras);
            //Este bloque lo utilice para veririfcar que a hora inicial tenga una hora final logica
            foreach ($arrayHorasFin as $arrayHoraFin => $finHora) {
                $resultado = $arrayHoraFin - $id_hora;
                if ($resultado > 1) {
                    $arrayHorasFin = array();
                    break;
                }
                break;
            }
            return view('reservaciones.Nuevo.listaHoraFin',compact('arrayHorasFin'));
        } catch (ExceptionAlias $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }


    private function _arrayHoras($horasReservadas,$horas)
    {
        foreach ($horasReservadas as $hr) {
            $horasReserva = $horas::getRangoHoras($hr->hora_inicio,$hr->hora_fin);
            foreach ($horasReserva as $horaR) {
                $arrayHoras[$horaR->id_hora] = ['id_hora' => $horaR->id_hora, 'hora' => $horaR->hora];
            }
        }
        return $arrayHoras;
    }

    private function _arrayLista($horas,$arrayHoras)
    {
        $arrayLista = array();
        foreach ($horas as $lista) {
            $arrayLista[$lista->id_hora] = ['id_hora' => $lista->id_hora,'hora' => $lista->hora];
        }

        foreach ($arrayHoras as $arrayHora => $aHora) {
            if (array_key_exists($arrayHora,$arrayLista)) {
                unset($arrayLista[$arrayHora]);
            }
        }

        return $arrayLista;
    }


}
