<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Controller;

use Youngx\Bundle\PageBundle\Entity\Page;
use Youngx\Bundle\PageBundle\Entity\PageGroup;
use Youngx\Bundle\PageBundle\Entity\PageVariable;
use Youngx\Bundle\PageBundle\Form\PageVariableSettingsForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Wizard\AdminPageVariableWizard;
use Youngx\Bundle\PageBundle\PageVariableType;
use Youngx\MVC\AppContext;

class AdminPageVariableController
{
    public function addAction(Page $page)
    {
        $wizard = new AdminPageVariableWizard($page);
        return $wizard->run();
    }

    public function editAction(PageVariable $page_variable)
    {
        $type = $this->getPageVariableType($page_variable->getType());
        $form = $type->settingsForm();
        if ($form instanceof PageVariableSettingsForm) {
            $form->bindPageVariable($page_variable);
        }

        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf('成功保存页面<i>%s</i>下的变量<i>%s</i>！', $page_variable->getPage(), $page_variable));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-group-page', array('page_group' => $page_variable->getPage()->getGroup()->getName())));
            }
        }

        return AppContext::render('page/variable/form.html.php', array(
                'form' => $form,
                'subtitle' => array($type->label(), $page_variable->getName(), '编辑')
            ));
    }

    /**
     * @param $type
     * @return PageVariableType
     */
    private function getPageVariableType($type)
    {
        return AppContext::service('pageVariableTypeCollection')->getInstance($type);
    }

    public function deleteAction(PageGroup $page_group, Page $page)
    {
        $repository = AppContext::repository();
        $entities = $repository->loadMultiple('page_variable', AppContext::request()->get('id'));
        $deletedEntities = array();
        foreach ($entities as $entity) {
            $entity->delete();
            $deletedEntities[] = '<i>'.$entity.'</i>';
        }

        AppContext::flash()->add('success', '成功删除页面<i>'.$page.'</i>下的变量：'.implode('，', $deletedEntities));
        return AppContext::redirectResponse(AppContext::generateUrl('admin-group-page', array('page_group' => $page_group->getName())));
    }
} 