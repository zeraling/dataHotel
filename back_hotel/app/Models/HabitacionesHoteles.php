<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Description of HabitacionesHoteles
 *
 * @author sapc_
 */
class HabitacionesHoteles extends Model  {
    //put your code here
    protected $table = 'habitacioneshoteles';
    
    public $timestamps = false;
    
    public function acomodacion(){
        return $this->hasOne('App\Models\AcomodacionHabitaciones', 'id', 'id_acomodacion_h');
    }
     public function hotel(){
        return $this->hasOne('App\Models\Hoteles', 'id', 'id_hotel');
    }
    
}
