<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

class RenderPages {

    protected $templateEngine;

    public function __construct() {

        $loader = new \Twig_Loader_Filesystem('app/views'); //folder de vistas
        $this->templateEngine = new \Twig_Environment($loader, [
            'charset' => 'utf-8', 'cache' => false,
            'debug' => true,
        ]);

        $this->templateEngine->addExtension(new \Twig_Extension_Debug());
    }

    public function render($fileName, $data = []) {
        try {
            return $this->templateEngine->render($fileName, $data);
        } catch (\Twig_Error $exc) {
            echo '<pre>' . $exc . '</pre>';
        }
    }

}
