<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservaciones;

class borrarVencidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:borrarVencidos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Borrar reservaciones vencidas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @param  \App\Models\Reservaciones  $reservaciones
     * @return int
     */
    public function handle(Reservaciones  $reservaciones)
    {
        $fecha = date("Y-m-d");
        $horaActual = date('G:i:00');
        $reservacionesLista = $reservaciones::getAllReservaciones();
        foreach ($reservacionesLista as $reservaacion) {
            if (strtotime($horaActual) >= strtotime($reservaacion->hora_final . ':OO')) {
                $reservaciones::borrarReservacion($reservaacion->id_reservacion);
            }
        }
    }
}
