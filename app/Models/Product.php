<?php
namespace Cart\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const LOW_STOCK_IDENTIFIER = 5;

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

}