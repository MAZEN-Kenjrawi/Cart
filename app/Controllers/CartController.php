<?php

namespace Cart\Controllers;

use Cart\Basket\Basket;
use Cart\Basket\Exceptions\QtyExceededException;
use Cart\Models\Product;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Router;
use Slim\Views\Twig;

class CartController extends FrontendController
{
    protected $basket;
    protected $product;

    public function __construct(Basket $basket, Product $product)
    {
        $this->basket = $basket;
        $this->product = $product;
    }

    public function index(Request $request, Response $response, Twig $view, Product $product)
    {
        return $view->render($response, 'cart/index.twig');
    }

    public function add($url, $qty, Request $request, Response $response, Router $router)
    {
        $product = $this->product->where('url', $url)->first();

        // @TODO: make it ajax response
        if (!$product) {
            // return Error
            return $response->withRedirect($router->pathFor('homepage'));
        }

        try {
            $this->basket->add($product, $qty);
        } catch (QtyExceededException $error) {
            /* @Todo: add a flash message {{ $error->message }} :p */
        }

        return $response->withRedirect($router->pathFor('cart.index'));
    }
}
