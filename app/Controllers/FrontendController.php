<?php

namespace Cart\Controllers;

use Slim\Views\Twig;
use Cart\Models\Product;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class FrontendController
{
        
    private static function dump($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

?>