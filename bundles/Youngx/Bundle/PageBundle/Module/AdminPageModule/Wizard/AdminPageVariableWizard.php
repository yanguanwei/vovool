<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Wizard;

use Symfony\Component\HttpFoundation\Response;
use Youngx\Bundle\PageBundle\Entity\Page;
use Youngx\Bundle\PageBundle\Entity\PageVariable;
use Youngx\Bundle\PageBundle\Form\PageVariableSettingsForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Form\AdminPageVariableForm;
use Youngx\MVC\AppContext;
use Youngx\MVC\Form;
use Youngx\MVC\Wizard;

class AdminPageVariableWizard extends Wizard
{
    /**
     * @var Page
     */
    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return array
     */
    protected function actions()
    {
        return array(
            'type' => '变量类型',
            'settings' => '变量配置'
        );
    }

    protected function onInitTypeAction()
    {
        $variable = AppContext::repository()->create('page_variable');
        $form = new AdminPageVariableForm($this->page, $variable);
        $action = new Wizard\FormWizardAction($form);

        return $action;
    }

    protected function onFinishTypeAction(Wizard\WizardContext $wizardContext, Wizard\FormWizardAction $action)
    {
        $form = $action->getForm();
        if ($form instanceof AdminPageVariableForm) {
            AppContext::flash()->add('success', sprintf('页面变量<i>%s</i>保存成功', $form->getField('name')->getValue()));
            $wizardContext->add('id', $form->getEntity()->identifier());
        }
    }

    protected function onInitSettingsAction(Wizard\WizardContext $wizardContext)
    {
        $id = $wizardContext->get('id');
        $pageVariable = PageVariable::load($id);
        $form = AppContext::service('pageVariableTypeCollection')->getSettingsForm($pageVariable->get('type'));
        if ($form && $form instanceof PageVariableSettingsForm) {
            $form->bindPageVariable($pageVariable);
            return new Wizard\FormWizardAction($form);
        }
    }

    /**
     * @param \Youngx\MVC\Wizard\WizardContext $wizardContext
     * @return Response
     */
    protected function complete(Wizard\WizardContext $wizardContext)
    {
        $id = $wizardContext->get('id');
        $pageVariable = PageVariable::load($id);
        AppContext::flash()->add('success', sprintf('页面变量<i>%s</i>配置成功！', $pageVariable->get('name')));

        return AppContext::redirectResponse(AppContext::generateUrl('admin-group-page', array('page_group' => $this->page->getGroup()->getName())));
    }

    protected function renderActionResult($result)
    {
        return AppContext::render('page/variable/wizard.html.php', array(
                'wizard' => $this,
                'result' => $result
            ));
    }
}