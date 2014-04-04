<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => $this->translate('Save')
    ))->start();

$form->render_field('locale_id', 'locale-select');
$form->render_field('type', 'locale-type-select');
$form->render_field('message', 'textarea');
$form->render_field('translation', 'textarea');

$form->render_buttons();

echo $form->end();

$content->end();
