<?php

namespace Youngx\Bundle\ArchiveBundle\Entity;

use Youngx\MVC\Query;

class ChannelQuery extends Query
{
    public function orderly()
    {
        $alias = $this->getAlias();
        $this->orderBy("{$alias}.priority ASC, {$alias}.id ASC");

        return $this;
    }
}