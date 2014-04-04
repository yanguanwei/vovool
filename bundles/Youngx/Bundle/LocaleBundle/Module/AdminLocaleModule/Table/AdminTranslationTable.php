<?php

namespace Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Table;

use Youngx\Bundle\LocaleBundle\Entity\Locale;
use Youngx\MVC\AppContext;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\Table;

class AdminTranslationTable extends Table
{
    public function __construct(Locale $locale)
    {
        $query = AppContext::repository()->query('translation');
        $query->where('locale_id=:locale_id');
        $pagingQuery = new PagingQuery($query, array(
            ':locale_id' => $locale->getId()
        ));
        $pagingQuery->query();
        parent::__construct($pagingQuery);
    }

    protected function setup()
    {
        $this->add('message', '原文');
        $this->add('translation', '译文');
    }
} 