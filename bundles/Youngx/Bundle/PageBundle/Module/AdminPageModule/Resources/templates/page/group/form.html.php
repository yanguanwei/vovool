<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();
$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => '保存',
        'cancel' => $this->url('admin-page-group')
    ))->start();

$tab = $this->tab_widget(array(
        'base' => '基本信息',
    ), 'ace');

$tab->startContent('base');

$form->render_field('name', 'text');
$form->render_field('label', 'text');
$form->render_field('prefix', 'text');

$tab->endContent();

echo $tab;

$form->render_buttons();

echo $form->end();

$content->end();