<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'horas';
    protected $fillable = [
        'hora'
    ];

    public static function registrarHoras($hora)
    {
        Horas::create(['hora' => $hora]);
        return true;
    }

    public static function getHoras()
    {
        return Horas::all();
    }

    public static function getHorasFin($id_hora)
    {
        return Horas::where('id_hora' , '>' , $id_hora)->skip(0)->take(4)->get();
    }

    public static function getRangoHoras($hora_inicio,$hora_fin)
    {
        return Horas::whereBetween('id_hora',[$hora_inicio,$hora_fin])->get();
    }


}
