<?php
$this->extend('layouts/main.html.php@Ace');

$content = $this->block('content')->start();

$form = $this->form_widget($this->form, array(
        'skin' =>  'ace-horizontal',
        'submit' => $this->translate('Save')
    ))->start();

$tab = $this->tab_widget(array(
        'base' => '基本信息',
        'advance' => '高级选项'
    ), 'ace');

$tab->startContent('base');

$form->render_field('name', 'text');
$form->render_field('label', 'text');
$form->render_field('path', 'text');
$form->render_field('title', 'text');
$form->render_field('template', 'template-select');

$tab->endContent();

$tab->startContent('advance');

$form->render_field('controller', array('select',
        'options' => array(
            'FrontPage::index@FrontPage' => '默认',
            'FrontFeedback::add@FrontFeedback' => '反馈表单'
        )
    ));

$form->render_field('menu_class', array('select',
        'options' => array(
            '' => '默认',
            'Menu:ArchiveView@Archive' => '查看内容',
        )
    ));

$form->render_field('parent', 'text');

$form->render_field('defaults', 'textarea');

$tab->endContent();

echo $tab;

$form->render_buttons();

echo $form->end();

$content->end();