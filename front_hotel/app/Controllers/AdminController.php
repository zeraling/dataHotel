<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\RenderPages;
use App\Services\FormListasService;
use App\Services\HotelesService;

/**
 * Description of HotelesController
 *
 * @author sapc_
 */
class AdminController extends RenderPages {

    //put your code here
    public function getIndex() {

        $data['listaHoteles'] = HotelesService::getHoteles();

        return $this->render('admin.twig', $data);
    }

    public function getForm($id = null) {

        $data['listaDepartamentos'] = FormListasService::getListaDepartamentos();
        
         if ($id != null && $id > 0) {
            $data['hotel'] = HotelesService::getHotel($id);
         }

        return $this->render('admin/form-hotel.twig', $data);
    }

    public function getHabitaciones($id) {

        $data['listaHabitaciones'] = FormListasService::getListaHabitaciones();
        $data['hotel'] = HotelesService::getHotel($id);        
        
        return $this->render('admin/admin-habitacion.twig', $data);
    }

}
