<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => '保存'
    ))->start();

echo $form->render_field('path', 'text');
echo $form->render_field('folder', 'text');

echo $form->render_buttons();

echo $form->end();

$content->end();