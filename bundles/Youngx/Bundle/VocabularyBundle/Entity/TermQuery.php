<?php

namespace Youngx\Bundle\VocabularyBundle\Entity;

use Youngx\MVC\Query;

class TermQuery extends Query
{
    public function orderly()
    {
        $alias = $this->getAlias();
        $this->orderBy("{$alias}.priority ASC, {$alias}.id ASC");

        return $this;
    }
}