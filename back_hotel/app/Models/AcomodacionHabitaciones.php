<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Description of AcomodacionHabitaciones
 *
 * @author sapc_
 */
class AcomodacionHabitaciones extends Model  {
    //put your code here
    protected $table = 'acomodacionhabitaciones';
    
     public function habitacion(){
        return $this->hasOne('App\Models\Habitaciones', 'id', 'id_habitacion');
    }
     public function acomodacion(){
        return $this->hasOne('App\Models\Acomodaciones', 'id', 'id_acomodacion');
    }
}
