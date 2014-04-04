<?php
return array(
    'Locale',
    'Translation' => array(
        'locale' => array(
            'entityType' => 'locale',
            'condition' => array('locale_id' => 'id'),
            'relation' => 'many_one',
            'reverse' => 'translations'
        )
    )
);