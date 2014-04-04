<?php
return array(
    'Vocabulary',
    'Term' => array(
        'vocabulary' => array(
            'entityType' => 'vocabulary',
            'condition' => array('vocabulary_id' => 'id'),
            'relation' => 'many_one',
            'reverse' => 'terms'
        )
    )
);