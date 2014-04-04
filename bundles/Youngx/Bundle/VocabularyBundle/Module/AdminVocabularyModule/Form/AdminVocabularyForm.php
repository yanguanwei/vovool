<?php

namespace Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\Form;

use Youngx\Bundle\VocabularyBundle\Entity\Vocabulary;
use Youngx\MVC\AppContext;
use Youngx\MVC\EntityForm;

class AdminVocabularyForm extends EntityForm
{
    /**
     * @var Vocabulary
     */
    protected $vocabulary;

    protected function setup()
    {
        $this->add('name', '机器名')
            ->addValidator('required')
            ->addValidator('name')
            ->addFilter('trim');

        $this->add('label', '名称')
            ->addValidator('required');
    }

    protected function validateInternal()
    {
        $condition = '';
        $params = array();

        if ($this->vocabulary) {
            $condition = 'id<>:id AND ';
            $params[':id'] = $this->vocabulary->getId();
        }

        $condition .= 'name=:name';
        $params[':name'] = $this->value('name');

        if (AppContext::repository()->exist('vocabulary', $condition, $params)) {
            return array('name' => '已经存在的机器名');
        }
    }
}