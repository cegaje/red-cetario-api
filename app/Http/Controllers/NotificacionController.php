<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use Illuminate\Support\Facades\DB;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {

        $notificaciones = Notificacion::where('id_cliente', $request->idCliente)->get();

        return array(
            "ok" => count($notificaciones) > 0,
            "notificaciones" => $notificaciones
        );

    }

    public function destroy($id)
    {
        DB::table('notificaciones')->where('id', '=', $id)->delete();
        return array(
            "ok" => true,
            "mensaje" => "Notificación eliminada"
        );
    }

    public function destroyForClient($id)
    {
        DB::table('notificaciones')->where('id_cliente', '=', $id)->delete();
        return array(
            "ok" => true,
            "mensaje" => "Notificaciones eliminada"
        );
    }

    public function updateNotificacion($id)
    {
        $notificacion = Notificacion::find($id);
        $notificacion->fecha_visto = date("Y/m/d");
        $notificacion->save();

        return array(
            'ok' => true,
            'usuario' => $notificacion
        );
    }
}
