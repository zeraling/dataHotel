<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Ciudades
 *
 * @author sapc_
 */
class Ciudades extends Model {

    //put your code here
    protected $table = 'ciudades';

    public function departamento() {
        return $this->hasOne('App\Models\Departamentos', 'id', 'id_departamento');
    }

}
