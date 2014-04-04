<?php

namespace Youngx\Bundle\VocabularyBundle;

use Youngx\Bundle\VocabularyBundle\Entity\Term;
use Youngx\Bundle\VocabularyBundle\Entity\Vocabulary;
use Youngx\MVC\Bundle;
use Youngx\MVC\Html\SelectHtml;
use Youngx\MVC\ListenerRegistry;

class VocabularyBundle extends Bundle implements ListenerRegistry
{
    public function onTermSelectInput(array $attributes)
    {
        $vocabulary = Vocabulary::load($attributes['vocabulary']);
        unset($attributes['vocabulary']);

        $select = new SelectHtml($attributes);
        if ($vocabulary) {
            $select->setOptions(Term::findAllKeyedField('id', 'label', 'priority ASC, id ASC', 'vocabulary_id=:vocabulary_id', array(
                        ':vocabulary_id' => $vocabulary->getId()
                    )));
        }

        return $select;
    }

    public static function registerListeners()
    {
        return array(
            'kernel.input@term-select' => 'onTermSelectInput'
        );
    }
}