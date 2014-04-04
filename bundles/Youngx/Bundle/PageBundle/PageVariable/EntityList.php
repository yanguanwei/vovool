<?php

namespace Youngx\Bundle\PageBundle\PageVariable;

use Youngx\Bundle\PageBundle\Form\AdminEntityListForm;
use Youngx\Bundle\PageBundle\PageVariableSettings;
use Youngx\Bundle\PageBundle\PageVariableType;
use Youngx\MVC\AppContext;
use Youngx\MVC\EntityCodeQueryFilter;
use Youngx\MVC\PagingQuery;

class EntityList implements PageVariableType
{
    public static function name()
    {
        return 'entity-list';
    }

    public static function label()
    {
        return 'Entity列表';
    }

    public function value(PageVariableSettings $settings)
    {
        $entityType = AppContext::schema()->getEntityTypeByCode($settings['entity_code']);
        $query = AppContext::repository()->query($entityType);
        if ($query instanceof EntityCodeQueryFilter) {
            $query->filterEntityCode($settings['entity_code']);
        }
        $pagingQuery = new PagingQuery($query);
        $pagingQuery->setPageSize($settings['page_size']);
        $pagingQuery->query();
        return $pagingQuery;
    }

    public function settingsForm()
    {
        return new AdminEntityListForm();
    }
}