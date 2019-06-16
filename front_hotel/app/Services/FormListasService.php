<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Services;
/**
 * Description of FormListasService
 *
 * @author sapc_
 */
class FormListasService {
    //put your code here
    
    const urlBack = "http://datahotel.000webhostapp.com";
    
    public static function getListaDepartamentos() {
        
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, self::urlBack.'/list-depar'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        $resp = curl_exec($ch); 
        curl_close($ch); 
        
        if(!$resp) { 
            return false; 
        }
        
        return json_decode($resp);
        
    }
    
    public static function getListaHabitaciones() {
        
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, self::urlBack.'/list-habit'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        $resp = curl_exec($ch); 
        curl_close($ch); 
        
        if(!$resp) { 
            return false; 
        }
        
        return json_decode($resp);
        
    }
    
}
