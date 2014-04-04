<?php

namespace Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\ListView;

use Youngx\Bundle\VocabularyBundle\Entity\Vocabulary;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html;
use Youngx\MVC\ListView\OperationsCell;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\Table;

class AdminVocabularyListView extends Table
{
    public function __construct()
    {
        $query = AppContext::repository()->query('vocabulary');
        $query->orderBy('name ASC');
        $pagingQuery = new PagingQuery($query);
        $pagingQuery->query();
        parent::__construct($pagingQuery);
    }

    protected function setup()
    {
        $this->add('name', '机器名');
        $this->add('label', '词汇表名');
        $this->addColumn(new OperationsCell(array('edit', 'term', 'delete')));
    }

    public function formatOperationsColumnForEdit(Vocabulary $vocabulary)
    {
        return array(
            'href' => AppContext::generateUrl('admin-vocabulary-edit', array('vocabulary' => $vocabulary->getId())),
            'content' => '编辑'
        );
    }

    public function formatOperationsColumnForTerm(Vocabulary $vocabulary)
    {
        return array(
            'href' => AppContext::generateUrl('admin-term', array(
                        'vocabulary' => $vocabulary->getId(),
                    )),
            'content' => '术语表'
        );
    }

    public function formatOperationsColumnForDelete(Vocabulary $vocabulary)
    {
        return array(
            'href' => AppContext::value('admin-confirm-delete', 'vocabulary', $vocabulary->getId(), 'admin-vocabulary-delete'),
            'content' => '删除'
        );
    }
}