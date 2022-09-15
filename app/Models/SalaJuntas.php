<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaJuntas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sala_juntas';
    protected $fillable = [
        'nombre'
    ];

    public static function mostrarSalaJunta()
    {
        return SalaJuntas::all();
    }

    public static function crearSalaJuntas($nombre)
    {
        SalaJuntas::create(['nombre' => $nombre]);
        return true;
    }

    public static function getSalaJuntaByPK($id_sala)
    {
        return SalaJuntas::where('id_sala',$id_sala)->first();
    }

    public static function actualizarSalaJuntas($id_sala,$nombre)
    {
        SalaJuntas::where('id_sala',$id_sala)
            ->update(['nombre' => $nombre]);
        return true;
    }

    public static function borrarSalaJuntas($id_sala)
    {
        SalaJuntas::where('id_sala',$id_sala)->delete();
        return true;
    }
}
