<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => $this->translate('Save')
    ))->start();

$form->render_field('name', 'text');
$form->render_field('label', 'text');

$form->render_buttons();

echo $form->end();

$content->end();