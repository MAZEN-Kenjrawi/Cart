<?php

namespace Cart\Basket;

use Cart\Models\Product;
use Cart\Support\Storage\Contracts\StorageInterface;

use Basket\Exceptions\QtyExceededException;

Class Basket
{
    protected $storage;

    protected $product;

    public function __construct(StorageInterface $storage, Product $product)
    {
        $this->product = $product;

        $this->storage = $storage;

    }

    public function add(Product $product, $qty)
    {
        if($this->has($product))
        {
            $qty = $this->storage->get($product->id)['qty'] + $qty;
        }

        $this->update($product, $qty);

    }

    public function has(Product $product)
    {
        return (bool) ($this->storage->exists($product->id));
    }

    public function update(Product $product, $qty)
    {
        if($this->product->find($product->id)->hasStock($qty))
        {
            throw new QtyExceededException;

        }

        if($qty === 0)
        {
            $this->remove($product);
            return;
        }

        $this->storage->set($product->id, [
            'product_id'    => (int) $product->id,
            'qty'           => (int) $qty,
            'single_price'  => (float) (($product->sale_price > 0)? $product->sale_price : $product->price),
            'product'       => serialize($product),
        ]);
    }

    public function remove(Product $product)
    {
        $this->storage->unset($product->id);
    }

    public function get(Product $product)
    {
        return $this->storage->get($product->id);
    }

    public function all()
    {
        return $this->storage->all();
    }

    public function clear()
    {
        $this->storage->clear();
    }

    public function itemCount()
    {
        return $this->storage->count();
    }
}

 

