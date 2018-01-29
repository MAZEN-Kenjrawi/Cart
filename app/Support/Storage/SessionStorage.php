<?php

namespace Cart\Support\Storage;

use Cart\Support\Storage\Contracts\StorageInterface;
use Countable;

class SessionStorage implements StorageInterface, Countable
{
    protected $bucket;
    public function __construct($bucket = 'cart')
    {
        if(!isset($_SESSION[$bucket]))
        {
            $_SESSION[$bucket] = [];
        }

        $this->bucket = $bucket;
    }

    public function get($index)
    {
        if(!$this->exists($index))
        {
            return null;
        }
        
        return $_SESSION[$this->bucket][$index];
    }

    public function set($index, $value)
    {
        $_SESSION[$this->bucket][$index] = $value;
    }

    public function all()
    {
        return $_SESSION[$this->bucket];
    }

    public function exists($index)
    {
        return isset($_SESSION[$this->bucket][$index]);
    }

    public function unset($index)
    {
        if($this->exists($index))
        {
            unset($_SESSION[$this->bucket][$index]);
        }
    }

    public function clear()
    {
        unset($_SESSION[$this->bucket]);
    }

    public function count()
    {
        return count($this->all());
    }
}