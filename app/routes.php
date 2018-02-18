<?php

$app->get('/', ['Cart\Controllers\HomeController', 'index'])->setName('homepage');

$app->get('/products/{url}', ['Cart\Controllers\ProductController', 'get'])->setName('product.get');

$app->get('/cart', ['Cart\Controllers\CartController', 'index'])->setName('cart.index');
$app->get('/cart/add/{url}/{qty}', ['Cart\Controllers\CartController', 'add'])->setName('cart.add');
<<<<<<< HEAD

$app->post('/cart/update', ['Cart\Controllers\CartController', 'update'])->setName('cart.update');
=======
>>>>>>> d3af033c353ca7b36320ceeec45aeaad424f61d7
