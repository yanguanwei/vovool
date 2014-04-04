<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();
$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => '保存',
        'cancel' => $this->url('admin-channel')
    ))->start();

$tab = $this->tab_widget(array(
        'base' => '基本信息',
//        'vocabulary' => '词汇表'
    ), 'ace');

$tab->startContent('base');

$form->render_field('parent_id', array('channel-parent-select', 'empty' => '无（一级栏目）'));
$form->render_field('name', 'text');
$form->render_field('label', 'text');
$form->render_field('archive_contents', array(
        'archive-content-select',
        'multiple' => true
    ));
$tab->endContent();

echo $tab;

$form->render_buttons();

echo $form->end();

$content->end();