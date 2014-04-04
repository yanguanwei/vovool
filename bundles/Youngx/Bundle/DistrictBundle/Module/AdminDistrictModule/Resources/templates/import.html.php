<?php
$this->extend('layouts/base.html.php@Ace');

$body = $this->block('body')->start();

$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => $this->translate('Import'),
        'uploading' => true
    ))->start();

$form->render_field('file', 'file');

$form->render_buttons();

echo $form->end();

$body->end();