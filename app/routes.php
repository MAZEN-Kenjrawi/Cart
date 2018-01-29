<?php

$app->get('/', ['Cart\Controllers\HomeController', 'index'])->setName('homepage');

$app->get('/products/{url}', ['Cart\Controllers\ProductController', 'get'])->setName('product.get');

$app->get('/cart', ['Cart\Controllers\CartController', 'index'])->setName('cart.index');
$app->get('/cart/add/{url}/{qty}', ['Cart\Controllers\CartController', 'add'])->setName('cart.add');