<?php

namespace App\Controllers;

use Zend\Diactoros\Response\HtmlResponse;

class IndexController {

    public function indexAction() {

        return new HtmlResponse("holda");
    }
    

}
