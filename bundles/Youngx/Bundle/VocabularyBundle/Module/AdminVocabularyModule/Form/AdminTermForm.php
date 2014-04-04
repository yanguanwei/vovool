<?php

namespace Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule\Form;

use Youngx\Bundle\VocabularyBundle\Entity\Term;
use Youngx\Bundle\VocabularyBundle\Entity\Vocabulary;
use Youngx\MVC\EntityForm;

class AdminTermForm extends EntityForm
{
    /**
     * @var Vocabulary
     */
    protected $vocabulary;

    public function __construct(Vocabulary $vocabulary, Term $term)
    {
        parent::__construct($term);
        $this->bindVocabulary($vocabulary);
    }

    protected function setup()
    {
        $this->add('label', '术语')
            ->addValidator('required');

        $this->add('vocabulary_id', '词汇表')
            ->addValidator('required');

        $this->add('icon', '图标');

        $this->add('priority', '优先级');
    }

    /**
     * @param Vocabulary $vocabulary
     */
    public function bindVocabulary(Vocabulary $vocabulary)
    {
        $this->vocabulary = $vocabulary;
        $this->bindValue('vocabulary_id', $vocabulary->getId());
    }

    /**
     * @return Vocabulary
     */
    public function getVocabulary()
    {
        return $this->vocabulary;
    }
}