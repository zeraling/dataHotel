<?php

namespace App\Controllers;

use App\Models\Departamentos;
use App\Models\Ciudades;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response\JsonResponse;

class CiudadesController {

    public function getDepartamentos() {

        $departamentos = Departamentos::all();

        return new JsonResponse($departamentos);
    }

    public function getCiudadesDep(ServerRequest $request) {

        $params = $request->getQueryParams();

        if ($params['depart'] != NULL) {
            if ($params['depart'] > 0) {
                $respuesta = Ciudades::where('id_departamento', $params['depart'])
                        ->with('departamento')
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
