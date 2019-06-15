<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$map->get('index', '/', ['App\Controllers\IndexController', 'indexAction']);

/// administracion hotel
$map->get('lista.hotel', '/hoteles', ['App\Controllers\HotelesController', 'getHoteles']);
$map->post('add.hotel', '/hotel/add', ['App\Controllers\HotelesController', 'addHotel']);
$map->put('edit.hotel', '/hotel/edit', ['App\Controllers\HotelesController', 'updateHotel']);
$map->get('get.hotel', '/hotel/{id}', ['App\Controllers\HotelesController', 'getHotel']);
$map->delete('delete.hotel', '/hotel/delete', ['App\Controllers\HotelesController', 'indexAction']);

$map->get('lista.dep', '/list-depar', ['App\Controllers\CiudadesController', 'getDepartamentos']);
$map->get('lista.ciu', '/list-ciudad', ['App\Controllers\CiudadesController', 'getCiudadesDep']);

// administrar habitaciones

$map->get('tipo.habit', '/list-habit', ['App\Controllers\IndexController', 'getHabitaciones']);
$map->get('acom.habit', '/acomodacion-habit', ['App\Controllers\IndexController', 'getAcomodaciones']);

$map->get('hab.hotel', '/habitaciones', ['App\Controllers\AdminController', 'indexAction']);
$map->post('add.habitacion', '/habitacion/add', ['App\Controllers\AdminController', 'addHabitacionHotel']);
$map->put('edit.habitacion', '/habitacion/{id}', ['App\Controllers\AdminController', 'updateHabitacionHotel']);
$map->delete('delete.habitacion', '/habitacion/delete', ['App\Controllers\AdminController', 'deleteHabitacionHotel']);