<?php

namespace Youngx\Bundle\KernelBundle\Listener;

use Youngx\MVC\AppContext;
use Youngx\MVC\Block;
use Youngx\MVC\ListenerRegistry;

class BlockListener implements ListenerRegistry
{
    public function debug(Block $block)
    {
        if (AppContext::isDebug()) {
            $queries = AppContext::db()->getQueries();
            $s = '';
            if ($queries) {
                $s .= '<pre>'.implode("\n", $queries).'</pre>';
            }

            $endTime = microtime(true);
            $s .= sprintf('<pre>Runtime: %s ms</pre>', ($endTime - AppContext::app()->getStartTime()) * 1000);
            $block->add($s, 2000);
        }
    }

    public function onRenderJavascriptCodesBlock($codes)
    {
        return sprintf('<script type="text/javascript">%s</script>', $codes);
    }

    public function onRenderJqueryCodesBlock($codes)
    {
        return sprintf('<script type="text/javascript">$(function() { %s })</script>', $codes);
    }

    public static function registerListeners()
    {
        return array(
            'kernel.block#body' => array('debug', 1024),
            'kernel.block.render#jquery-codes' => 'onRenderJqueryCodesBlock',
            'kernel.block.render#javascript-codes' => 'onRenderJavascriptCodesBlock',
        );
    }
}