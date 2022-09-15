<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservaciones extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservaciones';
    protected $fillable = [
        'id_sala',
        'descripcion',
        'fecha_reserva',
        'hora_inicio',
        'hora_fin'
    ];

    public static function getAllReservaciones()
    {
       return Reservaciones::leftJoin(
           'horas as hi',
           function ($hi)
           {
               $hi->on('reservaciones.hora_inicio','=','hi.id_hora');
           }
       )->leftJoin(
           'horas as hf',
           function ($hf)
           {
               $hf->on('reservaciones.hora_fin','=','hf.id_hora');
           }
       )->select(
           'reservaciones.id_reservacion',
           'hf.hora as hora_final'
       )
       ->get();
    }

    public static function getReservacionByIDSala($id_sala)
    {
        return Reservaciones::leftJoin(
            'horas as hi',
            function ($hi)
                {
                    $hi->on('reservaciones.hora_inicio','=','hi.id_hora');
                }
            )->leftJoin(
                'horas as hf',
                function ($hf)
                {
                    $hf->on('reservaciones.hora_fin','=','hf.id_hora');
                }
            )->select(
                'reservaciones.id_reservacion',
                'reservaciones.descripcion',
                'reservaciones.fecha_reserva',
                'hi.hora as hora_inicio',
                'hf.hora as hora_final'
            )->where(
                'reservaciones.id_sala', $id_sala
            )->get();
    }

    public static function crearReservacion($id_sala,$fecha,$hora_inicio,$hora_fin,$descripcion)
    {
        Reservaciones::create(
            [
                'id_sala' => $id_sala,
                'descripcion' => $descripcion,
                'fecha_reserva' => $fecha,
                'hora_inicio' => $hora_inicio,
                'hora_fin' => $hora_fin
            ]
        );

        return true;
    }

    public static function borrarReservacion($id_reservacion)
    {
        Reservaciones::where('id_reservacion',$id_reservacion)->delete();
        return true;
    }

    public static function getHorasReservaByIDSala($id_sala,$fecha)
    {
        return Reservaciones::where('id_sala',$id_sala)
            ->where('fecha_reserva',$fecha)
            ->select('hora_inicio','hora_fin')
            ->get();
    }
}
