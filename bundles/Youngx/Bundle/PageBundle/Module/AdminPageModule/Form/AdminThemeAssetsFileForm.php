<?php

namespace Youngx\Bundle\PageBundle\Module\AdminPageModule\Form;

use Youngx\Bundle\PageBundle\Entity\Theme;
use Youngx\MVC\AppContext;
use Youngx\MVC\Form;

class AdminThemeAssetsFileForm extends Form
{
    protected $theme;
    protected $path;
    protected $filename;
    protected $content;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;

        parent::__construct('adminThemeAssetsFile');
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    protected function setup()
    {
        $this->add('path', '路径')
            ->addFilter('trim', array('/'));

        $this->add('filename', '文件名')
            ->addValidator('required');

        $this->add('content', '文件内容');
    }

    public function submit()
    {
        $file = AppContext::themeAssetPath($this->theme, trim("{$this->getPath()}/{$this->getFilename()}", '/'), 'Front');
        $dir = dirname($file);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($file, $this->getContent());
    }
}