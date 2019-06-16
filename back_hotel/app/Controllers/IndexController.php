<?php

namespace App\Controllers;

use App\Models\Habitaciones;
use App\Models\AcomodacionHabitaciones;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class IndexController {

    public function indexAction() {

        return new HtmlResponse("holda");
    }

    public function getHabitaciones() {

        $listado = Habitaciones::all();

        return new JsonResponse($listado);
    }

    public function getAcomodaciones(ServerRequest $request) {

        $code = $request->getAttribute('id');

        if ($code != null && $code > 0) {
            $respuesta = AcomodacionHabitaciones::where('id_habitacion', $code)
                    ->with('habitacion', 'acomodacion')
                    ->get();
        } else {
            $respuesta = array('res' =>false, 'message' => 'data not sent correctly');
        }

        return new JsonResponse($respuesta);
    }

}
