<?php

namespace Cart\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const LOW_STOCK_IDENTIFIER = 5;

    const DEFAULT_CURRENCY = '$';

    const CURRENCY_TO_LEFT = true;

    public function outOfStock()
    {
        return $this->stock === 0;
    }

    public function hasLowStock()
    {
        return (bool) ($this->stock <= self::LOW_STOCK_IDENTIFIER);
    }

    public function hasStock($qty)
    {
        return (bool) ($this->stock >= $qty);
    }

    public function getPrice()
    {
        $realPrice = $this->price;
        if (($this->sale_price != 0) && ($this->price > $this->sale_price)) {
            $realPrice = $this->sale_price;
        }

        return number_format($realPrice, 2);
    }

    public function getPriceWithCurrency()
    {
        if (self::CURRENCY_TO_LEFT) {
            return self::DEFAULT_CURRENCY.' '.$this->getPrice();
        } else {
            return $this->getPrice().' '.self::DEFAULT_CURRENCY;
        }
    }
}
