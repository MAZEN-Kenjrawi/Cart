<?php

namespace Cart\Basket;

use Cart\Models\Product;
use Cart\Support\Storage\Contracts\StorageInterface;

use Cart\Basket\Exceptions\QtyExceededException;

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
        if(!$this->product->find($product->id)->hasStock($qty))
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
            'item_price'    => (float) (($product->sale_price > 0)? $product->sale_price : $product->price),
            'product_name'  => $product->name,
            'product_url'   => $product->url,
            'product'       => json_encode($product),
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
        $allItems = $this->storage->all();
        $products = $this->product->find(array_keys($allItems))->keyBy('id');

        return array_map(function($item) use($products) {
            if($products[$item['product_id']]->hasStock($item['qty'])){
                $item['qty'] = $products[$item['product_id']]['stock'];
                $this->update($products[$item['product_id']], $item['qty']);
                return $item;
            }
        }, $allItems);
    }

    public function clear()
    {
        $this->storage->clear();
    }

    public function itemCount()
    {
        return $this->storage->count();
    }

    public function subTotal()
    {
        $total = 0;
        if($this->itemCount())
        {
            $allItems = $this->all();
            $total = array_sum(
                array_map(function($item) {
                    return (float) ($item['qty'] * $item['item_price']);                        
                }, $allItems)
            );
        }
        return $total;
    }

    public function shippingFees()
    {
        return 10.00;
    }

    public function total()
    {
        return $this->shippingFees() + $this->subTotal();
    }
}

 

