<?php

namespace Youngx\Bundle\AdminBundle\Controller;

use Youngx\MVC\AppContext;
use Youngx\MVC\Html\ULHtml;

class DeleteConfirmController extends ConfirmController
{
    protected function getTips()
    {
        return AppContext::translate('Are you sure you want to delete those information?');
    }

    protected function getData()
    {
        return array(
            'id' => AppContext::request()->get('id')
        );
    }

    protected function getMessage()
    {
        $ids = AppContext::request()->get('id');
        $entityType = AppContext::request()->get('entityType');
        if ($entityType && $ids) {
            $ul = new ULHtml();
            foreach (AppContext::repository()->loadMultiple($entityType, $ids) as $entity) {
                $ul->addItem((string) $entity);
            }
            return (string) $ul;
        }
        return '';
    }
} 