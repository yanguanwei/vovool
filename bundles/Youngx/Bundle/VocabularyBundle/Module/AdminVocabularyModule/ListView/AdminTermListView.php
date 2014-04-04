<?php

namespace Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\ListView;

use Youngx\Bundle\VocabularyBundle\Entity\Term;
use Youngx\Bundle\VocabularyBundle\Entity\Vocabulary;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html;
use Youngx\MVC\ListView\OperationsCell;
use Youngx\MVC\PagingQuery;
use Youngx\MVC\Table;

class AdminTermListView extends Table
{
    public function __construct(Vocabulary $vocabulary)
    {
        $query = AppContext::repository()->query('term');
        $query->orderBy('priority ASC, id ASC');
        $query->where('vocabulary_id=?', $vocabulary->getId());

        $pagingQuery = new PagingQuery($query);
        $pagingQuery->query();
        parent::__construct($pagingQuery);
    }

    protected function setup()
    {
        $this->add('label', '术语名称');
        $this->addColumn(new OperationsCell(array('edit', 'delete')));
    }

    public function formatOperationsColumnForEdit(Term $term)
    {
        return array(
            'href' => AppContext::generateUrl('admin-term-edit', array('vocabulary' => $term->getVocabularyId(),'term' => $term->getId())),
            'content' => '编辑'
        );
    }

    public function formatOperationsColumnForDelete(Term $term)
    {
        return array(
            'href' => AppContext::value('admin-confirm-delete', 'term', $term->getId(), 'admin-term-delete', array('vocabulary' => $term->getVocabularyId())),
            'content' => '删除'
        );
    }
}