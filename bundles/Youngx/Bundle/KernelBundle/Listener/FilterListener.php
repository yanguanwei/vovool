<?php

namespace Youngx\Bundle\KernelBundle\Listener;

use Youngx\MVC\ListenerRegistry;

class FilterListener implements ListenerRegistry
{
    public function onTrimFilter($value, $chars = ' ')
    {
        return trim($value, $chars);
    }

    public function onHtmlspecialcharsFilter($value, $quote_style = ENT_COMPAT, $charset = 'UTF-8')
    {
        return htmlspecialchars($value, $quote_style, $charset);
    }

    public function onHtmlentitiesFilter($value, $quote_style = ENT_COMPAT, $charset = 'UTF-8')
    {
        return htmlentities($value, $quote_style, $charset);
    }

    public static function registerListeners()
    {
        return array(
            'kernel.filter#trim' => 'onTrimFilter',
            'kernel.filter#htmlspecialchars' => 'onHtmlspecialcharsFilter',
            'kernel.filter#htmlentities' => 'onHtmlentitiesFilter'
        );
    }
}