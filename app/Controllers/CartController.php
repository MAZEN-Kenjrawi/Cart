<?php

namespace Cart\Controllers;

use Slim\Router;
use Slim\Views\Twig;
use Cart\Models\Product;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Cart\Basket\Basket;

use Cart\Basket\Exceptions\QtyExceededException;

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
        // $this->basket->clear();die;
        return $view->render($response, 'cart/index.twig');
    }

    public function add($url, $qty, Request $request, Response $response, Router $router)
    {
        $product = $this->product->where('url', $url)->first();

         // @TODO: make it ajax response
        if(!$product)
        {
            // return Error
            return $response->withRedirect($router->pathFor('homepage'));
        }

        try {
            $this->basket->add($product, (int) $qty);
        } catch (QtyExceededException $error) {
            /* @Todo: add a flash message {{ $error->message }} :p */
        }

        return $response->withRedirect($router->pathFor('cart.index'));
    }

    public function update(Request $request, Response $response, Router $router)
    {
        if($request->isXhr())
        {
            $ajaxData = $request->getParsedBody();
            $product = $this->product->find($ajaxData['item_id'])->first();
            if(!$product)
            {
                return $response->withJson(['status' => 'error']);
            }
            try{
                $this->basket->update($product, (int) $ajaxData['qty']);
                return $response->withJson(['status' => 'success']);
            } catch(QtyExceededException $error)
            {
                return $response->withJson(['status' => 'error']);
            }
            
        }
        return $response->withJson(['status' => 'error']);
    }
}