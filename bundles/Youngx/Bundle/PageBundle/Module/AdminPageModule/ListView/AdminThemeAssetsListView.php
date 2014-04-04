<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\ListView;

use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\MVC\AppContext;
use Youngx\MVC\DataProvider\DirectoryDataProvider;
use Youngx\MVC\Html;
use Youngx\MVC\ListView\OperationsCell;
use Youngx\MVC\Table;

class AdminThemeAssetsListView extends Table
{
    protected $theme;
    protected $basePath;
    protected $path;

    public function __construct(Theme $theme, $path)
    {
        $this->theme = $theme;
        $this->path = $path;

        $basePath = AppContext::themeAssetPath($theme->getName(), $path, 'Front');
        $dataProvider = new DirectoryDataProvider($basePath);
        $this->basePath = $dataProvider->getResultSet()->getPath();

        parent::__construct($dataProvider);
    }

    protected function setup()
    {
        $this->add('filename', '文件名');
        $this->addColumn(new OperationsCell(array('createFile', 'createDir', 'delete')));
    }

    public function formatFilenameColumnHtml(Html $td, \DirectoryIterator $info)
    {
        if ($info->isDir()) {
            $content = sprintf('<a href="%s">%s</a>',
                AppContext::generateUrl('admin-theme-assets', array('theme' => $this->theme->getId(), 'path' => ltrim("{$this->path}/{$info->getFilename()}", '/'))),
                $info->getFilename()
            );
        } else {
            $p = strrpos($info->getFilename(), '.');
            if ($p) {
                if (in_array(strtolower(substr($info->getFilename(), $p+1)), array('js', 'css'))) {
                    $assetViewUrl = AppContext::generateUrl('admin-theme-assets-edit-file', array(
                            'theme' => $this->theme->getId(),
                            'path' => $this->path,
                            'filename' => $info->getFilename()
                        ));
                }
            }

            if (!isset($assetViewUrl)) {
                $assetViewUrl = AppContext::themeAssetUrl($this->theme->getName(), "{$this->path}/{$info->getFilename()}", 'Front');
            }

            $content = sprintf('<a href="%s">%s</a>',
                $assetViewUrl,
                $info->getFilename()
            );
        }

        $td->setContent($content);
    }

    public function formatOperationsColumnForDelete(\DirectoryIterator $model)
    {
        return array(
            'content' => '删除',
            'href' => AppContext::generateUrl('admin-theme-assets-delete', array('theme' => $this->theme->getId(), 'path' => ltrim("{$this->path}/{$model->getFilename()}")))
        );
    }

    public function formatOperationsColumnForCreateDir(\DirectoryIterator $model)
    {
        if ($model->isDir()) {
            return array(
                'content' => '创建子目录',
                'href' => AppContext::generateUrl('admin-theme-assets-create-dir', array(
                            'theme' => $this->theme->getId(),
                            'path' => trim("{$this->path}/{$model->getFilename()}", '/')
                        ))
            );
        }
    }

    public function formatOperationsColumnForCreateFile(\DirectoryIterator $model)
    {
        if ($model->isDir()) {
            return array(
                'content' => '创建文件',
                'href' => AppContext::generateUrl('admin-theme-assets-create-file', array(
                            'theme' => $this->theme->getId(),
                            'path' => trim("{$this->path}/{$model->getFilename()}", '/')
                        ))
            );
        }
    }

    /**
     * @param \DirectoryIterator $model
     * @return bool
     */
    public function validateRow($model)
    {
        return !$model->isDot();
    }

    public function getBasePath()
    {
        return $this->basePath;
    }
}