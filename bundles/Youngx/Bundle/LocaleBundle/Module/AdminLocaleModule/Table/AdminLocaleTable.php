<?php

namespace Youngx\Bundle\LocaleBundle\Module\AdminLocaleModule\Table;

use Youngx\Bundle\LocaleBundle\Entity\Locale;
use Youngx\MVC\AppContext;
use Youngx\MVC\ListView\OperationsCell;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\Table;

class AdminLocaleTable extends Table
{
    public function __construct()
    {
        $query = AppContext::repository()->query('locale');

        $pagingQuery = new PagingQuery($query);
        $pagingQuery->query();
        parent::__construct($pagingQuery);
    }

    protected function setup()
    {
        $this->add('label', '显示名');
        $this->add('name', '名称');
        $this->add('code', '代码');
        $this->addFieldColumn(new OperationsCell(array('translations', 'translate', 'delete')));
    }

    public function formatOperationsColumnForTranslations(Locale $locale)
    {
        return array(
            'href' => AppContext::generateUrl('admin-translation', array('locale' => $locale->getId())),
            'content' => AppContext::translate('Translations')
        );
    }

    public function formatOperationsColumnForTranslate(Locale $locale)
    {
        return array(
            'href' => AppContext::generateUrl('admin-translation-translate', array('locale' => $locale->getId())),
            'content' => AppContext::translate('Translate')
        );
    }

    public function formatOperationsColumnForDelete(Locale $locale)
    {
        return array(
            'href' => AppContext::value('admin-confirm-delete', 'locale', $locale->getId(), 'admin-locale-delete'),
            'content' => AppContext::translate('Delete')
        );
    }
}