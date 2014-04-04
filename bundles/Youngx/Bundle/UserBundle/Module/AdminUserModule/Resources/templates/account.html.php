<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => $this->translate('Save')
    ))->start();

$form->render_field('username', 'text');

if ($form->has_field('password')) {
    $form->render_field('password', 'text');
}

$form->render_field('role_ids', 'role-select');
$form->render_field('email', 'text');
$form->render_field('phone', 'text');
$form->render_field('is_active', array(
        'radio',
        'options' => array(
            '未激活',
            '已激活'
        )
    ));

$form->render_buttons();

echo $form->end();

$content->end();