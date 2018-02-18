<?php

namespace Cart\Controllers;

use Cart\Models\Product;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class HomeController extends FrontendController
{
    public function index(Request $request, Response $response, Twig $view, Product $product)
    {
        $products = $product->get(['name', 'photo', 'url', 'content']);

        return $view->render($response, 'home.twig', [
            'products' => $products,
        ]);
    }
}
