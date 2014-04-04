<?php

namespace Youngx\Bundle\PageBundle\Form;

use Youngx\Bundle\PageBundle\Entity\PageVariable;
use Youngx\Bundle\PageBundle\PageVariableSettings;
use Youngx\MVC\AppContext;
use Youngx\MVC\Form;
use Youngx\MVC\Html;
use Youngx\MVC\Widget\FieldWidget;
use Youngx\MVC\Widget\FormWidget;

abstract class PageVariableSettingsForm extends Form
{
    /**
     * @var PageVariable
     */
    protected $pageVariable;

    private $fieldFromUrlAttributes = array();
    private $alternativeFieldFromUrlAttributes = array();

    public function bindPageVariable(PageVariable $pageVariable)
    {
        $settings = $pageVariable->getSettings();
        if ($settings) {
            $this->bindData($settings->toArray());
        }
        $this->pageVariable = $pageVariable;

        if (!$pageVariable->isNew()) {
            $this->add('name', '变量名')
                ->addValidator('required')
                ->setValue($pageVariable->getName());
        }
    }

    /**
     * @param $name
     * @param $label
     * @return \Youngx\MVC\Field
     */
    public function addFieldFromUrlAttribute($name, $label)
    {
        $field = $this->add($name, $label);
        $this->fieldFromUrlAttributes[] = $name;

        return $field;
    }

    public function alternativeFieldFromUrlAttribute($name)
    {
        $this->alternativeFieldFromUrlAttributes[] = $name;

        return $this;
    }

    /**
     * @return PageVariable
     */
    public function getPageVariable()
    {
        return $this->pageVariable;
    }

    public function formatFormWidget(FormWidget $widget)
    {
        foreach ($widget->getFieldWidgets() as $field) {
            $this->formatFieldWidget($field);
        }
    }

    public function formatFieldWidget(FieldWidget $field)
    {
        $name = $field->getField()->getName();
        if (in_array($name, $this->alternativeFieldFromUrlAttributes)) {
            $settings = $this->pageVariable->getSettings();
            $input = $field->getInput();
            if ($input instanceof Html) {
                $checkboxId = "{$name}-from-url";
                $textInputId = "{$name}-from-url-input";
                $value = $settings ? $settings->getFieldFromUrlAttributeName($name) : '';
                $html = sprintf(
                    '<span class="help-block"><label class="middle"><input id="%s" class="ace" name="%s" type="checkbox" value="1"><span class="lbl"> 来自URL</span></label></span>',
                    $checkboxId, $checkboxId
                );

                $textInput = sprintf(
                    '<input style="display:none;" disabled="disabled" class="form-control" id="%s" type="text" value="%s" name="%s" placeholder="URL变量名...">',
                    $textInputId, $value, $input->getName()
                );

                $field->getInputWrapperHtml()->prepend($textInput)->append($html);
                $this->registerFromUrlJavascript($input, $checkboxId, $textInputId, $value ? true : false);
            }
        }
    }

    private function registerFromUrlJavascript(Html $input, $checkboxId, $textInputId, $isChecked)
    {
        $isChecked = $isChecked ? 'true' : 'false';

        $code = <<<CODE
$('#{$checkboxId}').click(function() {
    if ($(this).is(':checked')) {
        $('#{$input->getId()}').hide().attr('disabled', true);
        $('#{$textInputId}').show().attr('disabled', false);
    } else {
        $('#{$textInputId}').hide().attr('disabled', true);
        $('#{$input->getId()}').show().attr('disabled', false);
    }
});

if ({$isChecked}) {
    $('#{$checkboxId}').click();
}
CODE;
        AppContext::registerJquery($code);
    }

    public function render()
    {
        $formWidget = new FormWidget($this, array(
            'skin' =>  'ace-horizontal',
            'submit' => '保存'
        ));

        if (!$this->pageVariable->isNew()) {
            $formWidget->addFieldInput('name', 'text');
        }

        $this->renderFieldForFormWidget($formWidget);

        $this->formatFormWidget($formWidget);

        return $formWidget;
    }

    abstract protected function renderFieldForFormWidget(FormWidget $formWidget);

    public function submit()
    {
        $settings = array();
        $fieldFromUrlAttributeNames = array();
        $request = AppContext::request();

        foreach ($this->getFields() as $name => $field) {
            if ($name === 'name') {
                $this->pageVariable->setName($field->getValue());
            } else if (in_array($name, $this->fieldFromUrlAttributes) || (in_array($name, $this->alternativeFieldFromUrlAttributes) && $request->get("{$name}-from-url"))) {
                $settings[$name] = null;
                $fieldFromUrlAttributeNames[$name] = $field->getValue();
            } else {
                $settings[$name] = $field->getValue();
            }
        }

        $this->pageVariable->setSettings(new PageVariableSettings($settings, $fieldFromUrlAttributeNames));
        $this->pageVariable->save();
    }
}