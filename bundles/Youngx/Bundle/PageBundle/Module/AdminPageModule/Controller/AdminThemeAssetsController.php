<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Controller;

use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Form\AdminThemeAssetsDirForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Form\AdminThemeAssetsFileForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Form\AdminThemeAssetsForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\Form\AdminThemeFileForm;
use Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView\AdminThemeAssetsListView;
use Youngx\MVC\AppContext;
use Youngx\Util\Directory;

class AdminThemeAssetsController
{
    public function indexAction(Theme $theme)
    {
        $path = AppContext::request()->query->get('path', '');
        $listView = new AdminThemeAssetsListView($theme, $path);

        $parentDirUrl = null;
        if ($path) {
            $parentDir = dirname($path);
            if ($parentDir) {
                $parentDirUrl = AppContext::generateUrl('admin-theme-assets', array('theme' => $theme->getId(), 'path' => $parentDir == '.' ? '' : ltrim($parentDir)));
            }
        }

        return AppContext::render('theme/assets/list.html.php', array(
                'listView' => $listView,
                'theme' => $theme,
                'path' => $path,
                'parentDirUrl' => $parentDirUrl,
                'subtitle' => array('资源文件', $path)
            ));
    }

    public function deleteAction(Theme $theme)
    {
        $request = AppContext::request();
        $path = $request->query->get('path', '');

        $file = AppContext::themeAssetPath($theme->getName(), $path, 'Front');
        if (is_file($file)) {
            unlink($file);
        } else {
            Directory::delDirAndFile($file);
        }

        return AppContext::backResponse(sprintf("删除%s<i>%s</i>成功！", is_file($file) ? '文件' : '目录', $path));
    }

    public function uploadAction(Theme $theme)
    {
        $request = AppContext::request();
        $path = $request->query->get('path', '');
        $form = new AdminThemeFileForm($theme, $path);
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
            }
        }

        return AppContext::render('theme/assets/upload.html.php', array(
                'form' => $form
            ));
    }

    public function createDirAction(Theme $theme)
    {
        $form = new AdminThemeAssetsDirForm($theme);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf('目录<i>%s</i>保存成功！', trim("{$form->getPath()}/{$form->getFolder()}", '/')));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-theme-assets', array('theme' => $theme->getId(), 'path' => $form->getPath())));
            }
        } else {
            $path = $request->query->get('path');
            $form->bindValue('path', $path);
        }

        return AppContext::render('theme/assets/dir.html.php', array(
                'form' => $form
            ));
    }

    public function createFileAction(Theme $theme)
    {
        $form = new AdminThemeAssetsFileForm($theme);
        $request = AppContext::request();
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->validate()) {
                $form->submit();
                AppContext::flash()->add('success', sprintf('文件<i>%s</i>保存成功！', trim("{$form->getPath()}/{$form->getFilename()}", '/')));
                return AppContext::redirectResponse(AppContext::generateUrl('admin-theme-assets', array('theme' => $theme->getId(), 'path' => $form->getPath())));
            }
        }

        $path = $request->get('path');
        $filename = $request->get('filename');
        $form->bindValue('path', $path);
        $form->bindValue('filename', $filename);
        if ($filename) {
            $file = AppContext::themeAssetPath($theme, trim("{$path}/{$filename}", '/'), 'Front');
            if (is_file($file)) {
                $form->bindValue('content', file_get_contents($file));
            }
        }

        return AppContext::render('theme/assets/file.html.php', array(
                'form' => $form
            ));
    }
}