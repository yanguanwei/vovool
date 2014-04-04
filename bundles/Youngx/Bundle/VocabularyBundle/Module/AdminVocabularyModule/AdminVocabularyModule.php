<?php

namespace Youngx\Bundle\VocabularyBundle\Module\AdminVocabularyModule;

use Youngx\Bundle\VocabularyBundle\Entity\Vocabulary;
use Youngx\MVC\AppContext;
use Youngx\MVC\Html\CheckboxHtml;
use Youngx\MVC\Html\SelectHtml;
use Youngx\MVC\ListenerRegistry;
use Youngx\MVC\Module;

class AdminVocabularyModule extends Module implements ListenerRegistry
{
    public function getModule()
    {
        return 'Admin';
    }

    public function onVocabularySelectInput(array $attributes)
    {
        $select = new SelectHtml($attributes);
        $select->setOptions(Vocabulary::findAllKeyedField('id', 'label', 'name ASC'));
        return $select;
    }

    public function onVocabularyCheckboxInput(array $attributes)
    {
        $checkbox = new CheckboxHtml($attributes);
        $checkbox->setOptions(Vocabulary::findAllKeyedField('id', 'label', 'name ASC'));
        return $checkbox;
    }

    public static function registerListeners()
    {
        return array(
            'kernel.input#vocabulary-select' => 'onVocabularySelectInput',
            'kernel.input#vocabulary-checkbox' => 'onVocabularyCheckboxInput'
        );
    }
}