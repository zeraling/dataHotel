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

        $code = $request->getAttribute('id');

        if ($code != null && $code > 0) {
            $respuesta = Ciudades::where('id_departamento', $code)
                    ->with('departamento')
                    ->get();
        } else {
            $respuesta = Ciudades::with('departamento')->get();
        }
        return new JsonResponse($respuesta);
    }

}
