<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Controller;

use Youngx\Bundle\PageBundle\Entity\Page;
use Youngx\Bundle\PageBundle\Entity\PageGroup;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Form\AdminPageForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView\AdminPageListView;
use Youngx\MVC\AppContext;

class AdminPageController
{
    public function indexAction(PageGroup $page_group)
    {
        $listView = new AdminPageListView($page_group);

        return AppContext::render('page/list.html.php', array(
                'listView' => $listView,
                'subtitle' => array($page_group->getLabel(), '页面')
            ));
    }

    public function addAction(PageGroup $page_group)
    {
        $form = new AdminPageForm($page_group, AppContext::repository()->create('page'));
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf('页面<i>%s</i>保存成功', $form->getField('name')->getValue()));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-group-page', array('page_group' => $page_group->getName())));
            }
        }

        return AppContext::render('page/form.html.php', array(
                'form' => $form
            ));
    }

    public function editAction(PageGroup $page_group, Page $page)
    {
        $form = new AdminPageForm($page_group, $page);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf('页面<i>%s</i>保存成功', $form->getField('name')->getValue()));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-group-page', array('page_group' => $page_group->getName())));
            }
        }

        return AppContext::render('page/form.html.php', array(
                'form' => $form
            ));
    }

    public function deleteAction(PageGroup $page_group)
    {
        $repository = AppContext::repository();
        $entities = $repository->loadMultiple('page', AppContext::request()->get('id'));
        $deletedPages = array();
        foreach ($entities as $entity) {
            if ($entity instanceof Page) {
                $entity->delete();
                $deletedPages[] = '<i>'.$entity->getLabel().'</i>';
            }
        }

        AppContext::flash()->add('success', '成功删除页面：'.implode('，', $deletedPages));
        return AppContext::redirectResponse(AppContext::generateUrl('admin-group-page', array('page_group' => $page_group->getName())));
    }
}