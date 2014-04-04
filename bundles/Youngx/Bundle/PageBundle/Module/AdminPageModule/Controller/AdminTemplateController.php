<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Controller;

use Youngx\Bundle\PageBundle\Entity\Template;
use Youngx\Bundle\PageBundle\Entity\ThemeTemplate;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Form\AdminTemplateForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView\AdminTemplatesListView;
use Youngx\MVC\AppContext;
use Youngx\MVC\Theme as MVCTheme;
use Youngx\Bundle\PageBundle\Entity\Theme;

class AdminTemplateController
{
    public function indexAction(Theme $theme = null)
    {
        $listView = new AdminTemplatesListView($theme);

        if ($theme) {
            $subtitle = array('主题模板', $theme->getName());
        } else {
            $subtitle = '全局模板';
        }

        return AppContext::render('template/list.html.php', array(
                'listView' => $listView,
                'subtitle' => $subtitle
            ));
    }

    public function addAction(Theme $theme = null)
    {
        $form = new AdminTemplateForm(AppContext::repository()->create('template'), $theme);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                return AppContext::redirectResponse($theme ? AppContext::generateUrl('admin-theme-templates', array('theme' => $theme->getId())) : AppContext::generateUrl('admin-template-list'));
            }
        }

        return AppContext::render('template/form.html.php', array(
                'form' => $form
            ));
    }

    public function editAction(Template $template, Theme $theme = null)
    {
        $form = new AdminTemplateForm($template, $theme);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                return AppContext::redirectResponse($theme ? AppContext::generateUrl('admin-theme-templates', array('theme' => $theme->getId())) : AppContext::generateUrl('admin-template-list'));
            }
        }

        return AppContext::render('template/form.html.php', array(
                'form' => $form
            ));
    }

    public function deleteAction()
    {
        $repository = AppContext::repository();
        $i = 0;
        foreach ($repository->loadMultiple('template', AppContext::request()->get('id')) as $entity) {
            $i++;
            $repository->delete($entity);
        }

        AppContext::flash()->add('success', AppContext::translate('成功删除%count%个模板！', array(
                    '%count%' => $i,
                )));

        return AppContext::redirectResponse(AppContext::generateUrl('admin-template'));
    }

    public function deleteThemeTemplateAction(Theme $theme)
    {
        $repository = AppContext::repository();
        $i = 0;
        foreach ($repository->loadMultiple('theme_template', AppContext::request()->get('id')) as $entity) {
            $i++;
            if ($entity instanceof ThemeTemplate) {
                $repository->delete($entity);
            }

        }

        AppContext::flash()->add('success', AppContext::translate('成功删除%count%个主题模板！', array(
                    '%count%' => $i,
                )));

        return AppContext::redirectResponse(AppContext::generateUrl('admin-theme-templates', array(
                    'theme' => $theme->getId()
                )));
    }
}