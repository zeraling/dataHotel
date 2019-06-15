<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;


use App\Models\Hoteles;

use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response\JsonResponse;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;
/**
 * Description of HotelesController
 *
 * @author sapc_
 */
class HotelesController {
    //put your code here
    
    public function getHoteles() {

        return new JsonResponse([]);
    }
    
    public function addHotel(ServerRequest $req) {

        $requestData = $req->getBody()->getContents();
        
        $data=json_decode($requestData);
        
        if($data){
            
            $hotelValidacion = v::attribute('nit', v::stringType()->notEmpty())
                    ->attribute('nombre', v::stringType()->notEmpty())
                    ->attribute('direccion', v::stringType()->notEmpty())
                    ->attribute('id_ciudad', v::intType()->notEmpty())
                    ->attribute('habitaciones', v::intType()->notEmpty());
            
             try {
                $hotelValidacion->assert($data);
               
            } catch(NestedValidationException $exception) {
                $res = array('error' => '2', 'message' => $exception->getMessages());
             }
           
        }else{
            $res = array('error' => '1', 'message' => 'parameters not sent');
        }
        
        return new JsonResponse($res);
    }
    
    
    
    public function updateHotel() {

        return new JsonResponse([]);
    }
    
    public function getHotel() {

        return new JsonResponse([]);
    }
    
    public function deleteHotel() {

        return new JsonResponse([]);
    }
    
}
