<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Controller;

use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Form\AdminThemeForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView\AdminThemeListView;
use Youngx\MVC\AppContext;
use Youngx\Util\Directory;

class AdminThemeController
{
    public function indexAction()
    {
        $listView = new AdminThemeListView();

        return AppContext::render('theme/list.html.php', array(
                'listView' => $listView
            ));
    }

    public function editAction(Theme $theme)
    {
        $form = new AdminThemeForm($theme);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                return AppContext::redirectResponse(AppContext::generateUrl('admin-theme'));
            }
        }

        return AppContext::render('theme/form.html.php', array(
                'form' => $form
            ));
    }

    public function addAction()
    {
        $form = new AdminThemeForm(AppContext::repository()->create('theme'));
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                return AppContext::redirectResponse(AppContext::generateUrl('admin-theme'));
            }
        }

        return AppContext::render('theme/form.html.php', array(
                'form' => $form
            ));
    }

    public function deleteAction()
    {
        $repository = AppContext::repository();
        $entities = $repository->loadMultiple('theme', AppContext::request()->get('id'));
        $deletedEntities = array();
        foreach ($entities as $entity) {
            if ($entity instanceof Theme) {
                $dir = AppContext::themeAssetPath($entity->getName(), '', 'Front');
                Directory::delDirAndFile($dir);
                $entity->delete();
                $deletedEntities[] = '<i>'.$entity->getLabel().'</i>';
            }
        }

        AppContext::flash()->add('success', '成功删除主题：'.implode('，', $deletedEntities));
        return AppContext::redirectResponse(AppContext::generateUrl('admin-theme'));
    }
} 