<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => '保存'
    ))->start();

$form->render_field('vocabulary_id', 'vocabulary-select');
$form->render_field('label', 'text');
$form->render_field('priority', 'text');

$form->render_buttons();

echo $form->end();

$content->end();