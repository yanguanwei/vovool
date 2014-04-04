<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Controller;

use Youngx\Bundle\PageBundle\Entity\PageGroup;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Form\AdminPageGroupForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView\AdminPageGroupListView;
use Youngx\MVC\AppContext;

class AdminPageGroupController
{
    public function indexAction()
    {
        $listView = new AdminPageGroupListView();
        return AppContext::render('page/group/list.html.php', array(
                'listView' => $listView
            ));
    }

    public function addAction()
    {
        $form = new AdminPageGroupForm(AppContext::repository()->create('page_group'));
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf("成功保存分组<i>%s [ %s ]</i>", $form->getValue('label'), $form->getValue('name')));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-page-group'));
            }
        }

        return AppContext::render('page/group/form.html.php', array(
                'form' => $form
            ));
    }

    public function editAction(PageGroup $page_group)
    {
        $form = new AdminPageGroupForm($page_group);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf("成功保存分组<i>%s [ %s ]</i>", $form->getValue('label'), $form->getValue('name')));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-page-group'));
            }
        }

        return AppContext::render('page/group/form.html.php', array(
                'form' => $form
            ));
    }

    public function deleteAction()
    {
        $repository = AppContext::repository();
        $entities = $repository->loadMultiple('page_group', AppContext::request()->get('id'));
        $deletedEntities = array();
        foreach ($entities as $entity) {
            $repository->delete($entity);
            $deletedEntities[] = '<i>'.$entity.'</i>';
        }

        AppContext::flash()->add('success', '成功删除页面分组：'.implode('，', $deletedEntities));

        return AppContext::redirectResponse(AppContext::generateUrl('admin-page-group'));
    }
}