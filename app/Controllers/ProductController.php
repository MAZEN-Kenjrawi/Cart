<?php

namespace Cart\Controllers;

use Cart\Models\Product;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Router;
use Slim\Views\Twig;

class ProductController extends FrontendController
{
    public function get(Request $request, Response $response, Twig $view, Product $product, Router $router, $url)
    {
        $product = $product->where('url', $url)->first();
        if (!$product) {
            return $view->render($response, 'page_404.twig');
        }

        return
            $view->render($response, 'products/product.twig',
                    ['product' => $product]
                );
    }
}
