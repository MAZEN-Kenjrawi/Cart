<?php 
namespace Cart\Support\Extensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppTwigExtensions extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('unquoted', array($this, 'unquoted')),
            new TwigFilter('unserialize', array($this, 'unserialize')),
        );
    }

    public function unquoted($string)
    {
        return str_replace('"', '', $string);
    }

    public function unserialize($string)
    {
        return unserialize($string);
    }
}