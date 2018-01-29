<?php

namespace Cart\Controllers;

use Slim\Views\Twig;
use Slim\Router;
use Cart\Models\Product;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ProductController extends FrontendController
{
    public function get(Request $request, Response $response, Twig $view, Product $product, Router $router, $url)
    {
        $product = $product->where('url', $url)->first();
        if(!$product){
            return $view->render($response, 'page_404.twig');
        }
        return 
            $view->render($response, 'products/product.twig', 
                    ['product' => $product]
                );
    }
    
}

?>