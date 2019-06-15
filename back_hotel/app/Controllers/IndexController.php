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

        $params = $request->getQueryParams();

        if ($params['ide_habt'] != NULL) {
            if ($params['ide_habt'] > 0) {
                $respuesta = AcomodacionHabitaciones::where('id_habitacion', $params['ide_habt'])
                        ->with('habitacion', 'acomodacion')
                        ->get();
            } else {
                $respuesta = array('error' => '2', 'message' => 'data not sent correctly');
            }
        } else {
            $respuesta = array('error' => '1', 'message' => 'parameters not sent');
        }

        return new JsonResponse($respuesta);
    }

}
