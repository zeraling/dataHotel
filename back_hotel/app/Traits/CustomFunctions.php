<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Traits;
/**
 *
 * @author sapc_
 */
trait CustomFunctions {
    //put your code here
    
    public function totalHabitaciones($param) {
        if(isset($param->total)){
            return $param->total;
        }else {
            return 0;
        } 
    }
    
    
}
