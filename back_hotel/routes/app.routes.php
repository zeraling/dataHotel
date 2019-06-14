<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$map->get('index', '/', ['App\Controllers\IndexController', 'indexAction']);

/// administracion hotel
$map->get('lista.hotel', '/', ['App\Controllers\IndexController', 'indexAction']);
$map->post('add.hotel', '/', ['App\Controllers\IndexController', 'indexAction']);

$map->get('lista.dep', '/', ['App\Controllers\IndexController', 'indexAction']);
$map->get('lista.ciu', '/', ['App\Controllers\IndexController', 'indexAction']);
$map->get('lista.hotel', '/', ['App\Controllers\IndexController', 'indexAction']);

$map->put('edit.hotel', '/', ['App\Controllers\IndexController', 'indexAction']);
$map->get('get.hotel', '/', ['App\Controllers\IndexController', 'indexAction']);
$map->delete('delete.hotel', '/', ['App\Controllers\IndexController', 'indexAction']);

// administrar habitaciones

$map->get('hab.hotel', '/', ['App\Controllers\IndexController', 'indexAction']);
$map->get('tipo.habit', '/', ['App\Controllers\IndexController', 'indexAction']);
$map->get('acom.habit', '/', ['App\Controllers\IndexController', 'indexAction']);

$map->post('add.habitacion', '/', ['App\Controllers\IndexController', 'indexAction']);
$map->delete('delete.habitacion', '/', ['App\Controllers\IndexController', 'indexAction']);