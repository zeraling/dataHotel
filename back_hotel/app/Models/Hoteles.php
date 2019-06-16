<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Description of Hoteles
 *
 * @author sapc_
 */
class Hoteles extends Model {

    //put your code here
    protected $table = 'hoteles';

    public function habitaciones() {
        return $this->hasMany('App\Models\HabitacionesHoteles', 'id_hotel', 'id');
    }

    public function totalHabitaciones() {
        return $this->hasOne('App\Models\HabitacionesHoteles', 'id_hotel', 'id')
                        ->selectRaw('id_hotel,IFNULL(sum(cantidad),0) as total')
                        ->groupBy('id_hotel');
    } 

}
