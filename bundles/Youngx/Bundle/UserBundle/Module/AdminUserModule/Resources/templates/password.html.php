<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => $this->translate('Save')
    ))->start();

$form->render_field('password_old', 'password');
$form->render_field('password', 'password');
$form->render_field('password_confirm', 'password');
$form->render_buttons();

echo $form->end();

$content->end();